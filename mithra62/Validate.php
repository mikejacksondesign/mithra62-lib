<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate.php
 */
namespace mithra62;

use Valitron\Validator;
use mithra62\Exceptions\ValidateException;

/**
 * mithra62 - Validation Object
 *
 * Object to manage system settings
 *
 * @package Validate
 * @author Eric Lamb <eric@mithra62.com>
 */
class Validate extends Validator
{

    /**
     * The regex engine
     * 
     * @var \mithra62\Regex
     */
    protected $regex = null;

    /**
     * Overrides the initial validation constructor
     * 
     * @throws \InvalidArgumentException
     */
    public function __construct()
    {
        $langDir = static::langDir();
        
        $lang = static::lang();
        // Load language file in directory
        $langFile = rtrim($langDir, '/') . '/' . $lang . '.php';
        if (stream_resolve_include_path($langFile)) {
            $langMessages = include $langFile;
            static::$_ruleMessages = array_merge(static::$_ruleMessages, $langMessages);
        } else {
            throw new \InvalidArgumentException("fail to load language file '$langFile'");
        }
        
        $this->loadRules();
    }

    /**
     * Adds all the custom rules
     * 
     * @throws ValidateException
     */
    protected function loadRules()
    {
        $old_cwd = getcwd();
        chdir(__DIR__);
        $path = 'Validate' . DIRECTORY_SEPARATOR . 'Rules';
        if (! is_dir($path)) {
            throw new ValidateException("Rules Directory " . $path . " isn't a directory...");
        }
        
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::LEAVES_ONLY);
        
        foreach ($files as $file) {
            if (! $file->isDir()) {
                $name = '\\mithra62\\' . str_replace('/', '\\', str_replace('.php', '', $file->getPathname()));
                $class = $name;
                if (class_exists($class)) {
                    $rule = new $class();
                    if ($rule instanceof Validate\RuleInterface) {
                        self::addRule($rule->getName(), array(
                            $rule,
                            'validate'
                        ), $rule->getErrorMessage());
                    }
                }
            }
        }
        
        chdir($old_cwd);
    }

    /**
     * Processes the validation group
     * 
     * @param array $data            
     * @return \Valitron\boolean
     */
    public function val(array $data)
    {
        $this->_fields = $data;
        $labels = array();
        foreach ($data as $key => $value) {
            $labels[$key] = ucwords(str_replace('_', ' ', $key));
        }
        
        $this->labels($labels);
        
        return parent::validate();
    }

    /**
     * Checks if there are errors and returns a boolean
     * 
     * @return boolean
     */
    public function hasErrors()
    {
        if (count($this->errors()) != '0') {
            return true;
        }
        
        return false;
    }

    /**
     * Returns the error messages
     * 
     * @return Ambigous <\Valitron\array, \Valitron\bool>
     */
    public function getErrorMessages()
    {
        return $this->errors();
    }

    /**
     * Returns an array of all the custom rules
     * 
     * @return array
     */
    public function getCustomRules()
    {
        return static::$_rules;
    }

    /**
     * Sets the regular expression engine
     * 
     * @param \mithra62\Regex $regex            
     * @return \mithra62\Validate
     */
    public function setRegex(\mithra62\Regex $regex)
    {
        $this->regex = $regex;
        return $this;
    }
    
    public function getRegex()
    {
        return $this->regex;
    }
}