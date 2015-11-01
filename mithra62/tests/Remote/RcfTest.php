<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Remote/RcfTest.php
 */
 
namespace mithra62\tests\Remote;

use mithra62\tests\TestFixture;
use mithra62\Remote\Rcf;

/**
 * mithra62 - Rcf Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Rcf object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class RcfTest extends TestFixture
{
    public function testServiceInstance()
    {
        $rcf = Rcf::getRemoteClient($this->getRcfCreds(), false);
        $this->assertInstanceOf('OpenCloud\ObjectStore\Service', $rcf);   
    }
    
    public function testContainerInstance()
    {
        $rcf = Rcf::getRemoteClient($this->getRcfCreds());
        $this->assertInstanceOf('OpenCloud\ObjectStore\Resource\Container', $rcf);   
    }
}