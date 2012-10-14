<?php

/**
 * record actions.
 *
 * @package    iwca
 * @subpackage record
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class recordActions extends sfActions
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
    $history = $request->getParameter('history');

    if ($gender == 'Female' && !$history) {
      $results = NULL;
    } else {
      $results = ResultsTable::getInstance()->getSingleRecord($region, $eventId, $years, $gender);

      // Currentの場合修正
      if ($history) {
        $results = ResultsService::getCurrentRecord($results, 'best');
      }

      ResultsService::setData(&$results);
    }

    $this->results = $results;
  }

  public function executeAverage(sfWebRequest $request)
  {
    $eventId = $request->getParameter('eventId');
    $region  = $request->getParameter('region');
    $years   = $request->getParameter('years');
    $gender  = $request->getParameter('gender');
    $history = $request->getParameter('history');

    if ($gender == 'Female' && !$history) {
      $results = NULL;
    } else {
      $results = ResultsTable::getInstance()->getAverageRecord($region, $eventId, $years, $gender);

      // Currentの場合修正
      if ($history) {
        $results = ResultsService::getCurrentRecord($results, 'average');
      }

      ResultsService::setData(&$results);
    }

    $this->results = $results;
  }
}
