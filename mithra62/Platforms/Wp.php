<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Platforms/Wp.php
 */
 
namespace mithra62\Platforms;

use mithra62\Platforms;

/**
 * mithra62 - WordPress Platform Object
 *
 * The bridge between mithra62 code and WordPress specific logic
 *
 * @package 	mithra62\Wp
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Wp extends Platforms
{
    /**
     * The Wp config array
     * @var array
     */
    private $config = null;
    
    /**
     * Sets the Wp config array
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