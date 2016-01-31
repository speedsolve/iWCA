<?php

/**
 * person actions.
 *
 * @package    iwca
 * @subpackage person
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personActions extends sfActions
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
    $region  = $request->getParameter('region');
    $gender  = $request->getParameter('gender');
    $keyword = $request->getParameter('keyword');
    $type    = $request->getParameter('type');

    $results = PersonsTable::getInstance()->getPersons($region, $gender, $keyword, $type);

    foreach ($results as &$result) {
      $result['name'] = Util::removeParenthesis($result['name']);
    }

    $this->type    = $type;
    $this->results = $results;
  }

  public function executeDetail(sfWebRequest $request)
  {
    $id             = $request->getParameter('id');
    $single_ranks   = RanksSingleTable::getInstance()->getPersonalRanks($id);
    $average_ranks  = RanksAverageTable::getInstance()->getPersonalRanks($id);
    $results        = ResultsTable::getInstance()->getPersonalResults($id);

    // 大会結果側のためにResultsをキャッシュする
    $memcache = new sfMemcacheCache();
    $memcache->set($id, $results, 86400);
    unset($memcache);

    // 全記録にデータを付与する
    $singles        = ResultsService::getCurrentRecord($results, 'best');
    $averages       = ResultsService::getCurrentRecord($results, 'average');
    ResultsService::setData(&$singles);
    ResultsService::setData(&$averages);

    $prizes = ResultsService::getPrizeCount($results);
    if (!empty($prizes)) {
      ksort($prizes);
      $this->prizes = $prizes;
    }
    $this->person         = PersonsTable::getInstance()->getPerson($id);
    $this->person['name'] = Util::removeParenthesis($this->person['name']);
    $this->single_ranks   = Util::setEventKey($single_ranks);
    $this->singles        = Util::setEventKey($singles);
    $this->averages       = Util::setEventKey($averages);
    $this->average_ranks  = Util::setEventKey($average_ranks);
    ResultsService::setData(&$results);
    $this->histories      = ResultsService::getHistoryRecord($results);
    $podiums              = ResultsService::getPodiums($results);
    $this->world_podiums  = $podiums['world'];
    $this->asian_podiums  = $podiums['asian'];
    $this->euro_podiums   = $podiums['euro'];
    $this->competition_count = ResultsService::getCompetitionCount($results);
    $this->distance = CompetitionsService::getCompetitionDistance($results);
  }

  public function executeResults(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    $this->eventId = $request->getParameter('eventId');

    $memcache = new sfMemcacheCache();
    $results = $memcache->get($id);
    unset($memcache);
    if (!$results) {
      $results = ResultsTable::getInstance()->getPersonalResults($id);
    }

    ResultsService::setData(&$results);
    $this->competitions = ResultsService::getCompetitionRecord($results);
  }
}
