<?php

class databaseTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'iwca';
    $this->name             = 'database';
    $this->briefDescription = 'database auto update';
    $this->detailedDescription = <<<EOF
The [database|INFO] task does things.
Call it with:

  [php symfony database|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {

    // add your code here
    include(sfConfig::get('sf_lib_dir').'/php/simple_html_dom.php');
    // go to lib
    chdir(sfConfig::get('sf_data_dir').'/sql/wca');

    $html = file_get_html('http://www.worldcubeassociation.org/results/misc/export.html');
    $url = array();
    foreach ($html->find('dt a') as $children) {
      $url[] = $children->innertext;
    }

    //保存したSQLのファイル名、ファイルサイズ取得
    $filename = array();
    $filesize = array();
    if ($handle = opendir(sfConfig::get('sf_data_dir').'/sql/wca')) {
      while (false !== ($file = readdir($handle))) {
        $filename[] = $file;
        $filesize[] = filesize(sfConfig::get('sf_data_dir').'/sql/wca/'.$file);
      }
      closedir($handle);
    }

    //すでに更新したSQLを再度更新しない。
    //ファイルサイズチェック
    if (!in_array($url[0], $filename)) {
      chdir(sfConfig::get('sf_lib_dir').'/sh');

      //今回のSQLファイルを取得する。//あとで一旦削除する。
      if (file_exists(sfConfig::get('sf_root_dir').'/data/sql/'.$url[0]) === false) {
        shell_exec('wget http://www.worldcubeassociation.org/results/misc/'.$url[0]);
      }

      $currentSQLSize = filesize($url[0]);
      $storeSQLSize = max($filesize);

      if ($currentSQLSize > $storeSQLSize * 1.3) {
        return;
      } else {
        shell_exec('rm '.$url[0]);
        $log = shell_exec('sh db.sh '.$url[0]);
        $this->log($log);
        // 最後にキャッシュクリア
        chdir(sfConfig::get('sf_root_dir'));
        shell_exec('symfony cc');
      }
    }
  }
}
