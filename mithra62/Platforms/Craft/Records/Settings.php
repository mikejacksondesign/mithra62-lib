<?php
/**
 * mithra62 - Craft Settings Base
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms/Craft/Records/Settings.php
 */
namespace mithra62\Platforms\Craft\Records;

use Craft\AttributeType;
use Craft\ColumnType;
use mithra62\Platforms\Craft\Records;

/**
 * Craft - mithra62 Settings Record
 *
 * Contains the global mithra62 Settings object for Craft usage
 *
 * @package Platforms\Craft
 * @author Eric Lamb <eric@mithra62.com>
 */
class Settings extends Records
{

    /**
     * (non-PHPdoc)
     * 
     * @see \Craft\BaseRecord::getTableName()
     */
    public function getTableName()
    {
        return 'mithra62_settings';
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Craft\BaseRecord::defineAttributes()
     */
    protected function defineAttributes()
    {
        return array(
            'setting_key' => array(
                AttributeType::String,
                'colum' => ColumnType::Varchar,
                'required' => true
            ),
            'setting_value' => array(
                AttributeType::String,
                'column' => ColumnType::LongText,
                'required' => false
            ),
            'serialized' => array(
                AttributeType::Number,
                'column' => ColumnType::TinyInt,
                'required' => false,
                'default' => 0,
                'length' => 1
            )
        );
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Craft\BaseRecord::defineIndexes()
     */
    public function defineIndexes()
    {
        return array(
            array(
                'columns' => array(
                    'setting_key'
                )
            ),
            array(
                'columns' => array(
                    'serialized'
                )
            )
        );
    }
}