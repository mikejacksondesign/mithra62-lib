<?php
/**
 * mithra62 - Jaeger
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/Platforms/View/Eecms.php
 */
namespace mithra62\Platforms\View;

/**
 * Backup Pro - Eecms View Object
 *
 * Contains the view helpers for ExpressionEngine
 *
 * @package View
 * @author Eric Lamb <eric@mithra62.com>
 */
class Ee3 extends AbstractView
{
    /**
     * Returns a string to use for the form field errors
     *
     * @return string
     */
    public function m62FormErrors($errors)
    {
        $return = '';
        if( is_array($errors) && count($errors) >= 1)
        {
            $return = '<em>';
            foreach($errors AS $error)
            {
                $return .= $this->m62Escape($error).'<br />';
            }
            $return .= '</em>';
        }
        
        return $return;
    }    
}