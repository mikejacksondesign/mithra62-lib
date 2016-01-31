<?php
/**
 * mithra62 - Bootstrap
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Bootstrap.php
 */
namespace mithra62;

use Pimple\Container;
use mithra62\Encrypt;
use mithra62\Db;
use mithra62\Language;
use mithra62\Validate;
use mithra62\Files;
use mithra62\Errors;
use mithra62\License;
use mithra62\Email;
use mithra62\View;
use mithra62\Regex;
use mithra62\Shell;
use mithra62\Console;

/**
 * mithra62 - Bootstrap Object
 *
 * Sets up the environment and needed objects
 *
 * @package Bootstrap
 * @author Eric Lamb <eric@mithra62.com>
 */
class Bootstrap
{

    /**
     * The Pimple DI Container object
     * 
     * @var \Pimple\Container
     */
    protected $container = null;

    /**
     * The language file to load
     * 
     * @var array
     */
    protected $lang_file = null;

    /**
     * The paths to look for language files at
     * 
     * @var array
     */
    protected $lang_paths = array();

    /**
     * The environment config details
     * 
     * @var array
     */
    protected $config = array(
        'db' => array()
    );

    /**
     *
     * @ignore
     *
     */
    public function __construct()
    {
        $container = new Container();
        $this->setContainer($container);
        $this->setLangPath(realpath(dirname(__FILE__) . '/language'));
    }

    /**
     * Sets a language paths to use
     * 
     * @param string $path            
     */
    public function setLangPath($path)
    {
        $this->lang_paths[base64_encode($path)] = $path;
    }

    /**
     * Returns the set language paths
     * 
     * @return \mithra62\array
     */
    public function getLangPath()
    {
        return $this->lang_paths;
    }

    /**
     * Sets the DI Container object
     * 
     * @param \Pimple\Container $container            
     */
    public function setContainer(\Pimple\Container $container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * Returns an instance of the DI Container
     * 
     * @return \Pimple\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Sets the database connection details
     * 
     * @param array $config            
     */
    public function setDbConfig(array $config)
    {
        $this->config['db'] = $config;
    }

    /**
     * Returns the database configuration details
     * 
     * @return \mithra62\array
     */
    public function getDbConfig()
    {
        return $this->config['db'];
    }

    /**
     * Sets a new service outside of the bootstrap object
     * 
     * @param string $name
     *            The name of the new service
     * @param \Closure $function
     *            The Closure to execute when the service is called
     * @return \mithra62\Bootstrap
     */
    public function setService($name, \Closure $function)
    {
        $this->container[$name] = $function;
        return $this;
    }

    /**
     * Sets up and returns all the objects we'll use
     * 
     * @return \mithra62\Language|\Pimple\Container
     */
    public function getServices()
    {
        $this->container['db'] = function ($c) {
            $db = new Db();
            $db->setCredentials($this->getDbConfig());
            $type = 'pdo';
            if( function_exists('mysqli_select_db'))
            {
                $type = 'mysqli';
            }
            
            $db->setAccessType($type);
            return $db;
        };
        
        $this->container['encrypt'] = function ($c) {
            $encrypt = new Encrypt();
            $new_key = $c['platform']->getEncryptionKey();
            $encrypt->setKey($new_key);
            return $encrypt;
        };
        
        $this->container['lang'] = function ($c) {
            $lang = new Language();
            if (is_array($this->getLangPath())) {
                foreach ($this->getLangPath() as $path) {
                    $lang->init($path);
                }
            } elseif ($this->getLangPath() != '') {
                $lang->init($this->getLangPath());
            }
            return $lang;
        };
        
        $this->container['validate'] = function ($c) {
            $validate = new Validate();
            $validate->setRegex($this->container['regex']);
            return $validate;
        };
        
        $this->container['files'] = function ($c) {
            $file = new Files();
            return $file;
        };
        
        $this->container['errors'] = function ($c) {
            $errors = new Errors();
            $errors->setValidation($c['validate']);
            return $errors;
        };
        
        $this->container['license'] = function ($c) {
            $license = new License();
            return $license;
        };
        
        $this->container['email'] = function ($c) {
            
            $email = new Email();
            $email->setView($c['view']);
            $email->setLang($c['lang']);
            return $email;
        };
        
        $this->container['view'] = function ($c) {
            $view = new View();
            $helpers = array(
                'file_size' => function ($text) {
                    return $this->container['view_helpers']->m62FileSize($text, false);
                },
                'lang' => function ($text) {
                    return $this->container['view_helpers']->m62Lang($text);
                },
                'date_time' => function ($text, $html = true) {
                    return $this->container['view_helpers']->m62DateTime($text, false);
                },
                'relative_time' => function ($date) {
                    return $this->container['view_helpers']->m62RelativeDateTime($date);
                },
                'encode' => function ($text) {
                    return $this->container['view_helpers']->m62Encode($text);
                },
                'decode' => function ($text) {
                    return $this->container['view_helpers']->m62Decode($text);
                }
            );
            
            $view->addHelper('m62', $helpers);
            return $view;
        };
        
        $this->container['regex'] = function ($c) {
            $regex = new Regex();
            return $regex;
        };
        
        $this->container['shell'] = function ($c) {
            $shell = new Shell();
            return $shell;
        };
        
        $this->container['console'] = function ($c) {
            $console = new Console();
            $console->setLang($c['lang']);
            return $console;
        };
        
        return $this->container;
    }
}