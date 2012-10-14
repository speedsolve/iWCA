<?php

/**
 * Results 汎用クラス
 * @auther Sinpei Araki
 */

class ResultsService
{
  /**
   * データ追加
   * @param データ
   */
  public function setData (&$results)
  {
     foreach ($results as &$result) {

        foreach (sfConfig::get('app_event_id') as $event => $value) {
          if ((string)$event === (string)$result['eventid']) {
            $result['eventname'] = $value['cellname'];
          }
        }

        $competition = CompetitionsTable::getInstance()->getCompetition($result['competitionid']);
        $result['competitionname'] = $competition['cellname'];
        unset($competition);

        if (isset($result['best'])) {
          $result['record'] = Util::getChangeRecord($result['best'], $result['eventid']);
        }

        if (isset($result['average'])) {
          $result['record'] = Util::getChangeRecord($result['average'], $result['eventid']);

          for ($i = 1; $i <= 5; $i++) {
            if ($result['value'.$i] != 0) {
              $result['subrecord'][$i] = Util::getChangeRecord($result['value'.$i], $result['eventid']);
            }
          }
        }

        //ラウンド名取得
        if (isset($result['roundid'])) {
          $round = sfConfig::get('app_round_id');
          $result['roundid'] = $round[$result['roundid']]['name'];
        }

        //フォーマット取得
        if (isset($result['formatid'])) {
          $round = sfConfig::get('app_format_id');
          $result['formatid'] = $round[$result['formatid']]['name'];
        }

        // ()作成
        Util::parenthesis(&$result);
        // ()除去
        $result['personname'] = Util::removeParenthesis($result['personname']);
     }
  }

  /**
   * Current Recordを取得する
   */
  public static function getCurrentRecord($results, $type)
  {
    $record = array();
    $person = array();
    // イベントごとに現行記録を抽出する
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      foreach ($results as &$result) {
        if ((string)$event === (string)$result['eventid']) {

          //まずは最初のレコードを代入する。基本的にはこれが現行の最高記録であるはず。
          if (!isset($record[$event]) && $result[$type] > 0) {
            $result['eventname'] = $value['cellname'];
            $record[$event][] = $result;
          }

          //現在代入されているレコードより小さい値があればunsetし、代入。
          if (isset($record[$event]) && $record[$event][0][$type] > $result[$type] && $result[$type] > 0) {
            unset($record[$event]);
            $result['eventname'] = $value['cellname'];
            $record[$event][] = $result;

            //同じ値であるならば、追加代入する。
          } elseif (isset($record[$event]) && $record[$event][0][$type] === $result[$type] && $result[$type] > 0) {
            //同一人物、同一レコードである場合は入れない。
            if ($record[$event][0]['personid'] != $result['personid'] && !in_array($result['personid'], $person)) {
              $result['eventname'] = $value['cellname'];
              $record[$event][] = $result;
              $person[] = $result['personid'];
            }
          }
        }
      }
    }

    $results = array();
    foreach ($record as $values) {
      foreach ($values as $value) {
        $results[] = $value;
      }
    }

    return $results;
  }
}
