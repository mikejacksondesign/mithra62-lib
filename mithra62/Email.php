<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Email.php
 */
 
namespace mithra62;

use Swift_SmtpTransport;
use Swift_MailTransport;
use Swift_Message;
use Swift_Attachment;
use Swift_mailer;
use mithra62\Exceptions\EmailException;

/**
 * mithra62 - Email Object
 *
 * Wrapper to send email
 *
 * @package 	Email
 * @author		Eric Lamb <eric@mithra62.com>
 */
class Email 
{
    /**
     * The email addresses we're sending to
     * @var array
     */
    protected $to = array();
    
    /**
     * The email subect language key
     * @var string
     */
    protected $subject = false;
    
    /**
     * The email message language key
     * @var string
     */
    protected $message = false;
    
    /**
     * What type of email to send (html or text)
     * @var string
     */
    protected $mailtype = 'html';
    
    /**
     * The mailtype values we allow
     * @var array
     */
    protected $allowed_mailtypes = array('html', 'txt');
    
    /**
     * The View object
     * @var \mithra62\View
     */
    protected $view = null;
    
    /**
     * The Language object
     * @var \mithra62\Language
     */
    protected $lang = null;
    
    /**
     * The mailer object
     * @var PHPMailer
     */
    protected $mailer = null;
    
    /**
     * The email configuration
     * @var array
     */
    protected $config = array();
    
    /**
     * The view options
     * @var array
     */
    protected $view_options= array();
    
    /**
     * The tmeplate to use for view output
     * @var string
     */
    protected $view_template = '';
    
    /**
     * An array of files to add as attachments to emails
     * @var array A key => value pair of file path => new name 
     */
    protected $attachemnts = array();
    
    /**
     * The format the configuration is expected in
     * @var array
     */
    private $config_prototype = array(
        'type' => 'smtp', //choose between `php` and `smtp`
        'smtp_options' => array( //if `smtp` chosen above, this must be completed and accurate
            'host' => '',
            'connection_config' => array(
                'username' => '',
                'password' => '',
            ),
            'port' => '',
        )
    );
    
    /**
     * Sets the Language object
     * @param \mithra62\Language $lang
     * @return \mithra62\Email
     */
    public function setLang(\mithra62\Language $lang)
    {
        $this->lang = $lang;
        return $this;
    }    
    
    /**
     * Returns an instance of the Language object
     * @return \mithra62\Language
     */
    public function getLang()
    {
        return $this->lang;
    }
    
    /**
     * Sets the View object
     * @param \mithra62\View $view
     * @return \mithra62\Email
     */
    public function setView(\mithra62\View $view)
    {
        $this->view = $view;
        return $this;
    }
    
    /**
     * Returns an instance of the View object
     * @return \mithra62\View
     */
    public function getView()
    {
        return $this->view;
    }
    
    /**
     * Sets the email config
     * @param array $config
     * @return \mithra62\Email
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        return $this;
    }
    
    /**
     * Compiles the options to use for the view
     * @param string $template
     * @param array $view_data
     * @return \mithra62\Email
     */
    public function setViewOptions($template, array $view_data = array())
    {
        $this->view_options = $view_data;
        $this->view_template = $template;
        return $this;
    }
    
    /**
     * Sets the TO email address
     * 
     * Note that this method resets any previously added email addresses
     * @param string $to
     * @return \mithra62\Email
     */
    public function setTo($to)
    {
        $this->to = ( is_array($to) ? $to : array($to) );
        return $this;
    }
    
    /**
     * Sets the email addresses to send to
     * @param string $to The Email address to send to
     * @return \mithra62\Email
     */
    public function addTo($to)
    {
        $this->to[] = $to;
        return $this;
    }
    
    /**
     * Adds an attachment to an email
     * @param string $file The full path to the attachment
     * @param string $name An alternative name to use for the attachment file
     */
    public function addAttachment($file, $name = false)
    {
        if( file_exists($file) )
        {
            $this->attachemnts[] = array($file => $name);
        }
        
        return $this;
    }
    
    /**
     * Returns an array of attachments
     * @return string
     */
    public function getAttachments()
    {
        return $this->attachemnts;
    }
    
    /**
     * Returns the email addresses to send to
     */
    public function getTo()
    {
        return $this->to;
    }
    
    /**
     * Sets the email subject language key
     * @param string $subject The language key for the email subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
    
    /**
     * Returns the email addresses to send to
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Returns the message language key
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Set the email message language key
     * @param string $message Should be a language file key 
     * @return \mithra62\Email
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
    
    /**
     * Returns the mailtype
     * @return string
     */
    public function getMailtype()
    {
        return $this->mailtype;
    }
    
    /**
     * Sets the mailtype
     * @param string $mailtype
     * @return \mithra62\Email
     */
    public function setMailtype($mailtype)
    {
        $this->mailtype = $mailtype;
        return $this;
    }
    
    /**
     * Returns an instance of the mail object
     * @return PHPMailer
     */
    public function getMailer()
    {
        if( is_null($this->mailer) )
        {
            if( $this->config['type'] == 'smtp' )
            {
                $transport = Swift_SmtpTransport::newInstance($this->config['smtp_options']['host'], $this->config['smtp_options']['port']);
                $transport->setUsername($this->config['smtp_options']['connection_config']['username']);
                $transport->setPassword($this->config['smtp_options']['connection_config']['password']);
            }
            else
            {
                $transport = Swift_MailTransport::newInstance();
            }
                
            $this->mailer = Swift_Mailer::newInstance($transport);
        }
        
        return $this->mailer;
    }

    /**
     * Resets the email object
     * @return \mithra62\Email
     */
    public function clear()
    {
        $this->to = $this->attachemnts = array();
        $this->subject = $this->message = false;
        return $this;
    }
    
    /**
     * Sends the email
     * @param array $vars
     * @throws \InvalidArgumentException
     * @throws EmailException
     */
    public function send(array $vars = array())
    {
        if( count($this->getTo()) == 0 )
        {
            throw new \InvalidArgumentException('__exception_missing_email');
        }
        
        if( $this->getSubject() == '' )
        {
            throw new \InvalidArgumentException('__exception_missing_subject');
        }
        
        if( $this->getMessage() == '' )
        {
            throw new \InvalidArgumentException('__exception_missing_message');
        }
        
        $valid_emails = array();
        foreach( $this->getTo() AS $to )
        {
            if( filter_var($to, FILTER_VALIDATE_EMAIL) )
            {
                $valid_emails = $to;
            }
        }
        
        if(!$valid_emails)
        {
            return;
        }
        
        $message = Swift_Message::newInstance();
        $message->setTo($valid_emails);
        if( $this->getAttachments() )
        {
            foreach($this->getAttachments() AS $attachment)
            {
                foreach($attachment AS $file => $alt_name)
                {
                    if( $alt_name == '')
                    {
                        $this->getMailer()->addAttachment($file);
                    }
                    else
                    {
                        $this->getMailer()->addAttachment($file, $alt_name);
                    }
                }
            }
        }
        
        $message->setFrom( $this->config['from_email'], $this->config['sender_name'] );
        $message->setSubject( $this->getView()->render($this->getSubject(), $vars) );
        if( $this->getMailtype() == 'html' )
        {
            $message->setBody( $this->getView()->render($this->getMessage(), $vars), 'text/html' );
        }
        else
        {
            $message->setBody( $this->getView()->render($this->getMessage(), $vars) );
        }
        
        if( !$this->getMailer()->send($message) )
        {
            throw new EmailException($this->getMailer()->ErrorInfo);
        }
    }
}