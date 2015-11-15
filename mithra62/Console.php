<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/Console.php
 */
 
namespace mithra62;

use Commando\Command;

/**
 * mithra62 - Console Object
 *
 * Abstracts our Console interface 
 *
 * @package 	Platforms\Console
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Console extends Command
{
    /**
     * The cli input string
     * @param string $tokens
     */
    public function __construct($tokens = null)
    {
        parent::__construct($tokens);
    }
}