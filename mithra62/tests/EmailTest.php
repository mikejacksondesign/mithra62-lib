<?php
/**
 * mithra62 - Unit Test
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/tests/EmailTest.php
 */
 
namespace mithra62\tests;

use mithra62\tests\TestFixture;
use mithra62\Email;

/**
 * mithra62 - Email object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Email object
 *
 * @package 	mithra62\Tests
 * @author		Eric Lamb <eric@mithra62.com>
 */
class EmailTest extends TestFixture
{
    protected $subject_string = 'Test Subect';
    protected $test_message = 'Test Message';
    
    public function testInit()
    {
        $this->assertClassHasAttribute('to', 'mithra62\\Email');
        $this->assertClassHasAttribute('subject', 'mithra62\\Email');
        $this->assertClassHasAttribute('message', 'mithra62\\Email');
        $this->assertClassHasAttribute('mailtype', 'mithra62\\Email');
        $this->assertClassHasAttribute('view', 'mithra62\\Email');
        $this->assertClassHasAttribute('mailer', 'mithra62\\Email');
        $this->assertClassHasAttribute('lang', 'mithra62\\Email');
        $this->assertClassHasAttribute('config', 'mithra62\\Email');
        $this->assertClassHasAttribute('view_options', 'mithra62\\Email');
        $this->assertClassHasAttribute('view_template', 'mithra62\\Email');
        $this->assertClassHasAttribute('attachemnts', 'mithra62\\Email');
        $this->assertClassHasAttribute('config_prototype', 'mithra62\\Email');
        
        $email = new Email;
        $this->assertObjectHasAttribute('to', $email);
        $this->assertObjectHasAttribute('subject', $email);
        $this->assertObjectHasAttribute('message', $email);
        $this->assertObjectHasAttribute('mailtype', $email);
        $this->assertObjectHasAttribute('view', $email);
        $this->assertObjectHasAttribute('mailer', $email);
        $this->assertObjectHasAttribute('lang', $email);
        $this->assertObjectHasAttribute('config', $email);
        $this->assertObjectHasAttribute('view_options', $email);
        $this->assertObjectHasAttribute('view_template', $email);
        $this->assertObjectHasAttribute('attachemnts', $email);
        $this->assertObjectHasAttribute('config_prototype', $email);
        
        $this->assertNull( $email->getView() );
        $this->assertNull( $email->getLang() );
        $this->assertNull( $email->getView() );
        
        $this->assertFalse( $email->getSubject() );
        $this->assertFalse( $email->getMessage() );
        
        $this->assertTrue( is_array( $email->getTo() ) );
        
        $this->assertInstanceOf('Swift_Mailer', $email->getMailer());
    }
    
    public function testSetSubject()
    {
        $email = new Email;
        $this->assertFalse( $email->getSubject() );
        $this->assertInstanceOf('mithra62\\Email', $email->setSubject($this->subject_string));
        $this->assertEquals($this->subject_string, $email->getSubject());
    }
    
    public function testSetMessage()
    {
        $email = new Email;
        $this->assertFalse( $email->getMessage() );
        $this->assertInstanceOf('mithra62\\Email', $email->setMessage($this->test_message));
        $this->assertEquals($this->test_message, $email->getMessage());
    }
    
    public function testSetTo()
    {
        $email = new Email;
        $to = array('eric@ericlamb.net', 'eric@mithra62.com');
        $this->assertInstanceOf('mithra62\\Email', $email->setTo($to));
        $this->assertCount( 2, $email->getTo() );

        //make sure we reset the container on each use
        $email->setTo(array('eric@ericlamb.net'));
        $this->assertCount( 1, $email->getTo() );
        
    }
    
    public function testAddTo()
    {
        $email = new Email;
        $this->assertInstanceOf('mithra62\\Email', $email->addTo('eric@ericlamb.net'));
        $this->assertCount( 1, $email->getTo() );

        //make sure we reset the container on each use
        $email->addTo('eric@ericlamb.net');
        $this->assertCount( 2, $email->getTo() );
    }
    
    public function testAttachment()
    {
        $email = new Email;
        $this->assertCount( 0, $email->getAttachments() );
        
        //add a new attachment
        $this->assertInstanceOf('mithra62\\Email', $email->addAttachment(__FILE__));
        $this->assertCount(1,  $email->getAttachments() );

        $email->addAttachment(__FILE__);
        $email->addAttachment(__FILE__);
        $this->assertCount(3,  $email->getAttachments() );
    }
    
    public function testClear()
    {
        $email = new Email;
        $email->setTo(array('eric@ericlamb.net'))->setSubject($this->subject_string)->setMessage($this->test_message)->clear();
        $this->assertFalse( $email->getMessage() );
        $this->assertFalse( $email->getSubject() );
        $this->assertCount( 0, $email->getTo() );
        
    }
}