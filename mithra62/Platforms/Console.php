<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/Platforms/Console.php
 */
 
namespace mithra62\Platforms;

use mithra62\Platforms\AbstractPlatform;

/**
 * mithra62 - Console Platform Object
 *
 * The bridge between mithra62 code and Console specific logic
 *
 * @package 	Platforms\Console
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Console extends AbstractPlatform
{
    /**
     * The set settings data from the configuration file
     * @var array
     */
    protected $config = array();
    
    /**
     * Sets the config data from an external source
     * @param array $data
     * @return mithra62\Platform\Console
     */
    public function setConfig(array $data)
    {
        $this->config = $data;
        $this->config['db']['settings_table_name'] = $this->config['db']['prefix'].'backup_pro_settings';
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getDbCredentials()
     */
    public function getDbCredentials()
    {
        return $this->config['db'];
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getEmailConfig()
     */
    public function getEmailConfig()
    {
        return $this->config['email'];
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getCurrentUrl()
     */
    public function getCurrentUrl()
    {
        return $this->config['site_url'];
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getSiteName()
     */
    public function getSiteName()
    {
        return $this->config['site_name'];
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getTimezone()
     */
    public function getTimezone()
    {
        return date_default_timezone_get();
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getSiteUrl()
     */
    public function getSiteUrl()
    {
        return $this->config['site_url'];
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getEncryptionKey()
     */
    public function getEncryptionKey()
    {
        return $this->config['encryption_key'];
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getConfigOverrides()
     */
    public function getConfigOverrides()
    {
        return array();
    }
}