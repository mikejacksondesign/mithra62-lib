<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Remote/GcsTest.php
 */
 
namespace mithra62\tests\Remote;

use mithra62\tests\TestFixture;
use mithra62\Remote\Gcs;

/**
 * mithra62 - Gcs Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Gcs object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class GcsTest extends TestFixture
{
    private function getGcsInstance()
    {
        $settings = $this->getGcsCreds();
        $gcs = new Gcs( Gcs::getRemoteClient($settings['gcs_access_key'], $settings['gcs_secret_key']), $settings['gcs_bucket'] );
        return $gcs;
    }
    
    public function testInstance()
    {
        $gcs = $this->getGcsInstance();
        $this->assertInstanceOf('\League\Flysystem\AdapterInterface', $gcs);
        
    }
    
    public function testGetRemoteClient()
    {
        $settings = $this->getGcsCreds();
        $this->assertInstanceOf('\Aws\S3\S3Client', Gcs::getRemoteClient($settings['gcs_access_key'], $settings['gcs_secret_key']));
    }
}