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
      $memcache->set('cubecomps_list', $this->live_list, 60);
    }

    foreach ($this->live_list as $key => $some_list) {
      foreach ($some_list as $list) {
          $memcache->set('comps_name_' . $list['id'], $list['name'], 86400);
      }
    }

    unset($memchache);
  }

  public function executePast(sfWebRequest $request)
  {
    $memcache = new sfMemcacheCache();
    $this->past_list = $memcache->get("cubecomps_past");
    if (!$this->past_list) {
      $json_list = file_get_contents(sfConfig::get('app_cubecomps_past_url'));
      $this->past_list = json_decode($json_list, true);
      $memcache->set('cubecomps_past', $this->past_list, 60);
    }

    foreach ($this->past_list as $key => $some_list) {
      foreach ($some_list as $list) {
          $memcache->set('comps_name_' . $list['id'], $list['name'], 86400);
      }
    }

    unset($memchache);
  }

  public function executeEvent(sfWebRequest $request)
  {
    $competitionId = $request->getParameter('competitionId');
    $url = sprintf(sfConfig::get('app_cubecomps_event_url'), $competitionId);
    $json_event = file_get_contents($url);
    $this->event_list = json_decode($json_event, true);

    $memcache = new sfMemcacheCache();
    $this->name = $memcache->get('comps_name_' . $competitionId);
    if (!$this->name) {
      $this->redirect('live/list');
    }

    $this->rounds = array();
    foreach ($this->event_list as $lists) {
      foreach ($lists['rounds'] as $list) {
        // キャッシュセット
        $memcache->set('name_' . $competitionId. '_' . $list['event_id'] . '_' . $list['id'], array('compName' => $this->name, 'eventName' => $lists['name'], 'roundName' => $list['name']), 60 * 60 * 6);
      }
    }
    unset($memcache);
  }

  public function executeDetail(sfWebRequest $request)
  {
    $competitionId    = $request->getParameter('competitionId');
    $eventId          = $request->getParameter('eventId');
    $roundId          = $request->getParameter('id');
    $url = sprintf(sfConfig::get('app_cubecomps_detail_url'), $competitionId, $eventId, $roundId);
    $json_detail = file_get_contents($url);
    $this->detail_list = json_decode($json_detail, true);
    foreach ($this->detail_list as $key => &$list) {
      $list['average'] ? $this->type = 'average' : 'mean';
      $list['name'] = Util::removeParenthesis($list['name']);
    }
    unset($list);

    $memcache = new sfMemcacheCache();
    $this->names = $memcache->get('name_' . $competitionId. '_' . $eventId . '_' . $roundId);
    if (!$this->names) {
      $this->redirect('live/list');
    }
    unset($memcache);
  }
}
