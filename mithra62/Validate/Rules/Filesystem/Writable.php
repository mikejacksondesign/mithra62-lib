<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Filesystem/Writable.php
 */
namespace mithra62\Validate\Rules\Filesystem;

use mithra62\Validate\AbstractRule;
if (! class_exists('\\mithra62\\Validate\\Filesystem\\Writable')) {

    /**
     * mithra62 - Writable Validation Rule
     *
     * Validates that a given input is a writable file or directory
     *
     * @package Validate\Rules\Filesystem
     * @author Eric Lamb <eric@mithra62.com>
     */
    class Writable extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var string
         */
        protected $name = 'writable';

        /**
         * The error template
         * 
         * @var string
         */
        protected $error_message = '{field} has to be writable';

        /**
         * (non-PHPdoc)
         * 
         * @see \mithra62\Validate\RuleInterface::validate()
         * @ignore
         *
         */
        public function validate($field, $input, array $params = array())
        {
            if ($input instanceof \SplFileInfo) {
                return $input->isWritable();
            }
            
            return (is_string($input) && is_writable($input));
        }
    }
}