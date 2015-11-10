<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/Sftp/Connect.php
 */
 
namespace mithra62\Validate\Rules\Sftp;

use mithra62\Validate\AbstractRule;
use mithra62\Remote;
use mithra62\Remote\Sftp;

if( !class_exists('\\mithra62\\Validate\\Rules\\Sftp\\Connect') )
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
        protected $name = 'sftp_connect';
        
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
                if( empty($params['sftp_host']) || empty($params['sftp_port']) || empty($params['sftp_root']) )
                {
                    return false;
                }
                
                //we require either a private key file OR a username and password
                if( (empty($params['sftp_password']) && empty($params['sftp_username'])) && empty($params['sftp_private_key']) )
                {
                    return false;
                }
                
                $filesystem = new Remote( Sftp::getRemoteClient($params) );
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