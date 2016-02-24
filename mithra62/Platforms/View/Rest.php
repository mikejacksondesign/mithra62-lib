<?php
/**
 * mithra62 - Backup Pro
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/BackupPro/Platforms/View/Rest.php
 */
namespace mithra62\Platforms\View;

use Nocarrier\Hal;

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
     * Returns an instance of the Hal object for use
     * @param string $route
     * @return Hal
     */
    public function getHal($route, array $item = array())
    {
        return new Hal($route, $item);
    }
    
}