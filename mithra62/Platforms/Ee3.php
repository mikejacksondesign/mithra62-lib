<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms/Ee3.php
 */
namespace mithra62\Platforms;

use mithra62\Platforms\AbstractPlatform;

/**
 * mithra62 - ExpressionEngine 3 Platform Object
 *
 * The bridge between mithra62 code and ExpressionEngine 3 specific logic
 *
 * @package Platforms\Ee3
 * @author Eric Lamb <eric@mithra62.com>
 */
class Ee3 extends AbstractPlatform
{

    /**
     * The Ee3 config array
     * 
     * @var array
     */
    private $config = null;
    
    /**
     * The key to look for within hidden config overrides
     * @var string
     */
    protected $config_key = null;    

    /**
     * Sets the Eecms config array
     * 
     * @param array $config            
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * (non-PHPdoc)
     * 
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
            'settings_table_name' => ee()->db->dbprefix . 'backup_pro_settings'
        );
    }

    /**
     * (non-PHPdoc)
     * 
     * @ignore
     *
     * @see \mithra62\BackupPro\Platforms\PlatformInterface::getEmailDetails()
     */
    public function getEmailConfig()
    {
        $this->email_config['type'] = ee()->config->config['mail_protocol'];
        if ($this->email_config['type'] == 'smtp') {
            $this->email_config['port'] = ee()->config->config['smtp_port'];
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
     * 
     * @see \mithra62\BackupPro\Platforms\PlatformInterface::getCurrentUrl()
     */
    public function getCurrentUrl()
    {
        if (! function_exists('current_url')) {
            ee()->load->helper('url');
        }
        
        return current_url();
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \mithra62\Platforms::getSiteName()
     */
    public function getSiteName()
    {
        return ee()->config->config['site_name'];
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \mithra62\Platforms::getTimezone()
     */
    public function getTimezone()
    {}

    /**
     * (non-PHPdoc)
     * 
     * @see \mithra62\Platforms::getSiteUrl()
     */
    public function getSiteUrl()
    {
        if (! function_exists('site_url')) {
            ee()->load->helper('url');
        }
        
        return site_url();
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \mithra62\Platforms\AbstractPlatform::getEncryptionKey()
     */
    public function getEncryptionKey()
    {
        if (! empty(ee()->config->config['encryption_key'])) {
            return ee()->config->config['encryption_key'];
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \mithra62\Platforms\AbstractPlatform::getConfigOverrides()
     */
    public function getConfigOverrides()
    {
        if (! empty(ee()->config->config[$this->config_key]) && is_array(ee()->config->config[$this->config_key])) {
            return ee()->config->config[$this->config_key];
        }
    
        return array();
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \mithra62\Platforms\AbstractPlatform::redirect()
     */
    public function redirect($url)
    {
        ee()->functions->redirect($url);
        exit();
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \mithra62\Platforms\AbstractPlatform::getPost()
     */
    public function getPost($key, $default = false)
    {
        $value = ee()->input->get_post($key);
        if (! $value) {
            $value = $default;
        }
        
        return $value;
    }
}