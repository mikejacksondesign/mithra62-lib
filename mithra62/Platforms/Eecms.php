<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms/Eecms.php
 */
 
namespace mithra62\Platforms;

use mithra62\Platforms;

/**
 * mithra62 - ExpressionEngine Platform Object
 *
 * The bridge between mithra62 code and ExpressionEngine specific logic
 *
 * @package 	mithra62\Eecms
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Eecms extends Platforms
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
            'user' => ee()->db->username,
            'password' => ee()->db->password,
            'database' => ee()->db->database,
            'host' => ee()->db->hostname,
            'prefix' => ee()->db->dbprefix,
            'settings_table_name' => 'exp_backup_pro_settings'
        );
    }
    
    /**
     * (non-PHPdoc)
     * @ignore
     * @see \mithra62\BackupPro\Platforms\PlatformInterface::getEmailDetails()
     */
    public function getEmailConfig()
    {
        $this->email_config['type'] = ee()->config->config['mail_protocol'];
        $this->email_config['port'] = ee()->config->config['smtp_port'];
        if( $this->email_config['type'] == 'smtp' )
        {
            $this->email_config['smtp_options']['host'] = ee()->config->config['smtp_server'];
            $this->email_config['smtp_options']['connection_config']['username'] = ee()->config->config['smtp_username'];
            $this->email_config['smtp_options']['connection_config']['password'] = ee()->config->config['smtp_password'];
            $this->email_config['smtp_options']['port'] = $this->email_config['port'];
        }
        
        $this->email_config['sender_name'] = ee()->config->config['site_label'];
        $this->email_config['from_email'] = ee()->config->config['webmaster_email'];
        
        return $this->email_config;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\BackupPro\Platforms\PlatformInterface::getCurrentUrl()
     */
    public function getCurrentUrl()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getSiteName()
     */
    public function getSiteName()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getTimezone()
     */
    public function getTimezone() 
    {
        
    }
}