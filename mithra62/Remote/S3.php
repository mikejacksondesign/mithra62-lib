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

use League\Flysystem\AwsS3v2\AwsS3Adapter as Adapter;
use Aws\S3\S3Client;

/**
 * mithra62 - S3 Transfer Abstraction
 *
 * Simple intermediary between Flysystem and mithra62
 *
 * @package Remote
 * @author Eric Lamb <eric@mithra62.com>
 */
class S3 extends Adapter
{

    /**
     * The regions we're using for S3
     * @var array
     */
    protected $regions = array(
        '' => 'US Standard',
        'us-west-2' => 'Oregon',
        'us-west-1' => 'Northern California',
        'eu-west-1' => 'Ireland',
        'ap-southeast-1' => 'Singapore',
        'ap-northeast-1' => 'Tokyo',
        'ap-southeast-2' => 'Sydney',
        'sa-east-1' => 'Sao Paulo',
        'eu-central-1' => 'Frankfurt',
        'ap-northeast-2' => 'Seoul'
    );
    
    /**
     * Returns the available region mapping
     * @return array
     */
    public function getRegions()
    {
        return $this->regions;
    }
    
    /**
     * Returns the remote transport client
     * 
     * @param string $access_key            
     * @param string $secret_key            
     * @return \Aws\S3\S3Client
     */
    public static function getRemoteClient($access_key, $secret_key, $region = '')
    {
        if( $region != '' && array_key_exists($region, $this->getRegions()) )
        {
            
        }
        
        return S3Client::factory([
            'key' => $access_key,
            'secret' => $secret_key,
            'region' => $region
        ]);
    }
}