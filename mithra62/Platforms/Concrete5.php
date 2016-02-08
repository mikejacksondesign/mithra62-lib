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
    
    public function getEmailConfig()
    {
        \Config::get('concrete.mail');
    }
    
    public function getCurrentUrl()
    {
        return $_SERVER["REQUEST_URI"];
    }
    
    public function getSiteName()
    {
        return \Config::get('concrete.site');
    }
    
    public function getTimezone()
    {
        return \Config::get('app.timezone');
    }
    
    public function getSiteUrl()
    {
        
    }
    
    public function getEncryptionKey()
    {
        
    }
    
    public function getConfigOverrides()
    {
        return array();
    }
    
    public function redirect($url)
    {
        return \Concrete\Core\Routing\Redirect::url($url);
    }
    
    public function getPost($key, $default = false)
    {
        
    }
    
}