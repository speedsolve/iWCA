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

      $competitions = CompetitionsTable::getInstance()->getCompetitions($competitionIds);

      $distance = 0;
      $preKey = '';
      foreach ($competitions as $key => $competition) {
        if ($preKey) {
          $distance += self::calcDistance($competitions[$preKey]['latitude'], $competitions[$preKey]['longitude'], $competitions[$key]['latitude'], $competitions[$key]['longitude']);
        }
        $preKey = $key;
      }

      return $distance;
  }

  /**
   * 距離計算
   * @see http://emiyou3-tools.appspot.com/geocoding/distance.html
   */
  public static function calcDistance($latitude1, $longitude1, $latitude2, $longitude2)
  {
     // 桁数によって割る値が変わる。
     // ラジアンに変換元の値が1000000倍されてるので割っておく
     $lat1 = ($latitude1 / self::getChangeLength($latitude1)) * pi() / 180;
     $lon1 = ($longitude1 / self::getChangeLength($latitude2)) * pi() / 180;
     $lat2 = ($latitude2 / self::getChangeLength($longitude1)) * pi() / 180;
     $lon2 = ($longitude2 / self::getChangeLength($longitude2)) * pi() / 180;

     // 緯度の平均、緯度間の差、経度間の差
     $latave = ($lat1 + $lat2) / 2;
     $latidiff = $lat1 - $lat2;
     $longdiff = $lon1 - $lon2;

     //子午線曲率半径
     //半径を6335439m、離心率を0.006694で設定してます
     $meridian = 6335439 / sqrt(pow(1 - 0.006694 * sin($latave) * sin($latave),  3));

     //卯酉線曲率半径
     //半径を6378137m、離心率を0.006694で設定してます
     $primevertical = 6378137 / sqrt(1 - 0.006694 * sin($latave) * sin($latave));

     //Hubenyの簡易式
     $x = $meridian * $latidiff;
     $y = $primevertical * cos($latave) * $longdiff;

     return sqrt(pow($x, 2) + pow($y, 2)) / 1000;
  }

  /**
   *
   */
  public static function getChangeLength($point)
  {
     switch (strlen($point)) {
       case 6:
         return 100000;
         break;
       case 7:
         return 1000000;
         break;
       case 8:
         return 1000000;
         break;
       case 9:
         return 1000000;
         break;
     }
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
