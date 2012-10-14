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
     * @param history 歴代かどうか
     * @return 記録
     */
    public function getRecordOfSingle($region, $eventId, $years, $history = false)
    {
       $query = $this->createQuery();
       $query->select('personid, personname, personcountryid, best, eventid, competitionid');
       Query::singleRecord(&$query, $region);

       if ($eventid != 'All') {
         Query::eventId(&$query, $eventId);
       }

       if ($years != 'All') {
         Query::years(&$query, $years);
       }

       $query->orderBy('id DESC');
       $query->useResultCache(true);

       $results = $query->fetchArray();

       $query->free();
       unset($query);

       return $results;
    }
}
