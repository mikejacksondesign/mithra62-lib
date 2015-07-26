<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Errors.php
 */
 
namespace mithra62;

/**
 * mithra62 - Error Object
 *
 * Checks the base system to ensure everything's in place for use
 *
 * @package 	Errors
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Errors 
{
    /**
     * The system settings
     * @var array
     */
    protected $settings = array();
    
    /**
     * Contains an array of the errors found
     * @var array
     */
    protected $errors = array();
    
    /**
     * The Validation object
     * @var \mithra62\Validate
     */
    protected $validation = null;  

    /**
     * Returns the total number of errors
     * @return int
     */
    public function totalErrors()
    {
        return count( $this->getErrors() );
    }
    
    /**
     * Returns just a single error
     * @return mixed
     */
    public function getError()
    {
        return array_pop( $this->getErrors() );
    }
    
    /**
     * Returns all the errors found
     * @return \mithra62\array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * Sets the settings to check
     * @param array $settings
     * @return \mithra62\Errors
     */
    public function setSettings(array $settings)
    {
        $this->settings = $settings;
        return $this;
    }
    
    /**
     * Returns the set settings array
     * @return \mithra62\array
     */
    public function getSettings()
    {
        return $this->settings;
    }
    
    /**
     * Clears out any errors that were added
     * @return \mithra62\Errors
     */
    public function clearErrors()
    {
        $this->errors = array();
        return $this;
    }
    
    /**
     * Sets the Validation object
     * @param \mithra62\Validate $val
     * @return \mithra62\Errors
     */
    public function setValidation(\mithra62\Validate $val)
    {
        $this->validation = $val;
        return $this;
    }
    
    /**
     * Returns an instance of the validation object 
     * @return \mithra62\Validate
     */
    public function getValidation()
    {
        return $this->validation;
    }
    
    /**
     * Sets an error
     * @param string $name The key the error will be placed at in the error array
     * @param string $error The error message language key
     */
    public function setError($name, $error)
    {
        $this->errors[$name] = $error;
    }
    
    /**
     * Verifies the license key is valid
     * @param unknown $license_key
     * @param \mithra62\License $license
     * @return \mithra62\Errors
     */
    public function licenseCheck($license_key, \mithra62\License $license)
    {
        if($license_key == '')
        {
            $this->setError('license_number', 'missing_license_number');
        }
        else
        {
            if(!$license->validLicense($license_key))
            {
                $this->setError('license_number', 'invalid_license_number');
            }
        }
        
        return $this;
    }
}