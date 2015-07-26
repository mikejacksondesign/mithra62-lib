<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Ftp/Connect.php
 */
 
namespace mithra62\Validate\Rules\Ftp;

use mithra62\Validate\AbstractRule;
use mithra62\Remote;
use mithra62\Remote\Ftp;

if( !class_exists('\\mithra62\\Validate\\Rules\\Ftp\\Connect') )
{
    /**
     * mithra62 - FTP Connection Validation Rule
     *
     * Validates that a given credential set is accurate and working for connecting to an FTP site
     *
     * @package 	Validate\Rules\Ftp
     * @author		Eric Lamb <eric@mithra62.com>
     */
    class Connect extends AbstractRule
    {
        /**
         * The Rule shortname
         * @var string
         */        
        protected $name = 'ftp_connect';
        
        /**
         * The error template
         * @var string
         */        
        protected $error_message = 'Can\'t connect to {field}';
        
        /**
         * (non-PHPdoc)
         * @see \mithra62\Validate\RuleInterface::validate()
         * @ignore
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
                if( empty($params['ftp_hostname']) || empty($params['ftp_password']) || empty($params['ftp_username']) || empty($params['ftp_port']) )
                {
                    return false;
                }
                
                $filesystem = new Remote( FTP::getRemoteClient($params) );
                if( !$filesystem->getAdapter()->listContents() )
                {
                    return false;
                }
                
                $filesystem->getAdapter()->disconnect();
                return true;
            }
            catch (\Exception $e)
            {
               return false;
            }
        }    
    }
}