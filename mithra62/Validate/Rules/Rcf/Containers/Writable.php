<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/S3/Connect.php
 */
namespace mithra62\Validate\Rules\Rcf\Containers;

use mithra62\Remote\Rcf;
use mithra62\Validate\AbstractRule;
use mithra62\Remote;
use mithra62\Remote\Local;
if (! class_exists('\\mithra62\\Validate\\Rules\\Rcf\\Containers\\Writable')) {

    /**
     * mithra62 - Directory Validation Rule
     *
     * Validates that a given input is a directory
     *
     * @package Validate\Rules\Rcf\Buckets
     * @author Eric Lamb <eric@mithra62.com>
     */
    class Writable extends AbstractRule
    {

        /**
         * The shortname of the rule
         * 
         * @var string
         */
        protected $name = 'rcf_container_writable';

        /**
         * The error message template
         * 
         * @var string
         */
        protected $error_message = 'Your container doesn\'t appear to be writable...';

        /**
         * (non-PHPdoc)
         * 
         * @ignore
         *
         * @see \mithra62\Validate\RuleInterface::validate()
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
                
                $local = new Remote(new Local(dirname($this->getTestFilePath())));
                $client = Rcf::getRemoteClient($params, true);
                if ($client instanceof \OpenCloud\ObjectStore\Resource\Container) {
                    $contents = $local->read($this->test_file);
                    $filesystem = new Remote(new Rcf($client, $params['rcf_container']));
                    
                    if ($filesystem->has($this->test_file)) {
                        $filesystem->delete($this->test_file);
                    } else {
                        if ($filesystem->write($this->test_file, $contents)) {
                            $filesystem->delete($this->test_file);
                        }
                    }
                    
                    return true;
                }
            } catch (\Exception $e) {
                return false;
            }
        }
    }
}