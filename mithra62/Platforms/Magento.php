<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms/Magento.php
 */
namespace mithra62\Platforms;

use mithra62\Platforms\AbstractPlatform;

/**
 * mithra62 - Magento Platform Object
 *
 * The bridge between mithra62 code and Magento specific logic
 *
 * @package Platforms\Magento
 * @author Eric Lamb <eric@mithra62.com>
 */
class Magento extends AbstractPlatform
{
    public function getDbCredentials()
    {
        echo \Mage::getStoreConfig('crypt/key', \Mage::app()->getStore());
        exit;
        $config = \Mage::getConfig();
        print_r($config->getTablePrefix());
        exit;
        return array(
            'user' => ee()->db->username,
            'password' => ee()->db->password,
            'database' => ee()->db->database,
            'host' => ee()->db->hostname,
            'prefix' => ee()->db->dbprefix,
            'settings_table_name' => ee()->db->dbprefix . 'backup_pro_settings'
        );        
    }
    
    public function getEmailConfig()
    {
        
    }
    
    public function getCurrentUrl()
    {
        return \Mage::helper('core/url')->getCurrentUrl();
    }
    
    public function getSiteName()
    {
        
    }
    
    public function getTimezone()
    {
        return \Mage::getStoreConfig('general/locale/timezone', \Mage::app()->getStore());
    }
    
    public function getSiteUrl()
    {
        return \Mage::getStoreConfig('web/secure/base_url', \Mage::app()->getStore());
    }
    
    public function getEncryptionKey()
    {
        
    }
    
    public function getConfigOverrides()
    {
        
    }
    
    public function redirect($url)
    {
        
    }
    
    public function getPost($key, $default = false)
    {
        
    }
}