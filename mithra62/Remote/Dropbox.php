<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Remote/Dropbox.php
 */
 
namespace mithra62\Remote;

use League\Flysystem\Dropbox\DropboxAdapter as Adapter;
use RuntimeException;
use mithra62\Remote\Dropbox AS m62Dropbox;

/**
 * mithra62 - FTP Transfer Abstraction
 *
 * Simple intermediary between Flysystem and mithra62
 *
 * @package 	Remote
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Dropbox extends Adapter
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
    public static function getRemoteClient($client, $prefix = false)
    {
        return new m62Dropbox($client, $prefix);
    }    
}