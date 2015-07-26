<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/FilesTest.php
 */
 
namespace mithra62\tests;

use mithra62\tests\TestFixture;
use mithra62\Files;

/**
 * mithra62 - Files object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Files object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class FilesTest extends TestFixture
{
    public function testWriteDelete()
    {
        $test_file = $this->getWorkingDir().'test_file.txt';
        $file = new Files;
        
        $this->assertFileNotExists($test_file);
        
        $file->write($test_file, 'Test Content', 'a+');
        $this->assertFileExists($test_file);
        
        $file->delete($test_file);
        $this->assertFileNotExists($test_file);
    }
}