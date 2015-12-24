<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Traits/Log.php
 */
namespace mithra62\Traits;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

/**
 * mithra62 - Logging Trait
 *
 * Handles logging among all the other objects
 *
 * @package Logger
 * @author Eric Lamb <eric@mithra62.com>
 */
trait Log
{

    /**
     * The PSR-3 Logging object we're using
     * 
     * @var \Monolog\Logger
     */
    private $logger = null;

    /**
     * The path to where we're logging files
     * 
     * @var string
     */
    private $log_path = null;

    /**
     * Logs a generic error
     * 
     * @param string $error            
     * @return \Monolog\Boolean
     */
    public function logWarning($error)
    {
        return $this->getLogger()->addWarning($error);
    }

    /**
     * Logs a debug error
     * 
     * @param string $error            
     * @return \Monolog\Boolean
     */
    public function logDebug($error)
    {
        return $this->getLogger()->addDebug($error);
    }

    /**
     * Logs an error
     * 
     * @param string $error            
     * @return \Monolog\Boolean
     */
    public function logError($error)
    {
        return $this->getLogger()->addError($error);
    }

    /**
     * Logs an emergency instance
     * 
     * @param unknown $error            
     * @return \Monolog\Boolean
     */
    public function logEmergency($error)
    {
        return $this->getLogger()->addEmergency($error);
    }

    /**
     * Returns an instance of the logger (creating one if it doesn't exist yet)
     * 
     * @param string $name            
     * @return \Monolog\Logger
     */
    public function getLogger($name = 'm62')
    {
        if (is_null($this->logger)) {
            $this->logger = new Logger($name);
            $dateFormat = "Y n j, g:i a";
            $output = "%datetime% > %level_name% > %message% %context% %extra%\n";
            $formatter = new LineFormatter($output, $dateFormat);
            
            $stream = new StreamHandler($this->getPathToLogFile($name), Logger::DEBUG);
            $stream->setFormatter($formatter);
            
            $this->logger->pushHandler($stream);
        }
        
        return $this->logger;
    }

    /**
     * Returns the path to the log file
     * 
     * @param string $name
     *            The name of the log file to use
     * @return \mithra62\Traits::$log_path
     */
    public function getPathToLogFile($name = 'm62')
    {
        if (is_null($this->log_path)) {
            $this->log_path = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'logs') . DIRECTORY_SEPARATOR . $name . '.log';
        }
        
        return $this->log_path;
    }

    /**
     * Sets the path to the log file to use
     * 
     * @param string $path
     *            The full path to the log file
     * @return \mithra62\Traits\Log
     */
    public function setPathToLogFile($path)
    {
        $this->log_path = $path;
        $this->logger = null;
        return $this;
    }

    /**
     * Removes the logging file
     * 
     * @return \mithra62\Traits\Log
     */
    public function removeLogFile()
    {
        if (file_exists($this->log_path)) {
            $this->logger = null;
            unlink($this->log_path);
        }
        
        return $this;
    }
}