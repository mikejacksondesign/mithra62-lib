<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Gcs/Connect.php
 */
 
namespace mithra62\Validate\Rules\Gcs;

use mithra62\Remote\Gcs AS m62Gcs; 
use mithra62\Validate\AbstractRule;

if( !class_exists('\\mithra62\\Validate\\Rules\\Gcs\\Connect') )
{
    /**
     * mithra62 - Google Cloud Storage Connection Validation Rule
     *
     * Validates that a given connection detail set can connect to Google Cloud Storage
     *
     * @package 	Validate\Rules\Gcs
     * @author		Eric Lamb <eric@mithra62.com>
     */
    class Connect extends AbstractRule
    {
        /**
         * The Rule shortname
         * @var string
         */
        protected $name = 'gcs_connect';
        
        /**
         * The error template
         * @var string
         */
        protected $error_message = 'Can\'t connect to {field}';
        
        /**
         * (non-PHPdoc)
         * @ignore
         * @see \mithra62\Validate\RuleInterface::validate()
         */
        public function validate($field, $input, array $params = array())
        {
            try
            {
                if( $input == '' || empty($params['0']) )
                {
                    return false;
                }
                $params = $params['0'];
                if( empty($params['gcs_access_key']) || empty($params['gcs_secret_key']) )
                {
                    return false;
                }
                
                $client = m62Gcs::getRemoteClient($params['gcs_access_key'], $params['gcs_secret_key']);
                $client->listBuckets();
                return true;
            }
            catch (\Exception $e)
            {
                return false;
            }        
        }
    }
}