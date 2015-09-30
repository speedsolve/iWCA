<?php

/**
 * Ranks 汎用クラス
 * @auther Sinpei Araki
 */

class RanksService
{
  /**
   * ランク記録を変換します
   * @params 結果
   */
  public static function getChangeRank($results, $counts, $region, $format)
  {
    $records = array();
    foreach ($results as &$result) {
      $records[$result['personid']]['personid'] = $result['personid'];
      $records[$result['personid']]['personname'] = $result['personname'];
      $records[$result['personid']]['personcountryid'] = $result['personcountryid'];
      if ($region == 'World') {
        $records[$result['personid']]['record'] += $result['worldrank'];
        $records[$result['personid']][$result['eventid']] = $result['worldrank'];
      } elseif (in_array($region, sfConfig::get('app_name_continents'))) {
        $records[$result['personid']]['record'] += $result['continentrank'];
        $records[$result['personid']][$result['eventid']] = $result['continentrank'];
      } else {
        $records[$result['personid']]['record'] += $result['countryrank'];
        $records[$result['personid']][$result['eventid']] = $result['countryrank'];
      }
    }

    $eventIds = array();
    foreach (sfConfig::get('app_event_id') as $event => $target) {
      if (!in_array($event, sfConfig::get('app_event_abolition'))) {
        if ($format == 'Single' || $target['format'] == 'Average') {
          $eventIds[] = $event;
        }
      }
    }

    $rankCounts = array();
    foreach ($counts as $count) {
      $rankCounts[$count['eventid']] = $count['count'];
    }

    foreach ($records as $personId => &$value) {
      foreach ($eventIds as $eventId) {
        if (!isset($value[$eventId])) {
          $value['record'] += $rankCounts[$eventId] + 1;
          $value[$eventId] = $rankCounts[$eventId] + 1;
        }
      }
    }

    // 順位の合計でマージする
    $tmp_ranks = array();
    foreach ($records as $personId => $value) {
      $tmp_ranks[$personId] = $value['record'];
    }
    array_multisort($tmp_ranks, SORT_ASC, $records);

    return $records;
  }
}
