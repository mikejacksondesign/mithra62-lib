<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/EncryptTest.php
 */
namespace mithra62\tests;

use mithra62\tests\TestFixture;
use mithra62\Encrypt;

/**
 * mithra62 - Encrypt object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Encrypt object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class EncryptTest extends TestFixture
{

    /**
     * Ensures the Bootstrap object has all the proper attributes available
     */
    public function testInit()
    {
        $this->assertClassHasAttribute('api', '\mithra62\Encrypt');
        $this->assertClassHasAttribute('key', '\mithra62\Encrypt');
        
        $encrypt = new Encrypt();
        $this->assertObjectHasAttribute('api', $encrypt);
        $this->assertObjectHasAttribute('key', $encrypt);
    }

    /**
     * Tests the setKey() method
     */
    public function testSetKey()
    {
        $encrypt = new Encrypt();
        $key = 'my_test_key';
        
        $encrypt->setKey($key);
        $this->assertEquals($key, $encrypt->getKey());
    }

    /**
     * Tests the encode() method
     */
    public function testEncode()
    {
        $encrypt = new Encrypt();
        $this->assertEquals('1mMdlLucqw/q8PL0BwU8hNAWnQQcYR1m0/DlGzZMItM=', $encrypt->encode('MyTestStringToEncode'));
    }

    /**
     * Tests the decode() method
     */
    public function testDecode()
    {
        $encrypt = new Encrypt();
        $this->assertEquals('MyTestStringToEncode', $encrypt->decode('1mMdlLucqw/q8PL0BwU8hNAWnQQcYR1m0/DlGzZMItM='));
    }

    /**
     * Tests the getApi() method
     */
    public function testApi()
    {
        $encrypt = new Encrypt();
        $this->assertInstanceOf('\\phpseclib\\Crypt\\AES', $encrypt->getApi());
    }
}