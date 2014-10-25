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
   * ２点間の直線距離を求める（Lambert-Andoyer）
   *
   * @see http://www.gadgety.net/shin/web/php/distance.html
   * @param   float   $lat1       始点緯度(十進度)
   * @param   float   $lon1       始点経度(十進度)
   * @param   float   $lat2       終点緯度(十進度)
   * @param   float   $lon2       終点経度(十進度)
   * @return  float               距離（Km）
   */
  public static function calcDistance($lat1, $lon1, $lat2, $lon2)
  {
      // WGS84
      $A = 6378137.0;             // 赤道半径
      $F = 1 / 298.257222101;     // 扁平率

      // 扁平率 F = (A - B) / A
      $B = $A * (1.0 - $F);       // 極半径

      $lat1 = deg2rad($lat1);
      $lon1 = deg2rad($lon1);
      $lat2 = deg2rad($lat2);
      $lon2 = deg2rad($lon2);

      $P1 = atan($B/$A) * tan($lat1);
      $P2 = atan($B/$A) * tan($lat2);

      // Spherical Distance
      $sd = acos(sin($P1)*sin($P2) + cos($P1)*cos($P2)*cos($lon1-$lon2));

      // Lambert-Andoyer Correction
      $cos_sd = cos($sd/2);
      $sin_sd = sin($sd/2);
      $c = (sin($sd) - $sd) * pow(sin($P1)+sin($P2),2) / $cos_sd / $cos_sd;
      $s = (sin($sd) + $sd) * pow(sin($P1)-sin($P2),2) / $sin_sd / $sin_sd;
      $delta = $F / 8.0 * ($c - $s);

      // Geodetic Distance
      $distance = $A * ($sd + $delta);

      return $distance / 1000.0;
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
