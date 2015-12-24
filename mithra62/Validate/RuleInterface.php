<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/RuleInterface.php
 */
namespace mithra62\Validate;

/**
 * mithra62 - Validation Rule Interface
 *
 * Interface all mithra62 Validation rules must extend
 *
 * @package Validate
 * @author Eric Lamb <eric@mithra62.com>
 */
interface RuleInterface
{

    /**
     * Should return a boolean based on input
     * 
     * @param string $field
     *            The field name to be validated
     * @param unknown $input
     *            The value to validate
     * @param array $params
     *            Any optional parameters the validation should use
     */
    public function validate($field, $input, array $params = array());

    /**
     * Should return an array of error messages
     * 
     * @return array
     */
    public function getErrorMessage();

    /**
     * Sets the error message for the rule
     * 
     * @param string $message            
     * @return RuleInterface
     */
    public function setErrorMessage($message);

    /**
     * Sets the name parameter
     * 
     * @param string $name            
     * @return RuleInterface
     */
    public function setName($name);

    /**
     * Should return the name parameter
     */
    public function getName();
}