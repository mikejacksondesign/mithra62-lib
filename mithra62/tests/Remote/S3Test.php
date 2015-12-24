<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Remote/S3Test.php
 */
namespace mithra62\tests\Remote;

use mithra62\tests\TestFixture;
use mithra62\Remote\S3;

/**
 * mithra62 - S3 Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Rcf object
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class S3Test extends TestFixture
{

    public function testServiceInstance()
    {
        $creds = $this->getS3Creds();
        $s3 = S3::getRemoteClient($creds['s3_access_key'], $creds['s3_secret_key']);
        $this->assertInstanceOf('Aws\S3\S3Client', $s3);
    }
}