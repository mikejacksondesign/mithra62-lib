<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/CraftTest.php
 */
 
namespace mithra62\tests\Platforms;

use mithra62\tests\TestFixture;
use mithra62\Platforms\Craft;

/**
 * mithra62 - Craft object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Platforms\Craft object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class CraftTest extends TestFixture
{
    public function testInit()
    {
        $craft = new Craft;
        $this->assertTrue(method_exists($craft, 'getDbCredentials'));
        $this->assertTrue(method_exists($craft, 'getEmailConfig'));
        $this->assertTrue(method_exists($craft, 'getCurrentUrl'));
        $this->assertTrue(method_exists($craft, 'getSiteName'));
        $this->assertTrue(method_exists($craft, 'getTimezone'));
        $this->assertTrue(method_exists($craft, 'getSiteUrl'));
        $this->assertTrue(method_exists($craft, 'getEncryptionKey'));
        $this->assertTrue(method_exists($craft, 'getConfigOverrides'));
        $this->assertInstanceOf('mithra62\\Platforms\\AbstractPlatform', $craft);
    }
}