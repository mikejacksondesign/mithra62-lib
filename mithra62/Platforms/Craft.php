<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms/Craft.php
 */
 
namespace mithra62\Platforms;

use mithra62\Platforms\AbstractPlatform;
use mithra62\Exceptions\PlatformsException;
use \CSecurityManager;

/**
 * mithra62 - Craft Platform Object
 *
 * The bridge between mithra62 code and Craft specific logic
 *
 * @package 	Platforms\Craft
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Craft extends AbstractPlatform
{   
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getDbCredentials()
     */
    public function getDbCredentials()
    {
        $config = \Craft\craft()->config;
        if( $config instanceof \Craft\ConfigService )
        {
            return array(
                'host' => $config->get('server', 'db'),
                'port' => $config->get('port', 'db'),
                'user' => $config->get('user', 'db'),
                'password' => $config->get('password', 'db'),
                'database' => $config->get('database', 'db'),
                'prefix' => $config->get('tablePrefix', 'db'),
                'settings_table_name' => $config->get('settings_table_name', 'backuppro')
            );
        }
        else
        {
            throw new PlatformsException("\\Craft\\ConfigService object isn't set!");
        }
    }
    
    /**
     * (non-PHPdoc)
     * @ignore
     * @see \mithra62\BackupPro\Platforms\PlatformInterface::getEmailDetails()
     */
    public function getEmailConfig()
    {
        $email = \Craft\craft()->systemSettings->getSettings('email');
        $this->email_config['type'] = $email['protocol'];
        $this->email_config['port'] = $email['port'];
        if( $email['protocol'] == 'smtp' )
        {
            $this->email_config['smtp_options']['host'] = $email['host'];
            $this->email_config['smtp_options']['connection_config']['username'] = $email['username'];
            $this->email_config['smtp_options']['connection_config']['password'] = $email['password'];
        }
        
        $this->email_config['sender_name'] = $email['senderName'];
        $this->email_config['from_email'] = $email['emailAddress'];
        
        return $this->email_config;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\BackupPro\Platforms\PlatformInterface::getCurrentUrl()
     */
    public function getCurrentUrl()
    {
        return \Craft\craft()->request->requestUri;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getSiteName()
     */
    public function getSiteName()
    {
        return \Craft\craft()->getInfo('siteName');
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms::getTimezone()
     */
    public function getTimezone() 
    {
        return \Craft\craft()->getTimezone();
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getSiteUrl()
     */
    public function getSiteUrl()
    {
        return \Craft\craft()->getInfo('siteUrl');
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getEncryptionKey()
     */
    public function getEncryptionKey()
    {
        $sec = new CSecurityManager;
        return $sec->getEncryptionKey();
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