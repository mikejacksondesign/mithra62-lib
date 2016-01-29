<?php
/**
 * mithra62 - Backup Pro
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/BackupPro/Platforms/View/Eecms.php
 */
namespace mithra62\Platforms\View;

use mithra62\Traits\View\Helpers As ViewHelpers;

/**
 * Backup Pro - Eecms View Object
 *
 * Contains the view helpers for ExpressionEngine
 *
 * @package BackupPro\View
 * @author Eric Lamb <eric@mithra62.com>
 */
abstract class AbstractView implements ViewInterface
{
    use ViewHelpers;
}