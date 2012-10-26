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
}
