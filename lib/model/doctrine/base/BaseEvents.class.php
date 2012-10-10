<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Events', 'doctrine');

/**
 * BaseEvents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $id
 * @property string $name
 * @property integer $rank
 * @property string $format
 * @property string $cellname
 * 
 * @method string  getId()       Returns the current record's "id" value
 * @method string  getName()     Returns the current record's "name" value
 * @method integer getRank()     Returns the current record's "rank" value
 * @method string  getFormat()   Returns the current record's "format" value
 * @method string  getCellname() Returns the current record's "cellname" value
 * @method Events  setId()       Sets the current record's "id" value
 * @method Events  setName()     Sets the current record's "name" value
 * @method Events  setRank()     Sets the current record's "rank" value
 * @method Events  setFormat()   Sets the current record's "format" value
 * @method Events  setCellname() Sets the current record's "cellname" value
 * 
 * @package    iwca
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvents extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Events');
        $this->hasColumn('id', 'string', 6, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 6,
             ));
        $this->hasColumn('name', 'string', 54, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 54,
             ));
        $this->hasColumn('rank', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('format', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
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
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}