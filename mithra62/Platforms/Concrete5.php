<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms/Concrete5.php
 */
namespace mithra62\Platforms;

use mithra62\Platforms\AbstractPlatform;

/**
 * mithra62 - Concrete5 Platform Object
 *
 * The bridge between mithra62 code and Concrete5 specific logic
 *
 * @package Platforms\Concrete5
 * @author Eric Lamb <eric@mithra62.com>
 */
class Concrete5 extends AbstractPlatform
{
    /**
     * The Concrete5 App object
     * @var \Concrete\Core\Support\Facade\Application
     */
    private $app = null;
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getDbCredentials()
     */
    public function getDbCredentials()
    {
        $database_config = \Config::get('database');
        $database_config = $database_config['connections'][$database_config['default-connection']];
        
        return array(
            'user' => $database_config['username'],
            'password' => $database_config['password'],
            'database' => $database_config['database'],
            'host' => $database_config['server'],
            'prefix' => '',
            'settings_table_name' => 'backup_pro_settings'
        );
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getEmailConfig()
     */
    public function getEmailConfig()
    {
        if(!\Config::get('concrete.email.enabled')) {
            throw new Exception('Concrete5 email is disabled... you have to enable that for email to function');
        }
        
        $email = \Config::get('concrete.mail');
        $this->email_config = array();
        $this->email_config['type'] = $email['method'];
        $this->email_config['port'] = $email['methods']['smtp']['port'];
        if ($email['method'] == 'smtp') {
            $this->email_config['smtp_options']['host'] = $email['methods']['smtp']['server'];
            $this->email_config['smtp_options']['connection_config']['username'] = $email['methods']['smtp']['username'];
            $this->email_config['smtp_options']['connection_config']['password'] = $email['methods']['smtp']['password'];
            $this->email_config['smtp_options']['port'] = $email['methods']['smtp']['port'];
        }
        
        $this->email_config['sender_name'] = $this->getSiteName();
        $this->email_config['from_email'] = \Config::get('concrete.email.default.address');
        return $this->email_config;        
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getCurrentUrl()
     */
    public function getCurrentUrl()
    {
        return $_SERVER["REQUEST_URI"];
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getSiteName()
     */
    public function getSiteName()
    {
        return \Config::get('concrete.site');
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getTimezone()
     */
    public function getTimezone()
    {
        return \Config::get('app.timezone');
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getSiteUrl()
     */
    public function getSiteUrl()
    {
        $app = $this->getApp(); 
        return (string)rtrim($app->make('url/canonical'), '/');
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getEncryptionKey()
     */
    public function getEncryptionKey()
    {
        return \Config::get('concrete.security.token.encryption');
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::getConfigOverrides()
     */
    public function getConfigOverrides()
    {
        return array();
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\AbstractPlatform::redirect()
     */
    public function redirect($url)
    {
        return \Concrete\Core\Routing\Redirect::url($url);
    }
    
    /**
     * (non-PHPdoc)
     * 
     * @see \mithra62\Platforms\AbstractPlatform::getPost()
     */
    public function getPost($key, $default = false)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        } elseif (isset($_GET[$key])) {
            return $_GET[$key];
        }
        
        return $default;
    }
    
    /**
     * Returns an instance of the Concrete5 app object
     * @return \Concrete\Core\Support\Facade\Application
     */
    private function getApp()
    {
        if( is_null($this->app) ) {
            $this->app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
        }
        
        return $this->app;
    }
    
}