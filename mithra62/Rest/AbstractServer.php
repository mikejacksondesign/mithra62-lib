<?php
/**
 * mithra62 - Backup Pro
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/Rest/AbstractServer.php
 */
 
namespace mithra62\Rest;

/**
 * Backup Pro - Abstract REST Server
 *
 * Sets up and fires off the REST Server
 *
 * @package mithra62\BackupPro
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
     * Outlines the Server routes
     * @return void
     */
    abstract public function run();
}