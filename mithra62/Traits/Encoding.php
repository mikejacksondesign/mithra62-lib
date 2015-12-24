<?php
/**
 * mithra62 - Encoding
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Traits/Encoding.php
 */
namespace mithra62\Traits;

use \ForceUTF8\Encoding as ForceUtf8;

/**
 * mithra62 - String Encoding Trait
 *
 * Handles string conversion to utf-8
 *
 * @package Encoding
 * @author Eric Lamb <eric@mithra62.com>
 */
trait Encoding
{

    /**
     * Converts a string to UTF-8
     * 
     * @param unknown $string            
     * @return Ambigous <unknown, string>
     */
    public function toUtf8($string)
    {
        return ForceUtf8::fixUTF8($string);
    }
}