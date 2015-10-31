<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Validate/Rules/Rcf/ExistsTest.php
 */
 
namespace mithra62\tests\Validate\Rules\Rcf\Buckets;

use mithra62\tests\TestFixture;
use mithra62\Validate;
use mithra62\Validate\Rules\Rcf\Containers\Readable;

/**
 * mithra62 - Valiate object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Valiate object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class ReadableTest extends TestFixture
{
    /**
     * Tests the name of the rule
     */
    public function testName()
    {
        $dir = new Readable; 
        $this->assertEquals($dir->getName(), 'rcf_bucket_readable');
    }
    
    /**
     * Tests that a file can be determined false
     */
    public function testRuleFail()
    {
        return;
        $val = new Validate();
        $creds = $this->getS3Creds();
        $creds['s3_bucket'] = 'ffdsafdsafdsafd';
        $val->rule('s3_bucket_readable', 'connection_field', $creds)->val(array('connection_field' => __FILE__));
        $this->assertTrue($val->hasErrors());
    }
    
    /**
     * Tests that a directory can be determined true
     */
    public function testRuleSuccess()
    {
        return;
        $val = new Validate();
        $val->rule('s3_bucket_readable', 'connection_field', $this->getS3Creds())->val(array('connection_field' => 'Foo'));
        $this->assertFALSE($val->hasErrors());
    }
}