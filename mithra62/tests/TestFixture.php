<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/TestFixture.php
 */
 
namespace mithra62\tests;

/**
 * mithra62 - Unit Test Fixture
 *
 * Contains various methods for easing unit testing pains
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class TestFixture extends \PHPUnit_Framework_TestCase
{
    protected function getWorkingDir()
    {
        return rtrim(realpath(dirname(__FILE__).'/working_dir'), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
    }
    
    protected function dataPath()
    {
        return realpath(dirname(__FILE__).'/data');
    }
    
    /**
     * Just returns the path to the testing language1 directory
     * @return string
     */
    protected function lang1Path()
    {
        return realpath(dirname(__FILE__).'/data/languages/language1');
    }
    
    /**
     * Just returns the path to the testing language2 directory
     * @return string
     */
    protected function lang2Path()
    {
        return realpath(dirname(__FILE__).'/data/languages/language2');
    }    
    
    /**
     * Just returns the path to the testing language3 directory
     * @return string
     */
    protected function lang3Path()
    {
        return realpath(dirname(__FILE__).'/data/languages/language3');
    }   
    
    protected function getS3Creds()
    {
        return include 'data/s3creds.config.php';
    }
}