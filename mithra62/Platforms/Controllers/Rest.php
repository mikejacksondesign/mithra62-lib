<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2016, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Rest/Platforms/Controllers/Rest.php
 */
 
namespace mithra62\Platforms\Controllers;

/**
 * mithra62 - REST Base Controller
 *
 * Contains the global REST methods
 *
 * @package Rest\Authentication
 * @author Eric Lamb <eric@mithra62.com>
 */
class Rest
{
    protected $body_data = null;
    
    /**
     * Authenticates the request
     * @return boolean
     */
    public function authenticate()
    {
        $hmac = $this->rest->getServer()->getHmac();
        $data = array_merge($this->getRequestHeaders(true), $this->getBodyData());
        $auth = $hmac->setData($data)
                     ->setRoute($this->platform->getPost('bp_method'))
                     ->setMethod($_SERVER['REQUEST_METHOD'])
                     ->auth($this->settings['api_key'], $this->settings['api_secret']);
        
        if(!$auth) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Returns the input data as an array
     * @return array
     */
    public function getBodyData()
    {
        if(is_null($this->body_data)) 
        {
            $data = json_decode(file_get_contents("php://input"), true);
            if(!$data)
            {
                $data = array();
            }
            
            $this->body_data = $data;
        }
        
        return $this->body_data;
    }
    
    /**
     * Returns an associative array of the request headers
     * @return multitype:unknown
     */
    public function getRequestHeaders($auth = true)
    {
        $headers = \getallheaders();
        if($auth) {
            $hmac = $this->rest->getServer()->getHmac();
            $return = array(
                $hmac->getPrefix().'timestamp' => $headers[$hmac->getPrefix().'timestamp'],
                $hmac->getPrefix().'signature' => $headers[$hmac->getPrefix().'signature'],
                $hmac->getPrefix().'key' => $headers[$hmac->getPrefix().'key'],
                $hmac->getPrefix().'version' => $headers[$hmac->getPrefix().'version'],
            );
            $headers = $return;
        }
        
        return $headers;
    }
    
    /**
     * Handy little method to disable unused HTTP verb methods
     *
     * @return \ZF\ApiProblem\ApiProblemResponse
     */
    protected function methodNotAllowed()
    {
        return $this->view_helper->renderError(405, 'method_not_allowed');
    }
    
    /**
     * Prepares the OPTIONS verb
     * @param string $id
     */
    public function options($id = false)
    {
        return;
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
     */
    public function create($data)
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
     */
    public function post()
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::delete()
     */
    public function delete($id = false)
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::deleteList()
     */
    public function deleteList()
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::get()
     */
    public function get($id = false)
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::getList()
     */
    public function getList()
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::head()
     */
    public function head($id = null)
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::patch()
     */
    public function patch($id)
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::patch()
     */
    public function put($id = false)
    {
        return $this->methodNotAllowed();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::update()
     */
    public function update($id, $data)
    {
        return $this->methodNotAllowed();
    }
}