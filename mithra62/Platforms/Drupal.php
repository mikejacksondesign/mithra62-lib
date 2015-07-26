<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms/Drupal.php
 */
 
namespace mithra62\Platforms;

use mithra62\Platforms;

/**
 * mithra62 - Drupal Platform Object
 *
 * The bridge between mithra62 code and Drupal specific logic
 *
 * @package 	mithra62\Drupal
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Drupal extends Platforms
{
    /**
     * The Drupal config array
     * @var array
     */
    private $config = null;
    
    /**
     * Sets the Drupal config array
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
            'host' => $this->config->get('server', 'db'),
            'port' => $this->config->get('port', 'db'),
            'user' => $this->config->get('user', 'db'),
            'password' => $this->config->get('password', 'db'),
            'database' => $this->config->get('database', 'db'),
            'prefix' => $this->config->get('tablePrefix', 'db'),
            'settings_table_name' => $this->config->get('settings_table_name', 'backuppro')
        );
    }
}