<?php

/**
 * information actions.
 *
 * @package    iwca
 * @subpackage information
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class informationActions extends sfActions
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
    // 最終更新日取得
    if ($handle = opendir(sfConfig::get('sf_data_dir').'/sql/wca')) {
      while (false !== ($file = readdir($handle))) {
        $filename[] = $file;
      }
      closedir($handle);
    }

    $days = array();
    foreach ($filename as $file) {
      $days[] = substr($file, 14, 8);
    }

    $this->updated= max($days);
  }
}
