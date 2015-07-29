<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Validate/Rules/Filesystem/FileTest.php
 */
 
namespace mithra62\tests\Validate\Rules\Filesystem;

use mithra62\tests\TestFixture;
use mithra62\Validate;
use mithra62\Validate\Rules\Filesystem\File;

/**
 * mithra62 - File Validation Rule Unit Tests
 *
 * Contains all the unit tests for the File Validation Rule
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class FileTest extends TestFixture
{
    /**
     * Tests the name of the rule
     */
    public function testName()
    {
        $file = new File;
        $this->assertEquals($file->getName(), 'file');
    }
    
    /**
     * Tests that a file can be determined false
     */
    public function testRuleFail()
    {
        $val = new Validate();
        $val->rule('file', 'test_file')->val(array('test_file' => dirname(__FILE__)));
        $this->assertTrue($val->hasErrors());
    }
    
    /**
     * Tests that a file can be determined true
     */
    public function testRuleSuccess()
    {
        $val = new Validate();
        $val->rule('file', 'test_file')->val(array('test_file' => __FILE__));
        $this->assertFALSE($val->hasErrors());
    }
}