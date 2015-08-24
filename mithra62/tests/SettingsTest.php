<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/SettingsTest.php
 */
 
namespace mithra62\tests;

use mithra62\Settings;
use mithra62\Db;
use mithra62\Language;
use mithra62\tests\TestFixture;

/**
 * Mock for testing the Settings Abstract
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 * @ignore
 */
class _settings extends Settings
{
    /**
     * (non-PHPdoc)
     * @ignore
     * @see \mithra62\Settings::validate()
     */
    public function validate(array $data, array $extra = array())
    {
        
    }
}


/**
 * mithra62 - Settings object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Settings object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class SettingsTest extends TestFixture
{
    /**
     * Tests the initial attributes and property values
     */
    public function testInit()
    {
        $this->assertClassHasAttribute('settings', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('table', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('_global_defaults', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('serialized', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('custom_options', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('new_lines', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('encrypted', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('defaults', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('overrides', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('encrypt', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('lang', '\mithra62\tests\_settings');
        $this->assertClassHasAttribute('db', '\mithra62\tests\_settings');

        $settings = new _settings(new Db, new Language );
        $this->assertObjectHasAttribute('settings', $settings);
        $this->assertObjectHasAttribute('table', $settings);
        $this->assertObjectHasAttribute('_global_defaults', $settings);
        $this->assertObjectHasAttribute('serialized', $settings);
        $this->assertObjectHasAttribute('custom_options', $settings);
        $this->assertObjectHasAttribute('new_lines', $settings);
        $this->assertObjectHasAttribute('encrypted', $settings);
        $this->assertObjectHasAttribute('defaults', $settings);
        $this->assertObjectHasAttribute('overrides', $settings);
        $this->assertObjectHasAttribute('encrypt', $settings);
        $this->assertObjectHasAttribute('lang', $settings);
        $this->assertObjectHasAttribute('db', $settings);
        
        $this->assertTrue(is_array($settings->getDefaults()));
        $this->assertCount(0, $settings->getDefaults());

        $this->assertTrue(is_array($settings->getCustomOptions()));
        $this->assertCount(0, $settings->getCustomOptions());

        $this->assertTrue(is_array($settings->getOverrides()));
        $this->assertCount(0, $settings->getOverrides());

        $this->assertTrue(is_array($settings->getEncrypted()));
        $this->assertCount(0, $settings->getEncrypted());

        $this->assertTrue(is_array($settings->getEncrypted()));
        $this->assertCount(0, $settings->getEncrypted());
        
        $this->assertEmpty($settings->getTable());
    }
    
    /**
     * Tests the set and get methods for $table property
     */
    public function testSetTable()
    {
        $settings = new _settings(new Db, new Language );
        $settings->setTable('test_table');
        $this->assertEquals('test_table', $settings->getTable());
        
    }
    
    /**
     * Tests the encryption instance
     */
    public function testEncrypt()
    {
        $settings = new _settings(new Db, new Language );
        $this->assertInstanceOf('\mithra62\Encrypt', $settings->getEncrypt());
    }
}