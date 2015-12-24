<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/ErrorsTest.php
 */
namespace mithra62\tests\Traits\MySQL;

use mithra62\Traits\MySQL\Mycnf;
use mithra62\tests\TestFixture;

/**
 * Mock for testing the Mycnf Trait
 * 
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class _my
{
    use Mycnf;

    public function checkCreateMyCnf(array $data, $path)
    {
        return $this->createMyCnf($data, $path);
    }

    public function checkRemoveMyCnf($path)
    {
        return $this->removeMyCnf($path);
    }
}

/**
 * mithra62 - Log Trait Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Trait\Log Trait
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class MycnfTest extends TestFixture
{

    protected $test_cnf_data = array(
        'user' => 'test',
        'password' => 'test',
        'host' => 'test'
    );

    public function testCreateMyCnf()
    {
        $my = new _my();
        $path = $this->dataPath();
        $cnf_file = $my->checkCreateMyCnf($this->test_cnf_data, $path);
        $this->assertTrue(file_exists($cnf_file));
        
        return $path;
    }

    /**
     * @depends testCreateMyCnf
     */
    public function testRemoveMyCnf($path)
    {
        $my = new _my();
        $this->assertTrue($my->checkRemoveMyCnf($path));
    }
}