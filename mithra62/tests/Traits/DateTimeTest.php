<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Traits/DateTimeTest.php
 */
 
namespace mithra62\tests\Traits;

use mithra62\Traits\DateTime AS m62DateTime;
use mithra62\tests\TestFixture;
use \DateTime;
use \DateTimeZone;

/**
 * Mock for testing the DateTime Trait
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class _dt
{
    use m62DateTime;        
}

/**
 * mithra62 - DateTime Trait Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Trait\Encoding Trait
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class DateTimeTest extends TestFixture
{

    public function testInstance()
    {
        $dt = new _dt();
        $this->assertInstanceOf('Carbon\Carbon', $dt->getDt());
    }
    
    public function testDefaultTzValue()
    {
        //echo date_default_timezone_get();
        $dt = new _dt();
        $this->assertEquals('UTC', $dt->getTz());
    }
    
    public function testChangeTzValue()
    {
        //echo ;
        
        $dateTime = new DateTime();
        $dateTime->setTimeZone(new DateTimeZone(date_default_timezone_get()));

        $dt = new _dt();
        $dt->setTz($dateTime->format('T'));
        
        $this->assertEquals($dateTime->format('T'), $dt->getTz());
    }
    
    
    
}