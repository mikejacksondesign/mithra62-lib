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
use mithra62\License as m62License;
if (! class_exists('\\mithra62\\Validate\\Rules\\License')) {

    /**
     * mithra62 - License Key Rule
     *
     * Checks an input to see if it's a valid license key
     *
     * @package Validate\Rules
     * @author Eric Lamb <eric@mithra62.com>
     */
    class License extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var unknown
         */
        protected $name = 'license_key';

        /**
         * the error template
         * 
         * @var string
         */
        protected $error_message = '{field} isn\'t a valid license key';

        /**
         * (non-PHPdoc)
         * 
         * @see \mithra62\Validate\RuleInterface::validate()
         * @ignore
         *
         */
        public function validate($field, $input, array $params = array())
        {
            $license = new m62License();
            return $license->validLicense($input);
        }
    }
}