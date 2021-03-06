<?php

/**
 * CompetitionsTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CompetitionsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CompetitionsTable
     */
    public static function getInstance()
    {
      return Doctrine_Core::getTable('Competitions');
    }

    /**
     * 大会を取得する
     * @params CompetitionId
     * @return 大会データ
     */
    public function getCompetition($id)
    {
      $query = $this->createQuery();
      $query->where('id = ?', $id);
      $query->useResultCache(true);

      $results = $query->fetchOne();

      $query->free();
      unset($query);

      return $results;
    }

    /**
     * 大会を取得する
     * @params CompetitionId
     * @return 大会データ
     */
    public function getCompetitions($ids)
    {
      $query = $this->createQuery();
      $query->whereIn('id', $ids);
      $query->useResultCache(true);

      $results = $query->fetchArray();

      $query->free();
      unset($query);

      return $results;
    }

    /**
     * 大会リストを取得する
     * @params eventId イベントID
     * @params region 地域
     * @params years 年
     * @parasm 検索文字列
     * @return 大会リスト
     */
    public function getCompetitionList($eventId, $region, $years, $keyword, $limit = NULL)
    {
      $query = $this->createQuery();
      $query->select('cellname, cityname, countryid, continentid, year, month, day, endmonth, endday');

      if ($eventId) {
        Query::competitionEvent(&$query, $eventId);
      }

      if ($region) {
        Query::competitionRegion(&$query, $region);
      }

      if ($years && !$keyword) {
        Query::years(&$query, $years);
      }

      if ($keyword) {
        Query::keyword(&$query, $keyword);
      }

      if ($limit) {
        Query::limit(&$query, $limit);
      }

      $query->useResultCache(true);

      $results = $query->fetchArray();
      $query->free();
      unset($query);

      return $results;
    }
}
