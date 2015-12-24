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
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class FilesTest extends TestFixture
{

    protected $test_content = 'Test Content';

    public function testInit()
    {
        $this->assertClassHasAttribute('file_data', 'mithra62\\Files');
    }

    public function testWrite()
    {
        $test_file = $this->getWorkingDir() . 'test_file.txt';
        $file = new Files();
        
        $this->assertFileNotExists($test_file);
        
        $file->write($test_file, $this->test_content, 'a+');
        $this->assertFileExists($test_file);
        
        return $test_file;
    }

    /**
     * @depends testWrite
     */
    public function testRead($test_file)
    {
        $file = new Files();
        $this->assertEquals($this->test_content, $file->read($test_file));
        return $test_file;
    }

    /**
     * @depends testWrite
     */
    public function testDelete($test_file)
    {
        $file = new Files();
        $file->delete($test_file);
        $this->assertFileNotExists($test_file);
        
        return $test_file;
    }

    public function testCopyDir()
    {
        $file = new Files();
        $path = $this->dataPath() . DIRECTORY_SEPARATOR . 'languages';
        $destination = $this->dataPath() . DIRECTORY_SEPARATOR . 'file_test';
        $file->copyDir($path, $destination);
        $this->assertFileExists($destination);
        return $destination;
    }

    /**
     * @depends testCopyDir
     */
    public function testGetFilenames($destination)
    {
        $file = new Files();
        $file_data = $file->getFilenames($destination);
        
        return $destination;
    }

    /**
     * @depends testGetFilenames
     */
    public function testRemoveDir($destination)
    {
        $file = new Files();
        $file_data = $file->deleteDir($destination, true);
        
        $this->assertFileNotExists($destination);
        return $destination;
    }

    /**
     * Tests the various states of the $file->file_data container
     */
    public function testFileData()
    {
        // check defaults
        $file = new Files();
        $this->assertEmpty($file->getFileData());
        
        // check adding works
        $file_data = array(
            'Foo',
            'Bar'
        );
        foreach ($file_data as $data) {
            $file->setFileData($data);
        }
        
        $this->assertNotEmpty($file->getFileData());
        $this->assertContains('Foo', $file->getFileData());
        $this->assertContains('Bar', $file->getFileData());
        $this->assertCount(2, $file->getFileData());
        
        // check breakdown
        $file->setFileData(false, true);
        $this->assertEmpty($file->getFileData());
    }

    public function testFilesizeFormat()
    {
        $number = 555555;
        $file = new Files();
        
        $this->assertEquals('543 KiB', $file->filesizeFormat($number));
        $this->assertEquals('556 kB', $file->filesizeFormat($number, 3, 'SI'));
        $this->assertEquals('4.24 Mib', $file->filesizeFormat($number, 3, 'IEC', 'b'));
        $this->assertEquals('0 B', $file->filesizeFormat(false));
    }
}