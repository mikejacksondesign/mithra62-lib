<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Filesystem/Dir.php
 */
namespace mithra62\Validate\Rules\Filesystem;

use mithra62\Validate\AbstractRule;
if (! class_exists('\\mithra62\\Validate\\Rules\\Filesystem\\Dir')) {

    /**
     * mithra62 - Directory Validation Rule
     *
     * Validates that a given input is a directory
     *
     * @package Validate\Rules\Filesystem
     * @author Eric Lamb <eric@mithra62.com>
     */
    class Dir extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var string
         */
        protected $name = 'dir';

        /**
         * The error template
         * 
         * @var string
         */
        protected $error_message = '{field} has to be a directory';

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
                return $input->isDir();
            }
            
            return (is_string($input) && is_dir($input));
        }
    }
}