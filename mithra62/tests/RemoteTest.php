<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Remote.php
 */
 
namespace mithra62\tests\Traits;

use League\Flysystem\Adapter\NullAdapter as Adapter;
use mithra62\tests\TestFixture;
use mithra62\Remote;

/**
 * mithra62 - Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class RemoteTest extends TestFixture
{
    public function testInstance()
    {
        $remote = new Remote( new Adapter );
        $this->assertInstanceOf('\League\Flysystem\FilesystemInterface', $remote);
    }
}