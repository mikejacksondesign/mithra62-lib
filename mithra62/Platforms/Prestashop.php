<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/Platforms/Prestashop.php
 */
 
namespace mithra62\Platforms;

use mithra62\Platforms\AbstractPlatform;

/**
 * mithra62 - Prestashop Platform Object
 *
 * The bridge between mithra62 code and Prestashop specific logic
 *
 * @package 	Platforms\Prestashop
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Prestashop extends AbstractPlatform
{
    /**
     * The Eecms config array
     * @var array
     */
    private $config = null;
    
    /**
     * Sets the Eecms config array
     * @param array $config
     */
    public function setConfig( array $config)
    {
        $this->config = $config;    
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getDbCredentials()
     */
    public function getDbCredentials()
    {
        return array(
            'user' => _DB_USER_,
            'password' => _DB_PASSWD_,
            'database' => _DB_NAME_,
            'host' => _DB_SERVER_,
            'prefix' => _DB_PREFIX_,
            'settings_table_name' => _DB_PREFIX_.'backup_pro_settings'
        );
    }
    
    /**
     * (non-PHPdoc)
     * @ignore
     * @see \mithra62\BackupPro\Platforms\PlatformInterface::getEmailDetails()
     */
    public function getEmailConfig()
    {
        $this->email_config['type'] = 'php';//ee()->config->config['mail_protocol'];
        $this->email_config['port'] = '';//ee()->config->config['smtp_port'];
        if( $this->email_config['type'] == 'smtp' )
        {
            $this->email_config['smtp_options']['host'] = ee()->config->config['smtp_server'];
            $this->email_config['smtp_options']['connection_config']['username'] = ee()->config->config['smtp_username'];
            $this->email_config['smtp_options']['connection_config']['password'] = ee()->config->config['smtp_password'];
            $this->email_config['smtp_options']['port'] = $this->email_config['port'];
        }
        
        $this->email_config['sender_name'] = get_bloginfo( 'name', 'raw' );
        $this->email_config['from_email'] = get_bloginfo( 'admin_email', 'raw' );
        
        return $this->email_config;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\BackupPro\Platforms\PlatformInterface::getCurrentUrl()
     */
    public function getCurrentUrl()
    {
        return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getSiteName()
     */
    public function getSiteName()
    {
        return \Configuration::get("PS_SHOP_NAME");
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getTimezone()
     */
    public function getTimezone() 
    {
        $tz = '';//get_option('timezone_string');
        if( !empty($tz) )
        {
            return $tz;
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getSiteUrl()
     */
    public function getSiteUrl()
    {
        return \Configuration::get("PS_SHOP_DOMAIN");
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getEncryptionKey()
     */
    public function getEncryptionKey()
    {
        if( defined('NONCE_SALT') )
        {
            return NONCE_SALT;
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getConfigOverrides()
     */
    public function getConfigOverrides()
    {
        global $backup_pro_settings;
        
        if( !empty($backup_pro_settings) && is_array($backup_pro_settings) )
        {
            return $backup_pro_settings;
        }
        
        return array();
    }
}