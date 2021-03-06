<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Prizes', 'doctrine');

/**
 * BasePrizes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $competitionid
 * @property string $eventid
 * @property string $gender
 * @property string $roundid
 * @property integer $pos
 * @property integer $best
 * @property integer $average
 * @property string $personid
 * @property string $personname
 * @property string $personcountryid
 * @property string $continentid
 * @property string $formatid
 * @property integer $value1
 * @property integer $value2
 * @property integer $value3
 * @property integer $value4
 * @property integer $value5
 * @property string $regionalsinglerecord
 * @property string $regionalaveragerecord
 * @property string $competitionname
 * @property string $countryid
 * @property integer $year
 * @property integer $month
 * @property integer $day
 * @property integer $endmonth
 * @property integer $endday
 * 
 * @method integer getId()                    Returns the current record's "id" value
 * @method string  getCompetitionid()         Returns the current record's "competitionid" value
 * @method string  getEventid()               Returns the current record's "eventid" value
 * @method string  getGender()                Returns the current record's "gender" value
 * @method string  getRoundid()               Returns the current record's "roundid" value
 * @method integer getPos()                   Returns the current record's "pos" value
 * @method integer getBest()                  Returns the current record's "best" value
 * @method integer getAverage()               Returns the current record's "average" value
 * @method string  getPersonid()              Returns the current record's "personid" value
 * @method string  getPersonname()            Returns the current record's "personname" value
 * @method string  getPersoncountryid()       Returns the current record's "personcountryid" value
 * @method string  getContinentid()           Returns the current record's "continentid" value
 * @method string  getFormatid()              Returns the current record's "formatid" value
 * @method integer getValue1()                Returns the current record's "value1" value
 * @method integer getValue2()                Returns the current record's "value2" value
 * @method integer getValue3()                Returns the current record's "value3" value
 * @method integer getValue4()                Returns the current record's "value4" value
 * @method integer getValue5()                Returns the current record's "value5" value
 * @method string  getRegionalsinglerecord()  Returns the current record's "regionalsinglerecord" value
 * @method string  getRegionalaveragerecord() Returns the current record's "regionalaveragerecord" value
 * @method string  getCompetitionname()       Returns the current record's "competitionname" value
 * @method string  getCountryid()             Returns the current record's "countryid" value
 * @method integer getYear()                  Returns the current record's "year" value
 * @method integer getMonth()                 Returns the current record's "month" value
 * @method integer getDay()                   Returns the current record's "day" value
 * @method integer getEndmonth()              Returns the current record's "endmonth" value
 * @method integer getEndday()                Returns the current record's "endday" value
 * @method Prizes  setId()                    Sets the current record's "id" value
 * @method Prizes  setCompetitionid()         Sets the current record's "competitionid" value
 * @method Prizes  setEventid()               Sets the current record's "eventid" value
 * @method Prizes  setGender()                Sets the current record's "gender" value
 * @method Prizes  setRoundid()               Sets the current record's "roundid" value
 * @method Prizes  setPos()                   Sets the current record's "pos" value
 * @method Prizes  setBest()                  Sets the current record's "best" value
 * @method Prizes  setAverage()               Sets the current record's "average" value
 * @method Prizes  setPersonid()              Sets the current record's "personid" value
 * @method Prizes  setPersonname()            Sets the current record's "personname" value
 * @method Prizes  setPersoncountryid()       Sets the current record's "personcountryid" value
 * @method Prizes  setContinentid()           Sets the current record's "continentid" value
 * @method Prizes  setFormatid()              Sets the current record's "formatid" value
 * @method Prizes  setValue1()                Sets the current record's "value1" value
 * @method Prizes  setValue2()                Sets the current record's "value2" value
 * @method Prizes  setValue3()                Sets the current record's "value3" value
 * @method Prizes  setValue4()                Sets the current record's "value4" value
 * @method Prizes  setValue5()                Sets the current record's "value5" value
 * @method Prizes  setRegionalsinglerecord()  Sets the current record's "regionalsinglerecord" value
 * @method Prizes  setRegionalaveragerecord() Sets the current record's "regionalaveragerecord" value
 * @method Prizes  setCompetitionname()       Sets the current record's "competitionname" value
 * @method Prizes  setCountryid()             Sets the current record's "countryid" value
 * @method Prizes  setYear()                  Sets the current record's "year" value
 * @method Prizes  setMonth()                 Sets the current record's "month" value
 * @method Prizes  setDay()                   Sets the current record's "day" value
 * @method Prizes  setEndmonth()              Sets the current record's "endmonth" value
 * @method Prizes  setEndday()                Sets the current record's "endday" value
 * 
 * @package    iwca
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePrizes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Prizes');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('competitionid', 'string', 32, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 32,
             ));
        $this->hasColumn('eventid', 'string', 6, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 6,
             ));
        $this->hasColumn('gender', 'string', 6, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 6,
             ));
        $this->hasColumn('roundid', 'string', 1, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('pos', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('best', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('average', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('personid', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('personname', 'string', 80, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 80,
             ));
        $this->hasColumn('personcountryid', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('continentid', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('formatid', 'string', 1, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('value1', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('value2', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('value3', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('value4', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('value5', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('regionalsinglerecord', 'string', 3, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 3,
             ));
        $this->hasColumn('regionalaveragerecord', 'string', 3, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 3,
             ));
        $this->hasColumn('competitionname', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('countryid', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('year', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('month', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('day', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('endmonth', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('endday', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 2,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}