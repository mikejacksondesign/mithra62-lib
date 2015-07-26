<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/ErrorsTest.php
 */
 
namespace mithra62\tests\Traits;

use mithra62\Traits\Log;
use mithra62\tests\TestFixture;

/**
 * Mock for testing the Log Trait
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class _logger
{
    use Log;        
}

/**
 * mithra62 - Log Trait Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Trait\Log Trait
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class LogsTest extends TestFixture
{
    /**
     * Test for the Monolog dependancy
     */
    public function testLoggerInstance()
    {
        $logger = new _logger();
        $this->assertInstanceOf('\\Monolog\\Logger', $logger->getLogger('test'));
    }
}