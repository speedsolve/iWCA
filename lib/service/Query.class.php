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

  public static function personRegion(&$query, $region)
  {
    $query->andWhere('countryid = ?', $region);
  }

  public static function competitionRegion(&$query, $region)
  {
    $query->andWhere('countryid = ?', $region);
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

  public static function singleRecord(&$query, $region)
  {
    if ($region == 'World') {
      $query->orWhere('regionalsinglerecord = ?', 'WR');
    } elseif (in_array($region, sfConfig::get('app_name_continents'))) {
      $record = sfConfig::get('app_name_record');
      $query->orWhere('(regionalsinglerecord = ?', 'WR');
      $query->orWhere('regionalsinglerecord = ?)', $record[$region]);
      $query->andWhere('continentid = ?', $region);
    } else {
      $country = sfConfig::get('app_country_id');
      $query->andWhere('(regionalsinglerecord = ? or regionalsinglerecord = ? or regionalsinglerecord = ?) and personcountryid = ?',
        array('WR', $country[$region]['record'], 'NR', $region));
    }
  }

  public static function averageRecord(&$query, $region)
  {
    if ($region == 'World') {
      $query->orWhere('regionalaveragerecord = ?', 'WR');
    } else if (in_array($region, sfConfig::get('app_name_continents'))) {
      $record = sfConfig::get('app_name_record');
      $query->orWhere('(regionalaveragerecord = ?', 'WR');
      $query->orWhere('regionalaveragerecord = ?)',  $record[$region]);
      $query->andWhere('continentid = ?', $region);
    } else {
      $country = sfConfig::get('app_country_id');
      $query->andWhere('(regionalaveragerecord = ? or regionalaveragerecord = ? or regionalaveragerecord = ?) and personcountryid = ?',
        array('WR', $country[$region]['record'], 'NR', $region));
    }
  }

  public static function eventId(&$query, $eventId)
  {
    $query->andWhere('eventId = ?', $eventId);
  }

  public static function recordEventId(&$query, $eventId)
  {
    if ($eventId) {
      $query->andWhere('eventId = ?', $eventId);
    } else {
      $query->andWhere('eventId != ?', '333mbo');
    }
  }

  public static function searchName(&$query, $keyword, $type)
  {
    if ($type) {
      $query->andWhere('id like ?', '%'.$keyword.'%');
      $query->orderBy('id');
    } else {
      $query->andWhere('name like ?', '%'.$keyword.'%');
      $query->orderBy('name');
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
