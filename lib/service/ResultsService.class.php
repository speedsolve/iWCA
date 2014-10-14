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
  public static function setData (&$results)
  {
     foreach ($results as &$result) {

        foreach (sfConfig::get('app_event_id') as $event => $value) {
          if ((string)$event === (string)$result['eventid']) {
            $result['eventname'] = $value['cellname'];
          }
        }

        if (isset($result['best'])) {
          $result['best'] = Util::getChangeRecord($result['best'], $result['eventid'], 'single');
          for ($i = 1; $i <= 5; $i++) {
            if (isset($result['value'.$i]) && $result['value'.$i] != 0) {
              $result['subrecord'][$i] = Util::getChangeRecord($result['value'.$i], $result['eventid'], 'single');
            }
          }
        }

        if (isset($result['average'])) {
          $result['average'] = Util::getChangeRecord($result['average'], $result['eventid'], 'average');

          for ($i = 1; $i <= 5; $i++) {
            if ($result['value'.$i] != 0) {
              $result['subrecord'][$i] = Util::getChangeRecord($result['value'.$i], $result['eventid'], 'single');
            }
          }

          Util::parenthesis(&$result);
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

        // ()除去
        $result['personname'] = Util::removeParenthesis($result['personname']);
     }
  }

  /**
   * Current Recordを取得する
   */
  public static function getCurrentRecord($results, $type)
  {
    $record = array();
    $person = array();
    // イベントごとに現行記録を抽出する
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      foreach ($results as &$result) {
        if ((string)$event === (string)$result['eventid']) {

          //まずは最初のレコードを代入する。基本的にはこれが現行の最高記録であるはず。
          if (!isset($record[$event]) && $result[$type] > 0) {
            $record[$event][] = $result;
          }

          //現在代入されているレコードより小さい値があればunsetし、代入。
          if (isset($record[$event]) && $record[$event][0][$type] > $result[$type] && $result[$type] > 0) {
            unset($record[$event]);
            $record[$event][] = $result;

            //同じ値であるならば、追加代入する。
          } elseif (isset($record[$event]) && $record[$event][0][$type] === $result[$type] && $result[$type] > 0) {
            //同一人物、同一レコードである場合は入れない。
            if ($record[$event][0]['personid'] != $result['personid'] && !in_array($result['personid'], $person)) {
              $record[$event][] = $result;
              $person[] = $result['personid'];
            }
          }
        }
      }
    }

    $results = array();
    foreach ($record as $values) {
      foreach ($values as $value) {
        $results[] = $value;
      }
    }

    return $results;
  }

  /**
   * 大会数計算
   */
  public static function getCompetitionCount($results)
  {
      $competitions = array();
      foreach ($results as $result) {
        if (!in_array($result['competitionid'], $competitions)) {
          $competitions[] = $result['competitionid'];
        }
      }

      return count($competitions);
  }

  /**
   * 入賞回数計算
   */
  public static function getPrizeCount($results)
  {
      $prize = array();
      foreach ($results as $result) {
        if ($result['pos'] <= 3 && $result['best'] > -1 && ($result['roundid'] == 'f' || $result['roundid'] == 'c')) {
          $prize[$result['pos']] += 1;
        }
      }

      return $prize;
  }

  /**
   * 歴代記録取得
   */
  public static function getHistoryRecord($results)
  {
    $history = array();
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      foreach ($results as $result) {
        if ((string)$event == (string)$result['eventid'] && ($result['regionalsinglerecord'] == 'WR' || $result['regionalaveragerecord'] == 'WR')) {
          $history['world'][$event][] = $result;
        }
        if ((string)$event == (string)$result['eventid'] && ($result['regionalsinglerecord'] == 'NR' || $result['regionalaveragerecord'] == 'NR')) {
          $history['national'][$event][] = $result;
        }
        if ((string)$event == (string)$result['eventid'] && (in_array($result['regionalsinglerecord'], sfConfig::get('app_record_id')) || in_array($result['regionalaveragerecord'], sfConfig::get('app_record_id')))) {
          $history['continent'][$event][] = $result;
        }
      }
    }

    return $history;
  }

  /*
   * 大会記録取得
   */
  public static function getCompetitionRecord($results)
  {
    $competitions = array();
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      foreach ($results as $result) {
        if ($result['eventid'] === (string)$event) {
          $competitions[$event][$result['competitionid']][] = $result;
        }
      }
    }

    return $competitions;
  }

  /*
   * 大会勝者取得
   * @params データフォーマット後の結果
   */
  public static function getCompetitionWinner($results)
  {
    $winners = array();
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      foreach ($results as $result) {
        if ($result['eventid'] === (string)$event && ($result['roundid'] == 'Combined Final' || $result['roundid'] === 'Final') && $result['pos'] <= 3) {
          if ($result['best'] != 'DNF' && $result['best'] != 'DNS' && $result['average'] != 'DNF' && $result['average'] != 'DNS') {
            $winners[$event][] = $result;
          }
        }
      }
    }

    return $winners;
  }

  /*
   * 大会結果取得
   * @params データフォーマット後の結果
   */
  public static function getCompetitionResults($results, $eventId = NULL)
  {
    $competition_results = array();
    foreach ($results as $result) {
      if ($eventId) {
        // 特定のイベントの記録
        if ($result['eventid'] === (string)$eventId) {
          $competition_results[$eventId][$result['roundid']][] = $result;
        }
      } else {
        // イベントごとの記録
        foreach (sfConfig::get('app_event_id') as $event => $value) {
          if ($result['eventid'] === (string)$event) {
            $competition_results[$event][$result['roundid']][] = $result;
          }
        }
      }
    }

    return $competition_results;
  }

  /*
   * 大会種目取得
   */
  public static function getCompetitionEvents($results)
  {
    $events = array();
    foreach (sfConfig::get('app_event_id') as $event => $value) {
      foreach ($results as $result) {
        if ($result['eventid'] === (string)$event) {
            $events[$event] = $value['cellname'];
        }
      }
    }

    return $events;
  }
}
