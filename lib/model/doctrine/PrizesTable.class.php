<?php

/**
 * PrizesTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PrizesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PrizesTable
     */
    public static function getInstance()
    {
      return Doctrine_Core::getTable('Prizes');
    }

    /**
     * 入賞記録を取得します
     * @param region  国
     * @param eventId 種目
     * @param years   年
     * @param gender  性別
     * @return 記録
     */
    public function getPrize($eventId, $region, $years, $gender)
    {
      $query = $this->createQuery();
      $query->select('personid, personname, personcountryid, pos');

      Query::recordEventId(&$query, $eventId);

      if ($years) {
        Query::years(&$query, $years);
      }

      if ($region && $region != sfConfig::get('app_region_default')) {
        Query::region(&$query, $region);
      }

      if ($gender) {
        Query::gender(&$query, $gender);
      }

      $query->useResultCache(true);

      $results = $query->fetchArray();

      $query->free();
      unset($query);

      return $results;
    }
}
