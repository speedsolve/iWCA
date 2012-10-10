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
     * 純粋なシングルランキングを取得。
     * 同一人物が重複する。
     * @param eventId イベント
     * @param region  地域
     * @param years   年
     * @param gender  性別
     * @return array  結果
     */
    public function getRankingOfResult($eventId, $region, $years, $gender, $limit, $offset)
    {
      $query = $this->createQuery();
      // 必要な項目だけ。
      $query->select('single, eventid, personid, personname, personcountryid, competitionid');
      $query->andWhere('eventid = ?', $eventId);

      if ($region && $region != sfConfig::get('app_region_default')) {
        Query::region(&$query, $region);
      }

      if ($years) {
        Query::year(&$query, $gender);
      }

      if ($gender) {
        Query::gender(&$query, $gender);
      }

      if ($limit) {
        Query::offset(&$query, $limit);
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