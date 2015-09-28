<?php

/**
 * ranking actions.
 *
 * @package    iwca
 * @subpackage ranking
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rankingActions extends sfActions
{
  /**
   * preExecute
   * jQuery MobileのAjaxトランジッションで
   * Symfony側がLayoutを外してしまう問題の対応
   */
  public function preExecute()
  {
    $this->setLayout('layout');
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }

  public function executeSingle(sfWebRequest $request)
  {
    $eventId = $request->getParameter('eventId');
    $region  = $request->getParameter('region');
    $years   = $request->getParameter('years');
    $gender  = $request->getParameter('gender');
    $type    = $request->getParameter('type');
    $misc    = $request->getParameter('misc');

    // regionは総レコード検索
    if ($type == 'region') {
      $limit = NULL;
    } else {
      $limit = 100;
    }

    // prize時はデフォルトをnullに
    if ($misc == 'prize' && $eventId == 'event') {
      $eventId = NULL;
    } elseif ($eventId == 'event') {
      $eventId = 333;
    }

    if ($misc == 'prize') {

      $this->type = 'prize';
      $results = PrizesTable::getInstance()->getPrize($eventId, $region, $years, $gender);
      $results = PrizesService::getChangePrize($results, $limit);
      foreach ($results as $i => &$result) {
        $result['personname'] = Util::removeParenthesis($result['personname']);
      }
      Util::adjustRank(&$results, 'record');

    } else {

      // データ取得
      $results = SinglesTable::getInstance()->getRanking($type, $eventId, $region, $years, $gender, $limit, 0);

      // 地域別
      if ($type == 'region') {
        $results = Util::getRegionalRecord($results, 'single');
      }

      // ランク追加
      Util::adjustRank(&$results, 'single');
      foreach ($results as $i => &$result) {
        $result['personname'] = Util::removeParenthesis($result['personname']);
        $result['record']     = Util::getChangeRecord($result['single'], $result['eventid'], 'single');
        unset($result['single']);
      }
    }

    $this->results = $results;
  }

  public function executeAverage(sfWebRequest $request)
  {
    $eventId = $request->getParameter('eventId');
    $region  = $request->getParameter('region');
    $years   = $request->getParameter('years');
    $gender  = $request->getParameter('gender');
    $type    = $request->getParameter('type');

    // デフォルトを置換
    if ($eventId == 'event') {
      $eventId = 333;
    }

    // regionは総レコード検索
    if ($type == 'region') {
      $limit = NULL;
    } else {
      $limit = 100;
    }

    // データ取得
    $results = AveragesTable::getInstance()->getRanking($type, $eventId, $region, $years, $gender, $limit, 0);

    // 地域別
    if ($type == 'region') {
      $results = Util::getRegionalRecord($results, 'average');
    }

    // ランク追加
    Util::adjustRank(&$results, 'average');
    foreach ($results as $i => &$result) {
      $result['personname'] = Util::removeParenthesis($result['personname']);
      $result['record']     = Util::getChangeRecord($result['average'], $result['eventid'], 'average');
      unset($result['average']);
      // 各々の記録もフォーマット変更
      for ($j = 1; $j <= 5; $j++) {
        $result['subrecord'][$j] = Util::getChangeRecord($result['value'.$j], $result['eventid'], 'single');
      }
      // 最後に表示用に整形
      Util::parenthesis(&$result);
    }

    $this->results = $results;
  }
}
