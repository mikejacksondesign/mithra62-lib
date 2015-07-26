<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rcf/Connect.php
 */
 
namespace mithra62\Validate\Rules\Rcf;

use mithra62\Remote\Rcf AS m62Rcf;
use mithra62\Validate\AbstractRule;

if( !class_exists('\\mithra62\\Validate\\Rules\\Rcf\\Connect') )
{
    /**
     * mithra62 - Directory Validation Rule
     *
     * Validates that a given input is a directory
     *
     * @package 	Validate\Rules\Rcf
     * @author		Eric Lamb <eric@mithra62.com>
     */
    class Connect extends AbstractRule
    {
        /**
         * The Rule shortname
         * @var string
         */
        protected $name = 'rcf_connect';
        
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
                if( empty($params['rcf_username']) || empty($params['rcf_api']) )
                {
                    return false;
                }
            
                return m62Rcf::getRemoteClient($params, false);
            }
            catch (\Exception $e)
            {
                echo $e->getMessage();
                exit;
                return false;
            }        
        }
    }
}