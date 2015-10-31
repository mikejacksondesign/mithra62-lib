<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/ShellTest.php
 */
 
namespace mithra62\tests;

use mithra62\tests\TestFixture;
use mithra62\Shell;

/**
 * mithra62 - Shell object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Shell object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class ShellTest extends TestFixture
{   
    public function testProperties()
    {
        $this->assertClassHasAttribute('cmd', '\mithra62\Shell');
        $this->assertClassHasAttribute('command', '\mithra62\Shell');
        
        $shell = new Shell;
        $this->assertObjectHasAttribute('cmd', $shell);
        $this->assertObjectHasAttribute('command', $shell);
    }

}