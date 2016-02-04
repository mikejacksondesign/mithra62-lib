<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/False.php
 */
namespace mithra62\Validate\Rules;

use mithra62\Validate\AbstractRule;
if (! class_exists('\\mithra62\\Validate\\Rules\\ForceFalse')) {

    /**
     * mithra62 - Force False Rule
     *
     * Will always throw a false error
     *
     * @package Validate\Rules
     * @author Eric Lamb <eric@mithra62.com>
     */
    class ForceFalse extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var unknown
         */
        protected $name = 'false';

        /**
         * the error template
         * 
         * @var string
         */
        protected $error_message = '{field} has an error';

        /**
         * (non-PHPdoc)
         * 
         * @see \mithra62\Validate\RuleInterface::validate()
         * @ignore
         *
         */
        public function validate($field, $input, array $params = array())
        {
            return false;
        }
    }
}