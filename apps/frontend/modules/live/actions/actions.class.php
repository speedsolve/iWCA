<?php

/**
 * live actions.
 *
 * @package    iwca
 * @subpackage live
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class liveActions extends sfActions
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
    $memcache = new sfMemcacheCache();
    $this->live_list = $memcache->get("cubecomps_list");
    if (!$this->live_list) {
      $json_list = file_get_contents(sfConfig::get('app_cubecomps_list_url'));
      $this->live_list = json_decode($json_list, true);
      $memcache->set("cubecomps_list", $this->live_list, 86400);
    }
    unset($memchache);
  }
}
