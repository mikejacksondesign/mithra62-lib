<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2016, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/Rest/AbstractServer.php
 */
 
namespace mithra62\Rest;

/**
 * Abstract REST Server
 *
 * Sets up and fires off the REST Server
 *
 * @package Rest
 * @author Eric Lamb <eric@mithra62.com>
 */
abstract class AbstractServer
{
    /**
     * The Platform object
     * @var \mithra62\Platforms\AbstractPlatform
     */
    protected $platform = null;
    
    /**
     * The REST object
     * @var \mithra62\BackupPro\Rest
     */
    protected $rest = null;
    
    /**
     * The API version we're using
     * @var string
     */
    protected $version = null;
    
    /**
     * Set it up
     * @param \mithra62\Platforms\AbstractPlatform $platform
     * @param \mithra62\BackupPro\Rest $rest
     */
    public function __construct(\mithra62\Platforms\AbstractPlatform $platform, \mithra62\Rest $rest)
    {
        $this->platform = $platform;
        $this->rest = $rest;
    }
    
    /**
     * Returns an instance of the Hmac object
     * @return \mithra62\Rest\Hmac
     */
    public function getHmac()
    {
        return new Hmac();
    }
    
    /**
     * Creates the version of the API we're expected to use
     * @param string $version_key
     * @return string
     */
    public function getVersion($version_key)
    {
        if(is_null($this->version))
        {
            //determine the version
            $headers = \getallheaders();
            if(isset($headers[$version_key]) && is_numeric($headers[$version_key]) && in_array($headers[$version_key], $this->api_versions))
            {
                $version = 'V'.str_replace('.','_',$headers[$version_key]);
            }
            else
            {
                $version = 'V1';
            }
            
            $this->version = $version;
        }
        
        return $this->version;
    }
    
    /**
     * Outlines the Server routes
     * @return void
     */
    abstract public function run(array $routes = array());
}