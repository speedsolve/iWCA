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

  public function executeSearch(sfWebRequest $request)
  {
    $region  = $request->getParameter('region');
    $keyword = $request->getParameter('keyword');
    $type    = $request->getParameter('type');

    if ($keyword || $region) {
      $results = PersonsTable::getInstance()->getPersons($region, $keyword, $type);
    }

    foreach ($results as &$result) {
      $result['name'] = Util::removeParenthesis($result['name']);
    }

    $this->type    = $type;
    $this->results = $results;
  }
}
