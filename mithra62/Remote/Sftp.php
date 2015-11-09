<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Remote/Sftp.php
 */
 
namespace mithra62\Remote;

use League\Flysystem\Sftp\SftpAdapter as Adapter;
use RuntimeException;
use mithra62\Remote\Sftp AS m62Sftp;

/**
 * mithra62 - FTP Transfer Abstraction
 *
 * Simple intermediary between Flysystem and mithra62
 *
 * @package 	Remote
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Sftp extends Adapter
{   
    /**
     * (non-PHPdoc)
     * @see \League\Flysystem\Adapter\Ftp::connect()
     */
    public function connect()
    {
        @parent::connect();
    }
    
    /**
     * (non-PHPdoc)
     * @see \League\Flysystem\Adapter\Ftp::getMetadata()
     */
    
    /**
     * @ignore
     * (non-PHPdoc)
     * @see \League\Flysystem\Adapter\Ftp::getMetadata()
     */
    public function getMetadata($path)
    {
        return @parent::getMetadata($path);
    }
    
    /**
     * Returns the remote transport client
     * @param array $params An array of the connection details 
     * @return \mithra62\Remote\Ftp
     */
    public static function getRemoteClient(array $params)
    {
        return new m62Sftp([
            'host' => $params['sftp_hostname'],
            'username' => $params['sftp_username'],
            'password' => $params['sftp_password'],
            'port' => $params['sftp_port'],
            'privateKey' => ( isset($params['sftp_private_key']) ? $params['sftp_private_key'] : '' ),
            'timeout' => ( !empty($params['sftp_timeout']) ? $params['sftp_timeout'] : '30' ),
            'root' => $params['sftp_root'],
        ]);
    }    
}