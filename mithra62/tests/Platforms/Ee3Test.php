<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Ee3Test.php
 */
 
namespace mithra62\tests\Platforms;

use mithra62\tests\TestFixture;
use mithra62\Platforms\Ee3;

/**
 * mithra62 - Craft object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Platforms\Craft object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Ee3Test extends TestFixture
{
    public function testInit()
    {
        $ee3 = new Ee3;
        $this->assertTrue(method_exists($ee3, 'getDbCredentials'));
        $this->assertTrue(method_exists($ee3, 'getEmailConfig'));
        $this->assertTrue(method_exists($ee3, 'getCurrentUrl'));
        $this->assertTrue(method_exists($ee3, 'getSiteName'));
        $this->assertTrue(method_exists($ee3, 'getTimezone'));
        $this->assertTrue(method_exists($ee3, 'getSiteUrl'));
        $this->assertTrue(method_exists($ee3, 'getEncryptionKey'));
        $this->assertTrue(method_exists($ee3, 'getConfigOverrides'));
        $this->assertInstanceOf('mithra62\\Platforms\\AbstractPlatform', $ee3);
    }
}