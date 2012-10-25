<?php

/**
 * competition actions.
 *
 * @package    iwca
 * @subpackage competition
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class competitionActions extends sfActions
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

  public function executeList(sfWebRequest $request)
  {
    $eventId = $request->getParameter('eventId');
    $region  = $request->getParameter('region');
    $years   = $request->getParameter('years');
    $keyword = $request->getParameter('keyword');
    if ($years == 'Current') {
        $limit = 100;
    }
    $this->results = CompetitionsTable::getInstance()->getCompetitionList($eventId, $region, $years, $keyword, $limit);
  }

  public function executeDetail(sfWebRequest $request)
  {
    $competitionId = $request->getParameter('competitionId');
    $this->competition = CompetitionsTable::getInstance()->getCompetition($competitionId);
    $this->events  = CompetitionsService::setEvents($this->competition);
    $this->venue   = CompetitionsService::separateData($this->competition['venue']);
    $this->website = CompetitionsService::separateData($this->competition['website']);

    $memchache = new sfMemcacheCache();
    $this->results = $memchache->get($competitionId);

    if (!$this->results) {
      $this->results = ResultsTable::getInstance()->getCompetitionResults($competitionId);
      $memchache->set($competitionId, $this->results, 86400);
      unset($memchache);
    }

    if (!empty($this->results)) {
      ResultsService::setData($this->results);
      $this->winners = ResultsService::getCompetitionWinner($this->results);
      // 判定が難しいのでフラグを渡す
      $this->end = true;
    }
  }

  public function executeResults(sfWebRequest $request)
  {
    $competitionId = $request->getParameter('competitionId');
    $this->eventId = $request->getParameter('eventId');

    $memchache = new sfMemcacheCache();
    $results = $memchache->get($competitionId);
    if (!$results) {
      $results = ResultsTable::getInstance()->getCompetitionResults($competitionId);
    }

    ResultsService::setData($results);
    $this->competition_results = ResultsService::getCompetitionResults($results, $this->eventId);
  }

  public function executeMap(sfWebRequest $request)
  {
    $competitionId = $request->getParameter('competitionId');
    $competition = CompetitionsTable::getInstance()->getCompetition($competitionId);
    $this->latitude  = CompetitionsService::getChangeCoordinates($competition['latitude']);
    $this->longitude = CompetitionsService::getChangeCoordinates($competition['longitude']);
  }
}
