<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RanksSingle', 'doctrine');

/**
 * BaseRanksSingle
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $personid
 * @property string $eventid
 * @property integer $best
 * @property integer $worldrank
 * @property integer $continentrank
 * @property integer $countryrank
 * 
 * @method integer     getId()            Returns the current record's "id" value
 * @method string      getPersonid()      Returns the current record's "personid" value
 * @method string      getEventid()       Returns the current record's "eventid" value
 * @method integer     getBest()          Returns the current record's "best" value
 * @method integer     getWorldrank()     Returns the current record's "worldrank" value
 * @method integer     getContinentrank() Returns the current record's "continentrank" value
 * @method integer     getCountryrank()   Returns the current record's "countryrank" value
 * @method RanksSingle setId()            Sets the current record's "id" value
 * @method RanksSingle setPersonid()      Sets the current record's "personid" value
 * @method RanksSingle setEventid()       Sets the current record's "eventid" value
 * @method RanksSingle setBest()          Sets the current record's "best" value
 * @method RanksSingle setWorldrank()     Sets the current record's "worldrank" value
 * @method RanksSingle setContinentrank() Sets the current record's "continentrank" value
 * @method RanksSingle setCountryrank()   Sets the current record's "countryrank" value
 * 
 * @package    iwca
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRanksSingle extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('RanksSingle');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             'length' => 8,
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
        $this->hasColumn('worldrank', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('continentrank', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('countryrank', 'integer', 4, array(
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