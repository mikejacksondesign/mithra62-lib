<?php
namespace mithra62\Platforms\Controllers;

class Rest
{
    /**
     * Authenticates the request
     * @return boolean
     */
    public function authenticate()
    {
        $data = $this->getRequestHeaders();
        $hmac = $this->rest->getServer()->getHmac();
        return $hmac->setData($data)
        ->setRoute($this->platform->getPost('bp_method'))
        ->setMethod($_SERVER['REQUEST_METHOD'])
        ->auth($this->settings['api_key'], $this->settings['api_secret']);
    }
    
    /**
     * Returns the input data as an array
     * @return array
     */
    public function getBodyData()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if(!$data)
        {
            return array();
        }
    
        return $data;
    }
    
    /**
     * Returns an associative array of the request headers
     * @return multitype:unknown
     */
    public function getRequestHeaders()
    {
        return \getallheaders();
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