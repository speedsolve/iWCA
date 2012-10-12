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
    $results = SinglesTable::getInstance()->getRanking($type, $eventId, $region, $years, $gender, 100, 0);

    // ランク追加
    $results = Util::adjustRank($results, 'single');
    foreach ($results as $i => &$result) {
      $result['personname'] = Util::removeParenthesis($result['personname']);
      $result['record']     = Util::getChangeRecord($result['single'], $result['eventid']);
      unset($result['single']);
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
    $results = AveragesTable::getInstance()->getRanking($type, $eventId, $region, $years, $gender, 100, 0);

    // ランク追加
    $results = Util::adjustRank($results, 'average');
    foreach ($results as $i => &$result) {
      $result['personname'] = Util::removeParenthesis($result['personname']);
      $result['record']     = Util::getChangeRecord($result['average'], $result['eventid']);
      unset($result['average']);
      // 各々の記録もフォーマット変更
      for ($j = 1; $j <= 5; $j++) {
        $result['subrecord'][$j] = Util::getChangeRecord($result['value'.$j], $result['eventid']);
        Util::parenthesis(&$result);
        unset($result['value'.$j]);
      }
    }
  }
}
