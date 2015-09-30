<?php

/**
 * RanksAverageTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RanksAverageTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object RanksAverageTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('RanksAverage');
    }

    /**
     * ランク記録を取得します
     * @param region  国
     * @param years   年
     * @param gender  性別
     * @return 記録
     */
    public function getRank($region, $gender)
    {
      $query = $this->createQuery();
      $query->select('personid, personname, personcountryid, eventid, worldrank, continentrank, countryrank');

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

    /**
     * ランク人数を取得します
     */
    public function getRankCount($region)
    {
      $query = $this->createQuery();
      $query->select('eventid, count(personid) as count');

      if ($region && $region != sfConfig::get('app_region_default')) {
        Query::region(&$query, $region);
      }

      Query::groupBy(&$query, 'eventid');

      $query->useResultCache(true);

      $results = $query->fetchArray();

      $query->free();
      unset($query);

      return $results;
    }


    public function getPersonalRanks($id)
    {
      $query = $this->createQuery();
      $query->where('personid = ?', $id);

      $query->useResultCache(true);
      $results = $query->fetchArray();

      $query->free();
      unset($query);

      return $results;
    }
}
