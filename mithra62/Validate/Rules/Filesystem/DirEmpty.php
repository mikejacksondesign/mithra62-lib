<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Filesystem/DirEmpty.php
 */
namespace mithra62\Validate\Rules\Filesystem;

use mithra62\Validate\AbstractRule;
if (! class_exists('\\mithra62\\Validate\\Rules\\Filesystem\\DirEmpty')) {

    /**
     * mithra62 - Empty Directory Validation Rule
     *
     * Validates that a given input is an empty directory
     *
     * @package Validate\Rules\Filesystem
     * @author Eric Lamb <eric@mithra62.com>
     */
    class DirEmpty extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var string
         */
        protected $name = 'dir_empty';

        /**
         * The error template
         * 
         * @var string
         */
        protected $error_message = '{field} has to be an empty directory';

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
                if ($input->isDir()) {
                    $input = $input->getBasename();
                } else {
                    return false;
                }
            } else {
                if (! is_dir($input)) {
                    return false;
                }
            }
            
            $d = dir($input);
            while (false !== ($entry = $d->read())) {
                if ($entry != '.' && $entry != '..') {
                    return false;
                }
            }
            
            return true;
        }
    }
}