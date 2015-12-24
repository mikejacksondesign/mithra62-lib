<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/S3/Bukets/Readable.php
 */
namespace mithra62\Validate\Rules\Rcf\Containers;

use mithra62\Validate\AbstractRule;
use mithra62\Remote;
use mithra62\Remote\Rcf;
if (! class_exists('\\mithra62\\Validate\\Rules\\Rcf\\Containers\\Readable')) {

    /**
     * mithra62 - Directory Validation Rule
     *
     * Validates that a given input is a directory
     *
     * @package Validate\Rules\S3\Buckets
     * @author Eric Lamb <eric@mithra62.com>
     */
    class Readable extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var string
         */
        protected $name = 'rcf_container_readable';

        /**
         * The error template
         * 
         * @var string
         */
        protected $error_message = 'Your container doesn\'t appear to be readable...';

        /**
         * (non-PHPdoc)
         * 
         * @see \mithra62\Validate\RuleInterface::validate()
         * @ignore
         *
         */
        public function validate($field, $input, array $params = array())
        {
            try {
                if ($input == '' || empty($params['0'])) {
                    return false;
                }
                
                $params = $params['0'];
                if (empty($params['rcf_username']) || empty($params['rcf_api']) || empty($params['rcf_container'])) {
                    return false;
                }
                
                $client = Rcf::getRemoteClient($params, true);
                
                if ($client instanceof \OpenCloud\ObjectStore\Resource\Container) {
                    $filesystem = new Remote(new Rcf($client, $params['rcf_container']));
                    $filesystem->getAdapter()->listContents();
                    return true;
                }
            } catch (\Exception $e) {
                return false;
            }
        }
    }
}