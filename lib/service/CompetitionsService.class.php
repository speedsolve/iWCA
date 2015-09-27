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
    return $point / 1000000;
  }

  /**
   * 国を置換する
   */
  public static function getChangeCountryId($countryId, $continentId)
  {
    if ($countryId == 'XA') {
      $countryId = 'United Nations';
    }
    elseif ($countryId == 'XE') {
      $countryId = 'European Union';
    }
    return $countryId;
  }

  /**
   * 開催競技を取得する
   */
  public static function setEvents($results)
  {
    $events = array();
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      if (preg_match("/\b" . $event. "\b/i", $results['eventspecs'])) {
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
        // 順番を保持しつつユニークに
        if (!in_array($result['competitionid'], $competitionIds)) {
          $competitionIds[] = $result['competitionid'];
        }
      }

      // 2大会ないと距離が測れない
      if (count($competitionIds) < 2) {
        return 0;
      }

      $competitions = CompetitionsTable::getInstance()->getCompetitions($competitionIds);

      $distance = 0;
      foreach ($competitionIds as $key => $id) {
        $compe1 = array();
        $compe2 = array();
        foreach ($competitions as $competition) {
          if ($key >= 1) {
            if ($competitionIds[$key - 1] == $competition['id']) {
              $compe1 = $competition;
            }
            if ($competitionIds[$key] == $competition['id']) {
              $compe2 = $competition;
            }
          }
        }
        if ($compe1 && $compe2) {
          $tmp_distance = self::calcDistance($compe1['latitude'] / 1000000, $compe1['longitude']  / 1000000, $compe2['latitude'] / 1000000, $compe2['longitude'] / 1000000);
          // error_log($compe1['name'] . ' -> ' . $compe2['name'] . ' distance: ' . $tmp_distance . "km");
          $distance += $tmp_distance;
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

      $P1 = atan(($B/$A) * tan($lat1));
      $P2 = atan(($B/$A) * tan($lat2));

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
