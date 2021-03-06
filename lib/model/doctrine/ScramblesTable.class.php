<?php

/**
 * ScramblesTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ScramblesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ScramblesTable
     */
    public static function getInstance()
    {
      return Doctrine_Core::getTable('Scrambles');
    }

    /**
     * スクランブルを取得。
     */
    public function getScrambles($competitionId, $eventId)
    {
      $query = $this->createQuery();
      $query->select('roundId, groupId, isExtra, scrambleNum, scramble');
      $query->andWhere('competitionid = ?', $competitionId);
      $query->andWhere('eventid = ?', $eventId);

      $query->orderBy('id ASC');
      $query->useResultCache(true);

      $results = $query->fetchArray();

      $query->free();
      unset($q);

      return $results;
    }
}
