<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Competitions', 'doctrine');

/**
 * BaseCompetitions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $id
 * @property string $name
 * @property string $cityname
 * @property string $countryid
 * @property string $continentid
 * @property string $information
 * @property integer $year
 * @property integer $month
 * @property integer $day
 * @property integer $endmonth
 * @property integer $endday
 * @property string $eventspecs
 * @property string $wcadelegate
 * @property string $organiser
 * @property string $venue
 * @property string $venueaddress
 * @property string $venuedetails
 * @property string $website
 * @property string $cellname
 * @property integer $latitude
 * @property integer $longitude
 * @property integer $number
 * 
 * @method string       getId()           Returns the current record's "id" value
 * @method string       getName()         Returns the current record's "name" value
 * @method string       getCityname()     Returns the current record's "cityname" value
 * @method string       getCountryid()    Returns the current record's "countryid" value
 * @method string       getContinentid()  Returns the current record's "continentid" value
 * @method string       getInformation()  Returns the current record's "information" value
 * @method integer      getYear()         Returns the current record's "year" value
 * @method integer      getMonth()        Returns the current record's "month" value
 * @method integer      getDay()          Returns the current record's "day" value
 * @method integer      getEndmonth()     Returns the current record's "endmonth" value
 * @method integer      getEndday()       Returns the current record's "endday" value
 * @method string       getEventspecs()   Returns the current record's "eventspecs" value
 * @method string       getWcadelegate()  Returns the current record's "wcadelegate" value
 * @method string       getOrganiser()    Returns the current record's "organiser" value
 * @method string       getVenue()        Returns the current record's "venue" value
 * @method string       getVenueaddress() Returns the current record's "venueaddress" value
 * @method string       getVenuedetails() Returns the current record's "venuedetails" value
 * @method string       getWebsite()      Returns the current record's "website" value
 * @method string       getCellname()     Returns the current record's "cellname" value
 * @method integer      getLatitude()     Returns the current record's "latitude" value
 * @method integer      getLongitude()    Returns the current record's "longitude" value
 * @method integer      getNumber()       Returns the current record's "number" value
 * @method Competitions setId()           Sets the current record's "id" value
 * @method Competitions setName()         Sets the current record's "name" value
 * @method Competitions setCityname()     Sets the current record's "cityname" value
 * @method Competitions setCountryid()    Sets the current record's "countryid" value
 * @method Competitions setContinentid()  Sets the current record's "continentid" value
 * @method Competitions setInformation()  Sets the current record's "information" value
 * @method Competitions setYear()         Sets the current record's "year" value
 * @method Competitions setMonth()        Sets the current record's "month" value
 * @method Competitions setDay()          Sets the current record's "day" value
 * @method Competitions setEndmonth()     Sets the current record's "endmonth" value
 * @method Competitions setEndday()       Sets the current record's "endday" value
 * @method Competitions setEventspecs()   Sets the current record's "eventspecs" value
 * @method Competitions setWcadelegate()  Sets the current record's "wcadelegate" value
 * @method Competitions setOrganiser()    Sets the current record's "organiser" value
 * @method Competitions setVenue()        Sets the current record's "venue" value
 * @method Competitions setVenueaddress() Sets the current record's "venueaddress" value
 * @method Competitions setVenuedetails() Sets the current record's "venuedetails" value
 * @method Competitions setWebsite()      Sets the current record's "website" value
 * @method Competitions setCellname()     Sets the current record's "cellname" value
 * @method Competitions setLatitude()     Sets the current record's "latitude" value
 * @method Competitions setLongitude()    Sets the current record's "longitude" value
 * @method Competitions setNumber()       Sets the current record's "number" value
 * 
 * @package    iwca
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCompetitions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Competitions');
        $this->hasColumn('id', 'string', 32, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 32,
             ));
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('cityname', 'string', 50, array(
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
        $this->hasColumn('continentid', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('information', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
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
        $this->hasColumn('eventspecs', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('wcadelegate', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('organiser', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('venue', 'string', 240, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 240,
             ));
        $this->hasColumn('venueaddress', 'string', 120, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 120,
             ));
        $this->hasColumn('venuedetails', 'string', 120, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 120,
             ));
        $this->hasColumn('website', 'string', 200, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 200,
             ));
        $this->hasColumn('cellname', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('latitude', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('longitude', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('number', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}