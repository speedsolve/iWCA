<?php

/**
 * SinglesTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SinglesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object SinglesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Singles');
    }

    /**
     * シングルランキングを取得。
     * @param type    0:Ranking 1:Result
     * @param eventId イベント
     * @param region  地域
     * @param years   年
     * @param gender  性別
     * @return array  結果
     */
    public function getRanking($type, $eventId, $region, $years, $gender, $limit, $offset)
    {
      $query = $this->createQuery();
      $query->select('single, eventid, personid, personname, personcountryid, competitionname');
      Query::eventId(&$query, $eventId);

      if ($region && $region != sfConfig::get('app_region_default')) {
        Query::region(&$query, $region);
      }

      if ($years) {
        Query::years(&$query, $years);
      }

      if ($gender) {
        Query::gender(&$query, $gender);
      }

      if ($type) {
        Query::groupBy(&$query, 'personid');
      }

      if ($limit) {
        Query::limit(&$query, $limit);
      }

      if ($offset) {
        Query::offset(&$query, $offset);
      }
      $query->orderBy('single, personname ASC');
      $query->useResultCache(true);

      $results = $query->fetchArray();

      $query->free();
      unset($q);

      return $results;
    }
}
