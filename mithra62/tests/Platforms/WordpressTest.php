<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/WordpressTest.php
 */
namespace mithra62\tests\Platforms;

use mithra62\tests\TestFixture;
use mithra62\Platforms\Wordpress;

/**
 * mithra62 - Craft object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Platforms\Craft object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class WordpressTest extends TestFixture
{

    public function testInit()
    {
        $wp = new Wordpress();
        $this->assertTrue(method_exists($wp, 'getDbCredentials'));
        $this->assertTrue(method_exists($wp, 'getEmailConfig'));
        $this->assertTrue(method_exists($wp, 'getCurrentUrl'));
        $this->assertTrue(method_exists($wp, 'getSiteName'));
        $this->assertTrue(method_exists($wp, 'getTimezone'));
        $this->assertTrue(method_exists($wp, 'getSiteUrl'));
        $this->assertTrue(method_exists($wp, 'getEncryptionKey'));
        $this->assertTrue(method_exists($wp, 'getConfigOverrides'));
        $this->assertInstanceOf('mithra62\\Platforms\\AbstractPlatform', $wp);
    }
}