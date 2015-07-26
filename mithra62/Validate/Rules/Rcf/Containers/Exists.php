<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/Rcf/Containers/Exists.php
 */
 
namespace mithra62\Validate\Rules\Rcf\Containers;

use mithra62\Remote\Rcf AS m62Rcf;
use mithra62\Validate\AbstractRule;

if( !class_exists('\\mithra62\\Validate\\Rules\\Rcf\\Container\\Exists') )
{
    /**
     * mithra62 - S3 Bucket Existance Validation Rule
     *
     * Validates that a given bucket name exists in S3
     *
     * @package 	Validate\Rules\S3\Buckets
     * @author		Eric Lamb <eric@mithra62.com>
     */
    class Exists extends AbstractRule
    {
        /**
         * The Rule shortname
         * @var string
         */        
        protected $name = 'rcf_container_exists';
        
        /**
         * The error template
         * @var string
         */        
        protected $error_message = 'Your bucket doesn\'t appear to exist...';
        
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
                if( empty($params['rcf_username']) || empty($params['rcf_api']) || empty($params['rcf_container']) )
                {
                    return false;
                }
            
                return m62Rcf::getRemoteClient($params);
            }
            catch (\Exception $e)
            {
                return false;
            }        
        }
    }
}