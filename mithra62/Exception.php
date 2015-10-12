<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Exception.php
 */
 
namespace mithra62; 

use Phine\Exception\Exception AS Phine;
use mithra62\Traits\Log;

/**
 * mithra62 - Exception Object
 *
 * Handles exceptions within the mithra62 system
 *
 * @package 	Exceptions
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Exception extends Phine
{ 
    use Log;
    
    /**
     * Logs an exeption 
     * @param \Exception $e
     * @return bool
     */
    public function logException(\Exception $e)
    {
        $error = $e->getMessage().$e->getTraceAsString();
        return $this->logEmergency($error);
    }
}