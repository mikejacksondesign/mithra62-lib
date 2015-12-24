<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/AbstractRule.php
 */
namespace mithra62\Validate;

use mithra62\Validate\RuleInterface;
use mithra62\Exceptions\ValidateException;

/**
 * mithra62 - Abstract Validation Rule
 *
 * Contains useful helper methods for the validators
 *
 * @package Validate
 * @author Eric Lamb <eric@mithra62.com>
 */
abstract class AbstractRule implements RuleInterface
{

    /**
     * The shortname of the rule
     * Must be unique!
     * 
     * @var string
     */
    protected $name = '';

    /**
     * The error template
     * 
     * @var string
     */
    protected $error_message = '';

    /**
     * The name of the test file for upload testing
     * 
     * @var string
     */
    protected $test_file = 'test.txt';

    /**
     * The content the test file should contain for comparison testing
     * 
     * @var string
     */
    protected $test_string = 'm62';

    /**
     * Returns the path to the test file
     */
    protected function getTestFilePath()
    {
        return realpath(dirname(__FILE__) . '/' . $this->test_file);
    }

    /**
     * (non-PHPdoc)
     * 
     * @ignore
     *
     * @see \mithra62\Validate\RuleInterface::getErrorMessage()
     */
    public function getErrorMessage()
    {
        if ($this->error_message == '') {
            throw new ValidateException('Error Message is empty!');
        }
        
        return $this->error_message;
    }

    /**
     * Sets the error message for the rule
     * 
     * @param string $message            
     * @return RuleInterface
     */
    public function setErrorMessage($message)
    {
        $this->error_message = $message;
        return $this;
    }

    /**
     * Sets the name parameter
     * 
     * @param string $name            
     * @return RuleInterface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * (non-PHPdoc)
     * 
     * @ignore
     *
     * @see \mithra62\Validate\RuleInterface::getName()
     */
    public function getName()
    {
        if ($this->name == '') {
            throw new ValidateException('Rule name is empty!');
        }
        
        return $this->name;
    }
}