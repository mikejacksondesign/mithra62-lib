<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/BootstrapTest.php
 */
 
namespace mithra62\tests;

use mithra62\tests\TestFixture;
use mithra62\Bootstrap;
use mithra62\BackupPro\Platforms\Ee3 AS Platform;

/**
 * mithra62 - Bootstrap object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Bootstrap object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class BootstrapTest extends TestFixture
{
    /**
     * Ensures the Bootstrap object has all the proper attributes available
     */
    public function testBootstrapAttributes()
    {
        $this->assertClassHasAttribute('container', '\mithra62\Bootstrap');
        $this->assertClassHasAttribute('lang_file', '\mithra62\Bootstrap');
        $this->assertClassHasAttribute('lang_paths', '\mithra62\Bootstrap');
        $this->assertClassHasAttribute('config', '\mithra62\Bootstrap');
        
        $m62 = new Bootstrap;
        $this->assertObjectHasAttribute('container', $m62);
        $this->assertObjectHasAttribute('lang_file', $m62);
        $this->assertObjectHasAttribute('lang_paths', $m62);
        $this->assertObjectHasAttribute('config', $m62);
    }
    
    public function testPimpleInstance()
    {
        $m62 = new Bootstrap;
        $this->assertInstanceOf('\Pimple\Container', $m62->getContainer());
    }
    
    public function testServices()
    {

        
    }
}