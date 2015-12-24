<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Remote/SftpTest.php
 */
namespace mithra62\tests\Remote;

use mithra62\tests\TestFixture;
use mithra62\Remote\Sftp;

/**
 * mithra62 - Ftp Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Ftp object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class SftpTest extends TestFixture
{

    private function getSftpInstance()
    {
        $settings = $this->getSftpCreds();
        $sftp = new Sftp([
            'host' => $settings['sftp_host'],
            'username' => $settings['sftp_username'],
            'password' => $settings['sftp_password'],
            'port' => $settings['sftp_port'],
            'timeout' => (! empty($settings['sftp_timeout']) ? $settings['sftp_timeout'] : '30')
        ]);
        
        return $sftp;
    }

    public function testInstance()
    {
        $ftp = $this->getSftpInstance();
        $this->assertInstanceOf('\League\Flysystem\AdapterInterface', $ftp);
    }

    public function testGetRemoteClient()
    {
        $settings = $this->getSftpCreds();
        $this->assertInstanceOf('\League\Flysystem\AdapterInterface', Sftp::getRemoteClient($settings));
    }

    public function testConnect()
    {
        $sftp = $this->getSftpInstance();
        $sftp->connect();
        $this->assertInstanceOf('\phpseclib\Net\SFTP', $sftp->getConnection());
        $sftp->disconnect();
    }
}