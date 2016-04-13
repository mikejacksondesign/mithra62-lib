<?php
/**
 * mithra62 - Backup Pro
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/Platforms/View/Rest.php
 */
namespace mithra62\Platforms\View;

use Nocarrier\Hal;
use Crell\ApiProblem\ApiProblem;

/**
 * Backup Pro - Rest View Object
 *
 * Contains the view helpers for Rest Requests
 *
 * @package BackupPro\View
 * @author Eric Lamb <eric@mithra62.com>
 */
class Rest extends AbstractView
{
    /**
     * The Platform object
     * @var \mithra62\Platforms\AbstractPlatform
     */
    protected $platform = null;
    
    /**
     * The System errors 
     * @var array
     */
    protected $system_errors = array();
    
    public function setSystemErrors(array $errors = array())
    {
        $this->system_errors = $errors;
        return $this;
    }
    
    /**
     * Returns any set system errors
     * @return array
     */
    public function getSystemErrors()
    {
        return $this->system_errors;
    }
    
    /**
     * Returns an instance of the Hal object for use
     * @param string $route
     * @return Hal
     */
    public function getHal($route, array $item = array())
    {
        return new Hal($route, $item);
    }
    
    /**
     * Returns an instance of ApiProblem object
     * @param string $title
     * @param string $type
     * @return \Crell\ApiProblem\ApiProblem
     */
    public function getApiProblem($title, $type)
    {
        return new ApiProblem($this->m62Lang($title), $type);
    }


    /**
     * Returns the data for output and sets the appropriate headers
     * @param \Nocarrier\Hal $hal
     * @return string
     */
    public function renderOutput(\Nocarrier\Hal $hal)
    {
        $this->sendHeaders();
        if($this->getSystemErrors())
        {
            $system_errors = array();
            foreach($this->getSystemErrors() As $key => $value) {
                $system_errors[$key] = $this->m62Lang($key);
            }
            $hal->setData($hal->getData() + array('_system_errors' => $system_errors));
    
        }
        if(isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos(strtolower($_SERVER['HTTP_ACCEPT_ENCODING']), 'xml') !== false)
        {
            header('Content-Type: application/hal+xml');
            return $hal->asXml(true);
        }
        else
        {
            header('Content-Type: application/hal+json');
            return $hal->asJson(true);
        }
    }
    
    /**
     * Wrapper to handle error output
     *
     * Note that $detail should be a key for language translation
     *
     * @param int $code The HTTP response code to send
     * @param string $title The title to display
     * @param array $errors Any errors to explain what went wrong
     * @param string $detail A human readable explanation of what happened
     * @param string $type A URI resource to deaper explanations on what happened
     */
    public function renderError($code, $title, array $errors = array(), $detail = null, $type = null)
    {
        http_response_code($code);
    
        $problem = $this->getApiProblem($title, $type);
        $problem->setStatus($code);
        $problem->setDetail($detail);
        if($errors)
        {
            $problem['errors'] = $errors;
        }
    
        $this->sendHeaders();
        if(isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos(strtolower($_SERVER['HTTP_ACCEPT_ENCODING']), 'xml') !== false)
        {
            header('Content-Type: application/problem+xml');
            return $problem->asXml(true);
        }
        else
        {
            header('Content-Type: application/problem+json');
            return $problem->asJson(true);
        }
    }
}