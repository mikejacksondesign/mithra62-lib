<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Regex.php
 */
 
namespace mithra62;

use RegexGuard\RegexGuard;
use mithra62\Exceptions\RegexException;

/**
 * mithra62 - Regex Object
 *
 * Regular Expression execution and validation object
 *
 * @package 	Regex
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Regex
{
    /**
     * The Regex library we're using
     * @var \RegexGuard\RegexGuard
     */
    private $instance = null;
    
    /**
     * Returns an instance of the library
     * @return \RegexGuard\RegexGuard
     */
    private function getInstance()
    {
        if( is_null($this->instance) )
        {
            $this->instance = \RegexGuard\Factory::getGuard();
        }
        
        return $this->instance;
    }
    
    /**
     * Validates a given regular expression
     * @param string $regexp
     * @return boolean
     */
    public function validate($regexp)
    {
        return $this->getInstance()->isRegexValid($regexp);
    }
    
    /**
     * Matches  a regular expression
     * @param string $pattern
     * @param string $subject
     */
    public function match($pattern, $subject)
    {
        if( !$this->validate($pattern) )
        {
            return false;
        }
        
        return $this->getInstance()->match($pattern, $subject);
    }
}