<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Validate/Rules/Rcf/ConnectTest.php
 */
namespace mithra62\tests\Validate\Rules\Rcf;

use mithra62\tests\TestFixture;
use mithra62\Validate;
use mithra62\Validate\Rules\Rcf\Connect;

/**
 * mithra62 - Valiate object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Valiate object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class ConnectTest extends TestFixture
{

    /**
     * Tests the name of the rule
     */
    public function testName()
    {
        $dir = new Connect();
        $this->assertEquals($dir->getName(), 'rcf_connect');
    }

    /**
     * Tests that a file can be determined false
     */
    public function testRuleFail()
    {
        return;
        $val = new Validate();
        $creds = $this->getRcfCreds();
        $creds['gcs_access_key'] = 'fdsa';
        $val->rule('gcs_connect', 'connection_field', $creds)->val(array(
            'connection_field' => __FILE__
        ));
        $this->assertTrue($val->hasErrors());
    }

    /**
     * Tests that a directory can be determined true
     */
    public function testRuleSuccess()
    {
        return;
        $val = new Validate();
        $val->rule('rcf_connect', 'connection_field', $this->getRcfCreds())
            ->val(array(
            'connection_field' => 'Foo'
        ));
        $this->assertFALSE($val->hasErrors());
    }
}