<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/ErrorsTest.php
 */
 
namespace mithra62\tests;

use mithra62\tests\TestFixture;
use mithra62\Errors;
use mithra62\License;

/**
 * mithra62 - Errors object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Errors object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class ErrorsTest extends TestFixture
{
    /**
     * Ensures we start with a blank slate 
     * @covers \\mithra62\\Errors::getErrors()
     */
    public function testErrorsInit()
    {
        $error = new Errors();
        $this->assertClassHasAttribute('settings', '\\mithra62\\Errors');
        $this->assertClassHasAttribute('errors', '\\mithra62\\Errors');
        $this->assertClassHasAttribute('validation', '\\mithra62\\Errors');

        $this->assertObjectHasAttribute('settings', $error);
        $this->assertObjectHasAttribute('errors', $error);
        $this->assertObjectHasAttribute('validation', $error);
        
        //we shouldn't have anything by default
        $this->assertNull($error->getValidation());
        
        //nothing but empty arrays here 
        $this->assertEmpty($error->getErrors());
        $this->assertEmpty($error->getSettings());
    }
    
    /**
     * Verifies we can apply settings and get accurate returns
     */
    public function testSetErrors()
    {
        $error = new Errors();
        $this->assertCount(0, $error->getErrors());
        $error->setError('test_error', 'MessageHere');
        $this->assertCount(1, $error->getErrors());

        $error->setError('test_error2', 'MessageHere2');
        $error->setError('test_error3', 'MessageHere3');
        $error->setError('test_error4', 'MessageHere4');
        $error->setError('test_error5', 'MessageHere5');
        $error->setError('test_error6', 'MessageHere6');
        
        $this->assertCount(6, $error->getErrors());
        $this->assertSame(count($error->getErrors()), $error->totalErrors());
        
        $errors = $error->getErrors();
        $this->assertEquals('MessageHere3', $errors['test_error3']);
    }
    
    /**
     * @covers \mithra62\Errors
     * @uses \mithra62\Errors
     */
    public function testClearErrrors()
    {
        $error = new Errors();
        $this->assertCount(0, $error->getErrors());
        $error->setError('test_error', 'MessageHere');
        $error->setError('test_error2', 'MessageHere2');
        $error->setError('test_error3', 'MessageHere3');
        $error->setError('test_error4', 'MessageHere4');
        $error->setError('test_error5', 'MessageHere5');
        $error->setError('test_error6', 'MessageHere6');
        
        $this->assertCount(6, $error->getErrors());
        $error->clearErrors();
        $this->assertCount(0, $error->getErrors());
    }
    
    public function testLicenseValidationFailure()
    {
        $error = new Errors();
        
        //invalid license
        $check = $error->licenseCheck('fdsafdsa', new License);
        $errors = $error->getErrors();
        $this->assertArrayHasKey('license_number', $errors);
        $this->assertEquals($errors['license_number'], 'invalid_license_number');
        
        //missing license
        $error = new Errors();
        $check = $error->licenseCheck('', new License);
        $errors = $error->getErrors();
        $this->assertArrayHasKey('license_number', $errors);
        $this->assertEquals($errors['license_number'], 'missing_license_number');

        //settings say no
        $error = new Errors();
        $check = $error->setSettings(array('license_status' => '0'))->licenseCheck('88888888-8888-8888-8888-888888888888', new License);
        $errors = $error->getErrors();
        $this->assertEquals($errors['license_number'], 'invalid_license_number');
        //$this->assertEquals($errors['license_number'], 'missing_license_number');
    }
    
    public function testLicenseValidationSuccess()
    {
        $error = new Errors();
        $check = $error->setSettings(array('license_status' => '1'))->licenseCheck('88888888-8888-8888-8888-888888888888', new License);
        $this->assertCount(0, $error->getErrors());
    }
}