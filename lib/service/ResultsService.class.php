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

        if (isset($results[$i]['best'])) {
          $result['best'] = Util::getChangeRecord($result['best'], $result['eventid']);
        }

        if (isset($results[$i]['average'])) {
          $result['average'] = Util::getChangeRecord($result['average'], $result['eventid']);

          for ($i = 1; $i <= 5; $i++) {
            if ($result['value'.$i] == 0) continue;
            $result['subrecord'][$i] = Util::getChangeRecord($result[$value], $result['eventid']);
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

        Util::parentheses(&$result);
     }
  }
}
