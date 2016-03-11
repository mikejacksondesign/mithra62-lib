<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2016, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Rest.php
 */
 
namespace mithra62;

/**
 * mithra62 - REST Object
 *
 * Base REST object 
 *
 * @package Rest
 * @author Eric Lamb <eric@mithra62.com>
 */
class Rest
{
    /**
     * The Language object
     * @var Language
     */
    protected $lang = null;
    
    /**
     * The Platform object
     * @var Platforms\AbstractPlatform
     */
    protected $platform = null;
    
    /**
     * The Server object
     * @var Rest\AbstractServer
     */
    protected $server = null;
    
    /**
     * Returns an instance of the REST Server
     * @return \Rest\AbstractServer
     */
    public function getServer()
    {
        throw new \Exception("Not implemented!");
    }
    
    /**
     * Sets the Platform object
     * @param \mithra62\Platforms\AbstractPlatform $platform
     * @return \mithra62\Rest
     */
    public function setPlatform(\mithra62\Platforms\AbstractPlatform $platform)
    {
        $this->platform = $platform;
        return $this;
    }
    
    /**
     * Sets the Language object to use
     * @param \mithra62\Language $lang
     * @return \mithra62\Rest
     */
    public function setLang(\mithra62\Language $lang)
    {
        $this->lang = $lang;
        return $this;
    }
}