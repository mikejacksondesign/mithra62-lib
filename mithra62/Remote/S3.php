<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Remote/S3.php
 */
 
namespace mithra62\Remote;

use League\Flysystem\AwsS3v2\AwsS3Adapter AS Adapter;
use Aws\S3\S3Client;

/**
 * mithra62 - S3 Transfer Abstraction
 *
 * Simple intermediary between Flysystem and mithra62
 *
 * @package 	Remote
 * @author		Eric Lamb <eric@mithra62.com>
 */
class S3 extends Adapter
{
    /**
     * Returns the remote transport client
     * @param string $access_key
     * @param string $secret_key
     * @return \Aws\S3\S3Client
     */
    public static function getRemoteClient($access_key, $secret_key)
    {
        return S3Client::factory([
            'key'    => $access_key,
            'secret' => $secret_key
        ]);
    }
}