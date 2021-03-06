<?php

/**
 * Utilクラス
 * @author Sinpei Araki
 */
class Util
{
  public static function removeParenthesis($string)
  {
    $string = preg_replace('/(\(|（).*(\)|）)/', '', $string);
    return $string;
  }

  public static function setEventKey($datas)
  {
    $results = array();
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      foreach($datas as $data) {
         if ($data['eventid'] === (string)$event) {
           $results[$event] = $data;
         }
      }
    }

    return $results;
  }

  public static function getChangeRecord($time, $event, $type)
  {
    // Format調整並びにDNF、DNSの判定
    if ($time == 0) return NULL;
    elseif ($time == -1) return 'DNF';
    elseif ($time == -2) return 'DNS';

    // For Fewest Moves
    if ($event == '333fm' && $type == 'single') {
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

  public static function adjustRank(&$results, $type)
  {
    $i = 1;
    $j = NULL;
    $k = NULL;

    foreach($results as $key => &$result) {
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
  }

  public static function parenthesis(&$result)
  {
    // 比較用のvalueをまとめる。
    $value = array();
    for ($i = 1; $i <= 5; $i++) {
      if ($result['value'.$i] != 0) {
        $value[$i] = $result['value'.$i];
      }
    }

    // 試技が4回以下ならなにもしない。
    if (count($value) < 4) {
      return NULL;
    }

    // DNF,DNSの判定
    $DNF = array_search('-1', $value);
    $DNS = array_search('-2', $value);

    if ($DNF && $DNS) {
      $result['subrecord'][$DNF] = '(DNF)';
      $result['subrecord'][$DNS] = '(DNS)';
    } elseif ($DNF) {
      unset($value[$DNF]);
      $min = min($value);
      $key = array_search($min, $value);
      $result['subrecord'][$key] = '('.$result['subrecord'][$key].')';
      $result['subrecord'][$DNF] = '(DNF)';
    } elseif ($DNS) {
      unset($value[$DNS]);
      $min = min($value);
      $key = array_search($min, $value);
      $result['subrecord'][$key] = '('.$result['subrecord'][$key].')';
      $result['subrecord'][$DNS] = '(DNS)';
    } else {
      $min = min($value);
      $max = max($value);
      $minkey = array_search($min, $value);
      $maxkey = array_search($max, $value);
      $result['subrecord'][$minkey] = '('.$result['subrecord'][$minkey].')';
      $result['subrecord'][$maxkey] = '('.$result['subrecord'][$maxkey].')';
    }
  }

  /**
   * Region Recordを取得する
   */
  public static function getRegionalRecord($results, $type)
  {
    $record = array();
    $person = array();
    // 国ごとに現行記録を抽出する
    foreach ($results as &$result) {
      foreach (sfConfig::get('app_country_id') as $key => $value) {
        if ((string)$value['id'] === (string)$result['personcountryid']) {

          //まずは最初のレコードを代入する。基本的にはこれが現行の最高記録であるはず。
          if (!isset($record[$value['id']]) && $result[$type] > 0) {
            $record[$value['id']][] = $result;
          }

          //現在代入されているレコードより小さい値があればunsetし、代入。
          if (isset($record[$value['id']]) && $record[$value['id']][0][$type] > $result[$type] && $result[$type] > 0) {
            unset($record[$value['id']]);
            $record[$value['id']][] = $result;

            //同じ値であるならば、追加代入する。
          } elseif (isset($record[$value['id']]) && $record[$value['id']][0][$type] === $result[$type] && $result[$type] > 0) {
            //同一人物、同一レコードである場合は入れない。
            if ($record[$value['id']][0]['personid'] != $result['personid'] && !in_array($result['personid'], $person)) {
              $record[$value['id']][] = $result;
              $person[] = $result['personid'];
            }
          }
        }
      }
    }

    // 整形
    $results = array();
    foreach ($record as $values) {
      foreach ($values as $value) {
        $results[] = $value;
      }
    }

    return $results;
  }

  /**
   * 結果を件数で絞る
   */
  public static function getCutResults($results, $limit)
  {
      // 指定レコード分以外は切り捨てる
      $records = array();
      foreach ($results as $result) {

         if ($result['rank'] > $limit) {
           break;
         }

         $records[] = $result;
      }

      return $records;
  }
}
