<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/LanguageTest.php
 */
 
namespace mithra62\tests;

use mithra62\tests\TestFixture;
use mithra62\Language;

/**
 * mithra62 - Language object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Language object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class LanguageTest extends TestFixture
{    
    /**
     * Ensures the Language Init() mechanisms work as expected
     */
    public function testLanguageInit()
    {
        $this->assertClassHasAttribute('is_loaded', '\\mithra62\\Language');
        $this->assertClassHasAttribute('paths', '\\mithra62\\Language');
        $this->assertClassHasAttribute('language', '\\mithra62\\Language');
        
        $lang = new Language();
        $this->assertObjectHasAttribute('is_loaded', $lang);
        $this->assertObjectHasAttribute('paths', $lang);
        $this->assertObjectHasAttribute('language', $lang);
        
        $lang->init($this->lang1Path());
        $this->assertEquals($lang->__('test_language_return'), 'testLanguage1String');
    }
    
    public function testLanguageOverride()
    {

        $lang = new Language();
        $lang->init($this->lang1Path());
        $this->assertEquals($lang->__('test_language_return'), 'testLanguage1String');
        
        $lang->init($this->lang2Path());
        $this->assertEquals($lang->__('test_language_return'), 'testLanguage2String');

        $lang->init($this->lang3Path());
        $this->assertEquals($lang->__('test_language_return'), 'testLanguage3String');
        
        $lang->init($this->lang2Path());
        $this->assertEquals($lang->__('test_language_return'), 'testLanguage2String');
    }
}