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
     * Outlines the Server routes
     * @return void
     */
    abstract public function run();
}