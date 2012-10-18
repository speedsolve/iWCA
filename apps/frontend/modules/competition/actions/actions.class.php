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
    $this->results = CompetitionsTable::getInstance()->getCompetition($competitionId);
    $this->results['latitude']  = CompetitionsService::getChangeCoordinates($this->results['latitude']);
    $this->results['longitude'] = CompetitionsService::getChangeCoordinates($this->results['longitude']);
    $this->events = CompetitionsService::setEvents($this->results);
  }
}
