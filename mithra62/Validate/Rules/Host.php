<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/Host.php
 */
namespace mithra62\Validate\Rules;

use mithra62\Validate\AbstractRule;
if (! class_exists('\\mithra62\\Validate\\Rules\\Host')) {

    /**
     * mithra62 - Host Rule
     *
     * Checks an input to see if it's a valid host in either IP or URL formats
     *
     * @package Validate\Rules
     * @author Eric Lamb <eric@mithra62.com>
     */
    class Host extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var unknown
         */
        protected $name = 'host';

        /**
         * the error template
         * 
         * @var string
         */
        protected $error_message = '{field} isn\'t a valid host (IP or hostname)';

        /**
         * (non-PHPdoc)
         * 
         * @see \mithra62\Validate\RuleInterface::validate()
         * @ignore
         *
         */
        public function validate($field, $input, array $params = array())
        {
            if (filter_var($input, \FILTER_VALIDATE_IP) === false && filter_var($input, \FILTER_VALIDATE_URL) === false) {
                return false;
            }
            
            return true;
        }
    }
}