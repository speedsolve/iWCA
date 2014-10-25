<?php

/**
 * Competitions 汎用クラス
 * @auther Sinpei Araki
 */

class CompetitionsService
{
  /**
   * 大会場所等パース
   * @param data データ
   */
  public function separateData ($data)
  {
    if (preg_match_all('[{(.*?)}{(.*?)}]', $data, $string)) {
      $parse = array();
      foreach ($string[1] as $str) {
        $parse['string'][] = $str;
      }
      foreach ($string[2] as $path) {
        $parse['path'][] = $path;
      }
      return $parse;
    } else {
      return $data;
    }
  }

  /**
   * 緯度経度をパースする
   */
  public static function getChangeCoordinates($point)
  {
    if (strlen($point) == 7) {
      $pre   = substr($point, 0, 1);
      $after = substr($point, 1, 6);
      $point = $pre.'.'.$after;
    } else if (strlen($point) == 8) {
      $pre   = substr($point, 0, 2);
      $after = substr($point, 2, 6);
      $point = $pre.'.'.$after;
    } else if (strlen($point) == 9) {
      $pre   = substr($point, 0, 3);
      $after = substr($point, 3, 6);
      $point = $pre.'.'.$after;
    } else if (strlen($point) == 10) {
      $pre   = substr($point, 0, 4);
      $after = substr($point, 4, 6);
      $point = $pre.'.'.$after;
    }
    return $point;
  }

  /**
   * 開催競技を取得する
   */
  public static function setEvents($results)
  {
    $events = array();
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      if (strpos($results['eventspecs'], (string)$event) !== false) {
        $events[$event] = $value['cellname'];
      }
    }
    return $events;
  }

  /**
   * ラウンドごとに置き換える
   */
  public static function getRoundScrambles($results)
  {
    $rounds = array();

    foreach (sfConfig::get('app_round_reverse_id') as $roundId => $round) {
      foreach ($results as $result) {
        if (isset($result['roundid']) && (string)$result['roundid'] == (string)$roundId) {
          $groupId = $result['groupid'];
          $rounds[$round['name']][$groupId][] = array('scramblenum' => $result['scramblenum'], 'isextra' => $result['isextra'], 'scramble' => $result['scramble']);
        }
      }
    }

    return $rounds;
  }

  /**
   * 大会移動距離
   */
  public static function getCompetitionDistance($results)
  {
      $competitionIds = array();
      foreach ($results as $result) {
        $competitionIds[] = $result['competitionid'];
      }

      // 2大会ないと距離が測れない
      if (count($competitionIds) < 2) {
        return 0;
      }

      $competitions = CompetitionsTable::getInstance()->getCompetitions(array_unique($competitionIds));

      $distance = 0;
      $preKey = '';
      foreach ($competitions as $key => $competition) {
        if ($key >= 1) {
          $distance += self::calcDistance($competitions[$key - 1]['latitude'] / 1000000, $competitions[$key - 1]['longitude']  / 1000000, $competitions[$key]['latitude'] / 1000000, $competitions[$key]['longitude'] / 1000000);
        }
      }

      return $distance;
  }

  /**
   * 距離計算
   * @see http://kudakurage.hatenadiary.com/entry/20100319/1268986000
   */
  public static function calcDistance($lat1, $lon1, $lat2, $lon2)
  {
      // 2点の緯度の平均
      $lat_average = deg2rad($lat1 + (($lat2 - $lat1) / 2));
      // 2点の緯度差
      $lat_difference = deg2rad($lat1 - $lat2);
      // 2点の経度差
      $lon_difference = deg2rad($lon1 - $lon2);
      $curvature_radius_tmp = 1 - 0.00669438 * pow(sin($lat_average), 2);
      // 子午線曲率半径
      $meridian_curvature_radius = 6335439.327 / sqrt(pow($curvature_radius_tmp, 3));
      // 卯酉線曲率半径
      $prime_vertical_circle_curvature_radius = 6378137 / sqrt($curvature_radius_tmp);

      // 2点間の距離
      $distance = pow($meridian_curvature_radius * $lat_difference, 2) + pow($prime_vertical_circle_curvature_radius * cos($lat_average) * $lon_difference, 2);
      $distance = sqrt($distance) / 1000;

      return $distance;
  }

  /**
   * イベント情報を取得する
   */
  public static function getEventInfo($eventId)
  {
     $event = sfConfig::get('app_event_id');
     return $event[$eventId];
  }
}
