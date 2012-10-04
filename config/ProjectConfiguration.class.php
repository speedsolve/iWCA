<?php

require_once '/usr/share/pear/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
     $this->enablePlugins('sfDoctrinePlugin');
  }

  public function configureDoctrine(Doctrine_Manager $manager)
  {
      // 設定の配列を追加して、利用するmemcachedサーバを追加できます
      $servers = array(
          array(
              'host' => 'localhost',
              'port' => 11211,
              'persistent' => true),
          );
      $cacheDriver = new Doctrine_Cache_Memcache(array(
          'servers' => $servers,
          'compression' => false));
      $manager->setAttribute(Doctrine_Core::ATTR_QUERY_CACHE, $cacheDriver);
      $manager->setAttribute(Doctrine_Core::ATTR_QUERY_CACHE_LIFESPAN, 3600);
      $manager->setAttribute(Doctrine_Core::ATTR_RESULT_CACHE, $cacheDriver);
      $manager->setAttribute(Doctrine_Core::ATTR_RESULT_CACHE_LIFESPAN, 3600);
  }
}
