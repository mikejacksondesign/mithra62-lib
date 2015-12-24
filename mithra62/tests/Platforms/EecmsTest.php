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
use mithra62\Platforms\Eecms;

/**
 * mithra62 - Craft object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Platforms\Craft object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class EecmsTest extends TestFixture
{

    public function testInit()
    {
        $eecms = new Eecms();
        $this->assertTrue(method_exists($eecms, 'getDbCredentials'));
        $this->assertTrue(method_exists($eecms, 'getEmailConfig'));
        $this->assertTrue(method_exists($eecms, 'getCurrentUrl'));
        $this->assertTrue(method_exists($eecms, 'getSiteName'));
        $this->assertTrue(method_exists($eecms, 'getTimezone'));
        $this->assertTrue(method_exists($eecms, 'getSiteUrl'));
        $this->assertTrue(method_exists($eecms, 'getEncryptionKey'));
        $this->assertTrue(method_exists($eecms, 'getConfigOverrides'));
        $this->assertInstanceOf('mithra62\\Platforms\\AbstractPlatform', $eecms);
    }
}