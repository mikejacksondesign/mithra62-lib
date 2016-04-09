<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/License.php
 */
namespace mithra62;

/**
 * mithra62 - Licensing Object
 *
 * Contains the methods for validating the host system
 *
 * @package License
 * @author Eric Lamb <eric@mithra62.com>
 */
class License
{

    /**
     * The Setting object
     * 
     * @var \mithra62\Settings
     */
    protected $setting = null;

    /**
     * Sets the Setting object
     * 
     * @param \mithra62\Settings $settings            
     * @return \mithra62\License
     */
    public function setSetting(\mithra62\Settings $settings)
    {
        $this->setting = $settings;
        return $this;
    }

    /**
     * Validates a license number is valid
     * 
     * @param string $license            
     * @return number
     */
    public function validLicense($license)
    {
        return preg_match("/^([a-z0-9]{8})-([a-z0-9]{4})-([a-z0-9]{4})-([a-z0-9]{4})-([a-z0-9]{12})$/", $license);
    }
}