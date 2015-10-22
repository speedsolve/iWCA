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
    $this->competition  = CompetitionsTable::getInstance()->getCompetition($competitionId);
    $this->events       = CompetitionsService::setEvents($this->competition);
    $this->venue        = CompetitionsService::separateData($this->competition['venue']);
    $this->website      = CompetitionsService::separateData($this->competition['website']);
    $this->wcadelegates = CompetitionsService::separateData($this->competition['wcadelegate']);
    $this->competitorNumber = count(ResultsTable::getInstance()->getCompetitionResultsByPersonId($competitionId));

    $memcache = new sfMemcacheCache();
    $this->results = $memcache->get($competitionId);

    if (!$this->results) {
      $this->results = ResultsTable::getInstance()->getCompetitionResults($competitionId);
      $memcache->set($competitionId, $this->results, 86400);
      unset($memcache);
    }

    if (!empty($this->results)) {
      ResultsService::setData($this->results);
      $this->winners = ResultsService::getCompetitionWinner($this->results);
      $this->events  = ResultsService::getCompetitionEvents($this->results);
      // 判定が難しいのでフラグを渡す
      $this->end = true;
    }
  }

  public function executeResults(sfWebRequest $request)
  {
    $this->competitionId = $request->getParameter('competitionId');
    $this->eventId = $request->getParameter('eventId');

    $memcache = new sfMemcacheCache();
    $results = $memcache->get($this->competitionId);
    if (!$results) {
      $results = ResultsTable::getInstance()->getCompetitionResults($this->competitionId);
    }

    ResultsService::setData($results);
    $this->competition_results = ResultsService::getCompetitionResults($results, $this->eventId);

    $this->isScramble = false;
    $results = ScramblesTable::getInstance()->getScrambles($this->competitionId, $this->eventId);
    if ($results) {
      $this->isScramble = true;
    }
  }

  public function executeMap(sfWebRequest $request)
  {
    $competitionId = $request->getParameter('competitionId');
    $competition = CompetitionsTable::getInstance()->getCompetition($competitionId);
    $this->latitude  = CompetitionsService::getChangeCoordinates($competition['latitude']);
    $this->longitude = CompetitionsService::getChangeCoordinates($competition['longitude']);
  }

  public function executeScrambles(sfWebRequest $request)
  {
    $competitionId = $request->getParameter('competitionId');
    $eventId = $request->getParameter('eventId');
    $this->competition = CompetitionsTable::getInstance()->getCompetition($competitionId);

    $results = ScramblesTable::getInstance()->getScrambles($competitionId, $eventId);
    $this->event = CompetitionsService::getEventInfo($eventId);
    $this->scrambles = CompetitionsService::getRoundScrambles($results);

    foreach (sfConfig::get('app_event_id') as $event => $value) {
      if ($event == $eventId && $value['shortid'] > 0) {
        $this->shortId = $value['shortid'];
      }
    }
  }
}
