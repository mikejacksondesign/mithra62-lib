<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Remote/LocalTest.php
 */
namespace mithra62\tests\Remote;

use mithra62\tests\TestFixture;
use mithra62\Remote\Local;

/**
 * mithra62 - Local Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Local object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class LocalTest extends TestFixture
{

    public function testInstance()
    {
        $local = new Local(dirname(__FILE__));
        $this->assertInstanceOf('\League\Flysystem\AdapterInterface', $local);
    }
}