<?php
/**
 * mithra62 - Backup Pro
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/BackupPro/Platforms/View/Smarty.php
 */
namespace mithra62\Platforms\View;

/**
 * Backup Pro - Smarty View Object
 *
 * Contains the view helpers for Smarty based systems
 *
 * @package BackupPro\View
 * @author Eric Lamb <eric@mithra62.com>
 */
class Smarty extends AbstractView
{

    /**
     * Returns a string to use for the form field errors
     * 
     * @return string
     */
    public function m62FormErrors($errors)
    {
        if (is_string($errors) && $errors != '') {
            // $errors = array($errors);
        }
        
        $return = '';
        if (is_array($errors) && count($errors) >= 1) {
            $return = '<ul style="padding-top:5px; color:red;">';
            foreach ($errors as $error) {
                $return .= '<li class="notice">' . $error . '</li>';
            }
            $return .= '</ul>';
        }
        
        echo $return;
    }
}