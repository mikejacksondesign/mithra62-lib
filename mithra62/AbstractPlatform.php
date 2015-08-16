<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms.php
 */
 
namespace mithra62;

/**
 * mithra62 - Platform Abstract
 *
 * Defines the methods each platform must implement to communicate between themselves
 *
 * @package 	Platforms
 * @author		Eric Lamb <eric@mithra62.com>
 */
abstract class AbstractPlatform
{
    /**
     * Returns an array of details about interacting with the database
     */
    abstract public function getDbCredentials();
    
    /**
     * Returns an array of email connection details
     * @param array $details
     */
    abstract public function getEmailConfig();
    
    /**
     * Returns the Current URL for the given request
    */
    abstract public function getCurrentUrl();
    
    /**
     * Returns the site name
    */
    abstract public function getSiteName();
    
    /**
     * Returns the user's timezone
    */
    abstract public function getTimezone();
    
    /**
     * Returns the site URL
     */
    abstract public function getSiteUrl();
}