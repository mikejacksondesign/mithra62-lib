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
    public function testInit()
    {
        $this->assertClassHasAttribute('file_data', 'mithra62\\Files');
    }
    
    public function testWrite()
    {
        $test_file = $this->getWorkingDir().'test_file.txt';
        $file = new Files;
        
        $this->assertFileNotExists($test_file);
        
        $file->write($test_file, 'Test Content', 'a+');
        $this->assertFileExists($test_file);
        
        return $test_file;
    }
    
    /**
     * @depends testWrite
     */
    public function testDelete($test_file)
    {
        $file = new Files;
        $file->delete($test_file);
        $this->assertFileNotExists($test_file);
        
        return $test_file;
    }
    
    /**
     * Tests the various states of the $file->file_data container
     */
    public function testFileData()
    {
        //check defaults
        $file = new Files;
        $this->assertEmpty($file->getFileData());
        
        //check adding works
        $file_data = array('Foo', 'Bar');
        foreach($file_data AS $data)
        {
            $file->setFileData($data);
        }
        
        $this->assertNotEmpty($file->getFileData());
        $this->assertContains('Foo', $file->getFileData());
        $this->assertContains('Bar', $file->getFileData());
        $this->assertCount( 2, $file->getFileData() );
        
        //check breakdown
        $file->setFileData(false, true);
        $this->assertEmpty($file->getFileData());
    }
}