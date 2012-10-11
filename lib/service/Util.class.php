<?php

/**
 * Utilクラス
 * @author Sinpei Araki
 */
class Util
{
  public static function getChangeRecord($time, $event)
  {
    // Format調整並びにDNF、DNSの判定
    if ($time == 0) return NULL;
    elseif ($time == -1) return 'DNF';
    elseif ($time == -2) return 'DNS';

    // For Fewest Moves
    if ($event == '333fm') {
      $record = $time;
    } elseif ($event == '333mbf') {
      // For Multi Blindfolded
      // 個数取得
      // 挑戦数から失敗した数を引いた差
      $difference = 99 - substr($time, 0, 2);

      // ミスした数(一桁と二桁での取得の仕方により分岐)
      if (substr($time, -2, 1) == 0 ) {
        $missed = substr($time, -1, 1);
      } else if (substr($time, -2, 1) != 0 ) {
        $missed = substr($time, -2, 2);
      }

      $solved    = $difference + $missed;
      $attempted = $solved     + $missed;
      $record1   = $solved.'/'.$attempted;
      // タイム
      if (substr($time, 3, 1) == 0 ) {
        $seconds = substr($time, 4, 3);
      } else if (substr($time, 3, 1) != 0 ) {
        $seconds = substr($time, 3, 4);
      }

      if ($seconds == 3600) {
        $record2 = '1:00:00';
      } else {
        $minutes = floor($seconds / 60);
        $seconds = $seconds - $minutes * 60;
        if ($seconds < 10) $seconds = '0'.$seconds;
        $record2 = $minutes.':'.$seconds;
      }
      $record = $record1.' '.$record2;
    } else {
      //For Other Events
      //1分未満のタイム
      if ($time < 6000) {
        $milliseconds = substr($time, -2);
        $seconds = substr($time, 0, -2);
        if ($seconds == NULL) $seconds = 0;
        $record = $seconds.'.'.$milliseconds;
      //1分以上のタイム
      } else if ($time < 360000) {
        $milliseconds = substr($time, -2);
        $seconds = substr($time, 0, -2);
        $minutes = floor($seconds / 60);
        $seconds = $seconds - $minutes * 60;
        if ($seconds < 10) $seconds = '0'.$seconds;
        $record = $minutes.':'.$seconds.'.'.$milliseconds;
      //1時間以上のタイム
      } else {
        $milliseconds = substr($time, -2);
        $seconds = substr($time, 0, -2);
        $minutes = floor($seconds / 60);
        $seconds = $seconds - $minutes * 60;
        $hour = floor($minutes / 60);
        $minutes = $minutes - $hour * 60;
        if ($seconds < 10) $seconds = '0'.$seconds;
        if ($minutes < 10) $minutes = '0'.$minutes;
        $record = $hour.':'.$minutes.':'.$seconds.'.'.$milliseconds;
      }
    }

    return $record;
  }

  public static function adjustRank($results, $type)
  {
    $i = 1;
    $j = NULL;
    $k = NULL;

    foreach($results as &$result) {
      $result['rank'] = 0;

      if ($result[$type] == $j) {
        $result['rank'] = $k;
        $i++;
      } else {
        $result['rank'] = $k + $i;
        $i = 1;
        $j = $result[$type];
      }
      $k = $result['rank'];
    }

    return $results;
  }
}
