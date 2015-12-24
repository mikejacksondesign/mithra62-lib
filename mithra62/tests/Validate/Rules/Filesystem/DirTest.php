<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Validate/Rules/Filesystem/DirTest.php
 */
namespace mithra62\tests\Validate\Rules\Filesystem;

use mithra62\tests\TestFixture;
use mithra62\Validate;
use mithra62\Validate\Rules\Filesystem\Dir;

/**
 * mithra62 - Valiate object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Valiate object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class DirTest extends TestFixture
{

    /**
     * Tests the name of the rule
     */
    public function testName()
    {
        $dir = new Dir();
        $this->assertEquals($dir->getName(), 'dir');
    }

    /**
     * Tests that a file can be determined false
     */
    public function testRuleFail()
    {
        $val = new Validate();
        $val->rule('dir', 'working_directory')->val(array(
            'working_directory' => __FILE__
        ));
        $this->assertTrue($val->hasErrors());
    }

    /**
     * Tests that a directory can be determined true
     */
    public function testRuleSuccess()
    {
        $val = new Validate();
        $val->rule('dir', 'working_directory')->val(array(
            'working_directory' => dirname(__FILE__)
        ));
        $this->assertFALSE($val->hasErrors());
    }
}