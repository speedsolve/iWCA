<?php

/**
 * Prizes 汎用クラス
 * @auther Sinpei Araki
 */

class PrizesService
{
  /**
   * 入賞記録を変換します
   * @params 結果
   */
  public static function getChangePrize($results)
  {
    $records = array();
    $points = sfConfig::get('app_prize_point');
    foreach ($results as &$result) {
      $records[$result['personid']]['personid'] = $result['personid'];
      $records[$result['personid']]['personname'] = $result['personname'];
      $records[$result['personid']]['personcountryid'] = $result['personcountryid'];
      $records[$result['personid']]['record'] += $points[$result['pos']];
      if ($result['pos'] == '1') {
        $records[$result['personid']]['first']++;
      } else if ($result['pos'] == '2') {
        $records[$result['personid']]['second']++;
      } else if ($result['pos'] == '3') {
        $records[$result['personid']]['third']++;
      }
    }

    // ポイントでソートする
    $tmp_points = array();
    foreach ($records as $personId => $value) {
      $tmp_points[$personId] = $value['record'];
    }
    array_multisort($tmp_points, SORT_DESC, $records);

    return $records;
  }
}
