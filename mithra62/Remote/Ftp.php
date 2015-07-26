<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Remote/Ftp.php
 */
 
namespace mithra62\Remote;

use League\Flysystem\Adapter\Ftp as Adapter;
use RuntimeException;
use mithra62\Remote\Ftp AS m62Ftp;

/**
 * mithra62 - FTP Transfer Abstraction
 *
 * Simple intermediary between Flysystem and mithra62
 *
 * @package 	Remote
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Ftp extends Adapter
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
    public function getMetadata($path)
    {
        return @parent::getMetadata($path);
    }
    
    /**
     * Returns the remote transport client
     * @param string $access_key
     * @param string $secret_key
     * @return \Aws\S3\S3Client
     */
    public static function getRemoteClient(array $params)
    {
        return new m62Ftp([
            'host' => $params['ftp_hostname'],
            'username' => $params['ftp_username'],
            'password' => $params['ftp_password'],
            'port' => $params['ftp_port'],
            'passive' => ( isset($params['ftp_passive']) ? $params['ftp_passive'] : '0' ),
            'ssl' => ( !empty($params['ftp_ssl']) ? $params['ftp_ssl'] : '0' ),
            'timeout' => ( !empty($params['ftp_timeout']) ? $params['ftp_timeout'] : '30' ),
        ]);
    }    
}