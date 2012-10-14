<?php

/**
 * ResultsTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ResultsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ResultsTable
     */
    public static function getInstance()
    {
      return Doctrine_Core::getTable('Results');
    }

    /**
     * 単発記録のレコードを取得します
     * @param region  国
     * @param eventId 種目
     * @param years   年
     * @param gender  性別
     * @return 記録
     */
    public function getSingleRecord($region, $eventId, $years, $gender)
    {
       $query = $this->createQuery();
       $query->select('personid, personname, personcountryid, best, eventid, competitionid');

       if ($gender != 'Female') {
         Query::singleRecord(&$query, $region);
       }

       Query::recordEventId(&$query, $eventId);

       if ($years) {
         Query::years(&$query, $years);
       }

       if ($gender) {
         Query::gender(&$query, $gender);
       }

       $query->orderBy('id DESC');
       $query->useResultCache(true);

       $results = $query->fetchArray();

       $query->free();
       unset($query);

       return $results;
    }

    /**
     * 平均記録のレコードを取得します
     * @param region  国
     * @param eventId 種目
     * @param years   年
     * @param gender  性別
     * @return 記録
     */
    public function getAverageRecord($region, $eventId, $years, $gender)
    {
       $query = $this->createQuery();
       $query->select('personid, personname, eventid, personcountryid, average, value1, value2, value3, value4, value5, competitionid');

       if ($gender != 'Female') {
         Query::averageRecord(&$query, $region);
       }

       Query::recordEventId(&$query, $eventId);

       if ($years) {
         Query::years(&$query, $years);
       }

       if ($gender) {
         Query::gender(&$query, $gender);
       }

       $query->orderBy('id DESC');
       $query->useResultCache(true);

       $results = $query->fetchArray();

       $query->free();
       unset($query);

       return $results;
    }
}
