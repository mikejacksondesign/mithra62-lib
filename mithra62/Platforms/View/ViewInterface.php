<?php
/**
 * mithra62 - Backup Pro
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/BackupPro/Platforms/View/ViewInterface.php
 */
namespace mithra62\Platforms\View;

/**
 * Backup Pro - View Interface
 *
 * Defines the view helpers for we provide
 *
 * @package View
 * @author Eric Lamb <eric@mithra62.com>
 */
interface ViewInterface
{

    /**
     * Just passes to the Language object for translation
     * 
     * @param string $string
     *            The language key to translate
     * @return \mithra62\string
     */
    public function m62Lang($string);

    /**
     * Formats a file value into a human readable format
     * 
     * @param string $string            
     * @return \mithra62\string
     */
    public function m62FileSize($string);

    /**
     * Formats a date
     * 
     * @param string $date            
     * @param string $html            
     * @return string
     */
    public function m62DateTime($date, $html = true);

    /**
     * Encodes a string securely
     * 
     * @param string $string            
     * @return string
     */
    public function m62Encode($string);

    /**
     * Decodes a string securely
     * 
     * @param string $string            
     * @return string
     */
    public function m62Decode($string);
    
    /**
     * Creates a date in human readable format (1 hour, 7 years, etc...)
     *
     * @param unknown $date
     * @return string
     */
    public function m62RelativeDateTime($date);
    
    /**
     * Formats a time string into a human friendly format
     *
     * @param number $time
     * @param string $html
     * @param number $truncate
     * @return string
     */
    public function m62TimeFormat($time, $html = true, $truncate = 1);
    
    /**
     * Returns a string to use for the form field errors
     * @param array $errors
     * @return string
     */
    public function m62FormErrors($errors);
    
    /**
     * Should escape a string for use in a webpage
     * @param string $string
     * @return string
     */
    public function m62Escape($string);
    
    /**
     * Should return an array for select dropdowns based on the $type
     * @param string $type The key to use for selecting which option set
     * @param bool $translate Whether to translate the options 
     * @return array
     */
    public function m62Options($type, $translate = true);
}