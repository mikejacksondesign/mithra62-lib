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
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getDbCredentials()
     */
    public function getDbCredentials()
    {
        //$encryptedData = \Mage::helper('core')->encrypt("This will be encrypted");
        $resources = \Mage::getConfig()->getNode('global/resources');
        if( $resources instanceof \Mage_Core_Model_Config_Element )
        {
            //we only want to use the writable table since we use our own everything
            $write = \Mage::getConfig()->getNode('global/resources/default_write/connection');
            $db_node = 'default_setup';
            if( $write instanceof \Mage_Core_Model_Config_Element )
            {
                $db_node = $write->use;
            }
            
            $db_data = \Mage::getConfig()->getNode('global/resources/'.$db_node.'/connection');
            $prefix = \Mage::getConfig()->getNode('global/resources/db/table_prefix');
            
            if( $db_data instanceof \Mage_Core_Model_Config_Element )
            {
                return array(
                    'user' => $db_data->username,
                    'password' => $db_data->password,
                    'database' => $db_data->dbname,
                    'host' => $db_data->host,
                    'prefix' => (string)$prefix,
                    'settings_table_name' => (string)$prefix . 'backup_pro_settings'
                );
            }
        }
        
        throw new \Exception('Can\'t access databse credentiasl!');
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getEmailConfig()
     */
    public function getEmailConfig()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getCurrentUrl()
     */
    public function getCurrentUrl()
    {
        return \Mage::helper('core/url')->getCurrentUrl();
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getSiteName()
     */
    public function getSiteName()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getTimezone()
     */
    public function getTimezone()
    {
        return \Mage::getStoreConfig('general/locale/timezone', \Mage::app()->getStore());
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getSiteUrl()
     */
    public function getSiteUrl()
    {
        return \Mage::getStoreConfig('web/secure/base_url', \Mage::app()->getStore());
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getEncryptionKey()
     */
    public function getEncryptionKey()
    {
        return (string)\Mage::getConfig()->getNode('global/crypt/key');
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getConfigOverrides()
     */
    public function getConfigOverrides()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @param string $url 
     * @see \mithra62\Platforms\AbstractPlatform::redirect()
     */
    public function redirect($url)
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @param string $key
     * @param string $default 
     * @see \mithra62\Platforms\AbstractPlatform::getPost()
     */
    public function getPost($key, $default = false)
    {
        
    }
}