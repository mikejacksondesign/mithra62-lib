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
    /**
     * The name of the test database table
     * @var string 
     */
    protected $test_table_name = 'm62_test_table';
    
    /**
     * The full path to the working directory any file system activity happens
     * @return string
     */
    protected function getWorkingDir()
    {
        return rtrim(realpath(dirname(__FILE__).'/working_dir'), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
    }
    
    /**
     * The full path to the data directory 
     * @return string
     */
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
    
    /**
     * The Amazon S3 Test Credentials
     * @return array
     */
    protected function getS3Creds()
    {
        return include 'data/s3creds.config.php';
    }
    
    /**
     * The FTP Test Credentials
     * @return array
     */
    protected function getFtpCreds()
    {
        return include 'data/ftpcreds.config.php';
    }
    
    protected function getGcsCreds()
    {
        return include 'data/gcscreds.config.php';
    }
    
    /**
     * The Databaes Test Credentiasl
     * @return array
     */
    protected function getDbCreds()
    {
        return include 'data/db.config.php';
    }
    
    /**
     * The SQL string to create the test table
     * @return string
     */
    protected function getSettingsTableCreateSql()
    {
        return include 'data/db.sql.php';
    }
}