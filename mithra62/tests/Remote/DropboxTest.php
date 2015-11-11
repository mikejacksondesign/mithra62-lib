<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Remote/DropboxTest.php
 */
 
namespace mithra62\tests\Remote;

use mithra62\tests\TestFixture;
use mithra62\Remote\Dropbox;

/**
 * mithra62 - Dropbox Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Dropbox object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class DropboxTest extends TestFixture
{
    public function testConnect()
    {
        $creds = $this->getDropboxCreds();
        $s3 = Dropbox::getRemoteClient($creds['dropbox_access_token'], $creds['dropbox_app_secret']);
        $this->assertInstanceOf('Dropbox\Client', $s3);   
    }
}