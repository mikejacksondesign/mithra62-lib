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
    protected $config = null;
    
    /**
     * The Prestashop context object
     * @var \Context
     */
    protected $presta_context = null;
    
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
        $this->email_config['type'] = (\Configuration::get("PS_MAIL_METHOD") == '2' ? 'smtp' : 'php');
        $this->email_config['port'] = \Configuration::get("PS_MAIL_SMTP_PORT");
        if( \Configuration::get("PS_MAIL_METHOD") == '2' )
        {
            $this->email_config['smtp_options']['host'] = \Configuration::get("PS_MAIL_SERVER");
            $this->email_config['smtp_options']['connection_config']['username'] = \Configuration::get("PS_MAIL_USER");
            $this->email_config['smtp_options']['connection_config']['password'] = \Configuration::get("PS_MAIL_PASSWD");
            $this->email_config['smtp_options']['port'] = \Configuration::get("PS_MAIL_SMTP_PORT");
        }
        
        $this->email_config['sender_name'] = $this->getSiteName();
        $this->email_config['from_email'] = \Configuration::get("PS_SHOP_EMAIL");
        
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
        $tz = \Configuration::get("PS_TIMEZONE");
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
        if( defined('_RIJNDAEL_KEY_') )
        {
            return _RIJNDAEL_KEY_;
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
    
    /**
     * Sets the Prestashop context object
     * @param \Context $context
     * @return \mithra62\Platforms\Prestashop
     */
    public function setPrestaContext(\Context $context)
    {
        $this->presta_context = $context;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::redirect()
     */
    public function redirect($url)
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getPost()
     */
    public function getPost($key, $default = false)
    {
        return \Tools::getValue($key, $default); 
    }
}