<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/Gcs/Buckets/Readable.php
 */
namespace mithra62\Validate\Rules\Gcs\Buckets;

use mithra62\Validate\AbstractRule;
use mithra62\Remote;
use mithra62\Remote\Gcs as m62Gcs;
if (! class_exists('\\mithra62\\Validate\\Rules\\Gcs\\Buckets\\Readable')) {

    /**
     * mithra62 - Directory Validation Rule
     *
     * Validates that a given input is a directory
     *
     * @package Validate\Rules\Gcs\Buckets
     * @author Eric Lamb <eric@mithra62.com>
     */
    class Readable extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var string
         */
        protected $name = 'gcs_bucket_readable';

        /**
         * The error template
         * 
         * @var string
         */
        protected $error_message = 'Your bucket doesn\'t appear to be readable...';

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
                if (empty($params['gcs_access_key']) || empty($params['gcs_secret_key']) || empty($params['gcs_bucket'])) {
                    return false;
                }
                
                $client = m62Gcs::getRemoteClient($params['gcs_access_key'], $params['gcs_secret_key']);
                if ($client->doesBucketExist($params['gcs_bucket'])) {
                    $filesystem = new Remote(new m62Gcs($client, $params['gcs_bucket']));
                    $filesystem->getAdapter()->listContents();
                    return true;
                }
            } catch (\Exception $e) {
                return false;
            }
        }
    }
}