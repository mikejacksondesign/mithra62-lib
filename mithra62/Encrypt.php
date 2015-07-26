<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Encrypt.php
 */
 
namespace mithra62;

use phpseclib\Crypt\AES;

/**
 * mithra62 - Encryption Object
 *
 * Handles encrypting and decrypting items from and for storage
 *
 * @package 	Encrypt
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Encrypt
{
    /**
     * The encryption key/salt to use for the request
     * @var string
     */
    protected $key = 'MolliePosellIsLikeSoAmazingYouCantEvenLookWithoutYourHeadBlowingUp';
    
    /**
     * The encryption library we're using
     * @var \Crypt_AES
     */
    protected $api = null;
    
    /**
     * Sets the encryption key
     * @param string $key
     * @return \mithra62\Encrypt
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
    
    /**
     * Returns the encryption key
     * @return \mithra62\string
     */
    public function getKey()
    {
        return $this->key;
    }
    
    /**
     * Encrypts a string
     * @param string $string The string to encrypt
     * @return string
     */
    public function encode($string)
    {
        return base64_encode($this->getApi()->encrypt($string));
    }
    
    /**
     * Decrypts a previously encrypted string
     * @param string $string The string to decrypt
     * @return string
     */
    public function decode($string)
    {
        return $this->getApi()->decrypt(base64_decode($string));
    }
    
    /**
     * Returns an instance of the Crypto library
     * @return Crypt_AES
     */
    public function getApi()
    {
        if( is_null($this->api) )
        {
            $this->api = new AES();
            $this->api->setKey($this->getKey());
        }
        
        return $this->api;
    }
}