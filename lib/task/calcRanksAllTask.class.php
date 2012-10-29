<?php

class calcRanksAllTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'iwca';
    $this->name             = 'calcRanksAll';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [calcRanksAll|INFO] task does things.
Call it with:

  [php symfony calcRanksAll|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
    // 各DBに対するコネクションを貼る。
    $ranks_all_table     = Doctrine::getTable('RanksAll');
    $ranks_all_con       = $ranks_all_table->getConnection();

    $ranks_single_table  = Doctrine::getTable('RanksSingle');
    $ranks_single_con    = $ranks_single_table->getConnection();

    $ranks_average_table = Doctrine::getTable('RanksAverage');
    $ranks_average_con   = $ranks_average_table->getConnection();

    // 初期化
    $singles  = $ranks_single_con->fetchAll('select * from RanksSingle group by personId');
    $averages = $ranks_average_con->fetchAll('select * from RanksAverage group by personId');

    $single_person_ids = array();
    foreach ($singles as $single) {
      $single_person_ids[] = $single['personId'];
    }

    $average_person_ids = array();
    foreach ($averages as $average) {
      $average_person_ids[] = $average['personId'];
    }

    // 各競技ごとに計算していく。
    // 最初に現状出場していない場合の順位を取得する
    $worst = array();
    foreach (sfConfig::get('app_event_id') as $event => $value)
    {
      $sql = 'select count(1) from RanksSingle where eventId = :eventId';
      $worst['single'][$event] = $ranks_single_con->fetchOne($sql, array(':eventId' => $event));

      $sql = 'select count(1) from RanksAverage where eventId = :eventId';
      if ($value['format'] == 'Average') {
        $worst['average'][$event] = $ranks_average_con->fetchOne($sql, array(':eventId' => $event));
      }
    }

    $single_point = array();
    foreach ($single_person_ids as $key => $person_id)
    {
      $single_sum = 0;
      $sql = 'select * from RanksSingle where personId = :personId';
      $singles = $ranks_single_con->fetchAll($sql, array(':personId' => $person_id));

      $event_ids = array();
      foreach ($singles as $single) {
        $single_sum += $single['worldRank'];
        $event_ids[] = $single['eventId'];
      }

      foreach (sfConfig::get('app_event_id') as $event => $value)
      {
        if (!in_array($event, $event_ids)) {
          $single_sum += $worst['single'][$event] + 1;
        }
      }

      $single_point[] = array('person_id' => $person_id, 'point' => $single_sum);
    }

    // ソートして順位抽出
    usort($single_point, array($this, 'sort_by_point'));
    Util::adjustRank(&$single_point, 'point');

    $average_point = array();
    foreach ($single_person_ids as $key => $person_id)
    {
      $average_sum = 0;
      $sql = 'select * from RanksAverage where personId = :personId';
      $averages = $ranks_average_con->fetchAll($sql, array(':personId' => $person_id));

      $event_ids = array();
      if ($averages) {
        foreach ($averages as $average) {
          $average_sum += $average['worldRank'];
          $event_ids[] = $average['eventId'];
        }
      }

      foreach (sfConfig::get('app_event_id') as $event => $value)
      {
        if (!in_array($event, $event_ids) && $value['format'] == 'Average') {
          $average_sum += $worst['average'][$event] + 1;
        }
      }
      $average_point[] = array('person_id' => $person_id, 'point' => $average_sum);
    }

    // ソートして順位抽出
    usort($average_point, array($this, 'sort_by_point'));
    Util::adjustRank(&$average_point, 'point');

    // ソート終ったので再度まとめる
    $results  = array();
    foreach ($single_point as $single) {
      $results[$single['person_id']]['singleSum']  = $single['point'];
      $results[$single['person_id']]['singleRank'] = $single['rank'];
    }

    foreach ($average_point as $average) {
      $results[$average['person_id']]['averageSum']  = $average['point'];
      $results[$average['person_id']]['averageRank'] = $average['rank'];
    }

    // 初期化
    $ranks_all_con->execute('truncate RanksAll');
    foreach ($results as $key => $result)
    {
      $ranks_all_con->insert($ranks_all_table, array('personId'    => $key,
                                                     'singleRank'  => $result['singleRank'],
                                                     'averageRank' => $result['averageRank'],
                                                     'singleSum'   => $result['singleSum'],
                                                     'averageSum'  => $result['averageSum']));
    }
  }

  function sort_by_point($a, $b)
  {
    if ($a['point'] == $b['point']) {
        return 0;
    }
    return ($a['point'] < $b['point']) ? -1 : 1;
  }
}
