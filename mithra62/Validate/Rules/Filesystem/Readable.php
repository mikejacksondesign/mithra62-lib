<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/Filesystem/Readable.php
 */
namespace mithra62\Validate\Rules\Filesystem;

use mithra62\Validate\AbstractRule;
if (! class_exists('\\mithra62\\Validate\\Filesystem\\Readable')) {

    /**
     * mithra62 - Readable Validation Rule
     *
     * Validates that a given input is a readable file or directory
     *
     * @package Validate\Rules\Filesystem
     * @author Eric Lamb <eric@mithra62.com>
     */
    class Readable extends AbstractRule
    {

        /**
         *
         * @ignore
         *
         * @var unknown
         */
        protected $name = 'readable';

        /**
         *
         * @ignore
         *
         * @var unknown
         */
        protected $error_message = '{field} has to be readable';

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
                return $input->isReadable();
            }
            
            return (is_string($input) && is_readable($input));
        }
    }
}