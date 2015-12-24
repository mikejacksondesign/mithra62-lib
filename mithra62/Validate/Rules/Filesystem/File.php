<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Filesystem/File.php
 */
namespace mithra62\Validate\Rules\Filesystem;

use mithra62\Validate\AbstractRule;
if (! class_exists('\\mithra62\\Validate\\Filesystem\\File')) {

    /**
     * mithra62 - File Validation Rule
     *
     * Validates that a given input is a file
     *
     * @package Validate\Rules\Filesystem
     * @author Eric Lamb <eric@mithra62.com>
     */
    class File extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var string
         */
        protected $name = 'file';

        /**
         * The error template
         * 
         * @var string
         */
        protected $error_message = '{field} has to be a file';

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
                return $input->isFile();
            }
            
            return (is_string($input) && is_file($input));
        }
    }
}