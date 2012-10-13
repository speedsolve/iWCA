<?php

/**
 * Doctrine Query 汎用クラス
 * @auther Sinpei Araki
 */

class Query
{
  public static function region(&$query, $region)
  {
    if (in_array($region, sfConfig::get('app_name_continents'))) {
      $query->andWhere('continentid = ?', $region);
    } else {
      $query->andWhere('personcountryid = ?', $region);
    }
  }

  public static function years(&$query, $years)
  {
    if ($years == 'Current') {
      $from = date('Y') - 1;
      $to   = date('Y') + 1;
      $query->andWhere('year between ? and ?', array($from, $to));
    } elseif (substr($years, 4, 1) == '-') {
      $from = substr($years, 0, 4);
      $to   = substr($years, 5, 4);
      $query->andWhere('year >= ?', $from);
      $query->andWhere('year <= ?', $to);
    } else {
      $query->andWhere('year = ?', $years);
    }
  }

  public static function gender(&$query, $gender)
  {
    $query->andWhere('gender = ?', $gender);
  }

  public static function groupBy(&$query, $groupBy)
  {
    $query->groupBy($groupBy);
  }

  public static function limit(&$query, $limit)
  {
    $query->limit($limit);
  }

  public static function offset(&$query, $offset)
  {
    $query->offset($offset);
  }

  public static function competitionEvent(&$query, $eventId)
  {
    $query->andWhere('eventspecs like ?', '%'.$eventId.'%');
  }

  public static function keyword(&$query, $keyword)
  {
    $keyword = '%'.$keyword.'%';
    $query->andWhere('name like ? or cityname like ? or venue like ?', array($keyword, $keyword, $keyword));
  }
}
