<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/Traits/EncodingTest.php
 */
namespace mithra62\tests\Traits;

use mithra62\Traits\Encoding;
use mithra62\tests\TestFixture;

/**
 * Mock for testing the Encoding Trait
 * 
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class _encoding
{
    use Encoding;
}

/**
 * mithra62 - Encoding Trait Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Trait\Encoding Trait
 *
 * @package mithra62\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class EncodingTest extends TestFixture
{

    public function testToUtf8()
    {
        $encoding = new _encoding();
        $this->assertEquals($encoding->toUtf8('FÃÂ©dération Camerounaise de Football'), 'Fédération Camerounaise de Football');
        $this->assertEquals($encoding->toUtf8('FÃ©dÃ©ration Camerounaise de Football'), 'Fédération Camerounaise de Football');
        $this->assertEquals($encoding->toUtf8('FÃÂ©dÃÂ©ration Camerounaise de Football'), 'Fédération Camerounaise de Football');
        $this->assertEquals($encoding->toUtf8('FÃÂÂÂÂ©dÃÂÂÂÂ©ration Camerounaise de Football'), 'Fédération Camerounaise de Football');
    }
}