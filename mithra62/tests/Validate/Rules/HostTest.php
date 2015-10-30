<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Validate/Rules/HostTest.php
 */
 
namespace mithra62\tests\Validate\Rules;

use mithra62\tests\TestFixture;
use mithra62\Validate;
use mithra62\Validate\Rules\Host;

/**
 * mithra62 - Valiate object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Valiate object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class HostTest extends TestFixture
{
    /**
     * Tests the name of the rule
     */
    public function testName()
    {
        $dir = new Host;
        $this->assertEquals($dir->getName(), 'host');
    }
    
    /**
     * Tests that a file can be determined false
     */
    public function testRuleFail()
    {
        $val = new Validate();
        $val->rule('host', 'host')->val(array('host' => 'mithra62.com'));
        $this->assertTrue($val->hasErrors());

        $val = new Validate();
        $val->rule('host', 'host_input')->val(array('host_input' => '555'));
        $this->assertTrue($val->hasErrors());
    }
    
    /**
     * Tests that a directory can be determined true
     */
    public function testRuleSuccess()
    {
        $val = new Validate();
        $val->rule('host', 'host_input')->val(array('host_input' => 'http://mithra62.com'));
        $this->assertFALSE($val->hasErrors());

        $val = new Validate();
        $val->rule('host', 'host_input')->val(array('host_input' => '127.0.0.1'));
        $this->assertFALSE($val->hasErrors());
    }
}