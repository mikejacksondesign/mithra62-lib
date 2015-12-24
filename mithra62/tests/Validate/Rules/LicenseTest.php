<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Validate/Rules/LicenseTest.php
 */
namespace mithra62\tests\Validate\Rules;

use mithra62\tests\TestFixture;
use mithra62\Validate;
use mithra62\Validate\Rules\License;

/**
 * mithra62 - Valiate object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Valiate object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class LicenseTest extends TestFixture
{

    /**
     * Tests the name of the rule
     */
    public function testName()
    {
        $dir = new License();
        $this->assertEquals($dir->getName(), 'license_key');
    }

    /**
     * Tests that a license key can be determined false
     */
    public function testRuleFail()
    {
        $val = new Validate();
        $val->rule('license_key', 'license_key_input')->val(array(
            'license_key_input' => '4435432'
        ));
        $this->assertTrue($val->hasErrors());
        
        $val = new Validate();
        $val->rule('license_key', 'license_key_input')->val(array(
            'license_key_input' => '55555555-ffff-5555-5555-55555555555'
        ));
        $this->assertTrue($val->hasErrors());
    }

    /**
     * Tests that a license key can be determined true
     */
    public function testRuleSuccess()
    {
        $val = new Validate();
        $val->rule('license_key', 'license_key_input')->val(array(
            'license_key_input' => '55555555-5555-5555-5555-555555555555'
        ));
        $this->assertFALSE($val->hasErrors());
        
        $val = new Validate();
        $val->rule('license_key', 'license_key_input')->val(array(
            'license_key_input' => '55555555-ffff-5555-5555-555555555555'
        ));
        $this->assertFALSE($val->hasErrors());
        
        $val = new Validate();
        $val->rule('license_key', 'license_key_input')->val(array(
            'license_key_input' => 'ffffffff-ffff-ffff-ffff-ffffffffffff'
        ));
        $this->assertFALSE($val->hasErrors());
    }
}