<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Remote/Local.php
 */
namespace mithra62\Remote;

use League\Flysystem\Adapter\Local as Adapter;

/**
 * mithra62 - Local File System Transfer Abstraction
 *
 * Simple intermediary between Flysystem and mithra62
 *
 * @package Remote
 * @author Eric Lamb <eric@mithra62.com>
 */
class Local extends Adapter
{
}