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
  }

  public function executeAverage(sfWebRequest $request)
  {
  }
}
