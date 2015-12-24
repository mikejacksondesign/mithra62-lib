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
 * 
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
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
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
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

    public function testGetPathToLogFile()
    {
        $logger = new _logger();
        $path = $logger->getPathToLogFile('m62.ui');
        $this->assertEquals(substr($path, - 10), 'm62.ui.log');
    }

    public function testLogEmergency()
    {
        $logger = new _logger();
        $logger->setPathToLogFile($this->getPathToLogFile())
            ->removeLogFile()
            ->logEmergency('test emergency error message');
        $this->assertTrue(file_exists($this->getPathToLogFile()));
        
        $data = file_get_contents($logger->getPathToLogFile());
        $this->assertTrue(strpos($data, 'test emergency error message') !== FALSE);
        $logger->removeLogFile();
    }

    public function testLogDebug()
    {
        $logger = new _logger();
        $logger->setPathToLogFile($this->getPathToLogFile())
            ->removeLogFile()
            ->logDebug('test debug error message');
        $this->assertTrue(file_exists($this->getPathToLogFile()));
        
        $data = file_get_contents($logger->getPathToLogFile());
        $this->assertTrue(strpos($data, 'test debug error message') !== FALSE);
        $logger->removeLogFile();
    }

    public function testLogWarning()
    {
        $logger = new _logger();
        $logger->setPathToLogFile($this->getPathToLogFile())
            ->removeLogFile()
            ->logWarning('test warning error message');
        $this->assertTrue(file_exists($this->getPathToLogFile()));
        
        $data = file_get_contents($logger->getPathToLogFile());
        $this->assertTrue(strpos($data, 'test warning error message') !== FALSE);
        $logger->removeLogFile();
    }

    public function testLogError()
    {
        $logger = new _logger();
        $logger->setPathToLogFile($this->getPathToLogFile())
            ->removeLogFile()
            ->logError('test error error message');
        $this->assertTrue(file_exists($this->getPathToLogFile()));
        
        $data = file_get_contents($logger->getPathToLogFile());
        $this->assertTrue(strpos($data, 'test error error message') !== FALSE);
        $logger->removeLogFile();
    }
}