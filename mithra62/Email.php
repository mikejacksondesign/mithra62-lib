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

use PHPMailer;
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
     * @param \mithra62\Language $mail
     * @return \mithra62\Email
     */
    public function setLang(\mithra62\Language $lang)
    {
        $this->lang = $lang;
        return $this;
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
        $this->attachemnts[] = array($file => $name);
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
    
    public function getMailer()
    {
        if( is_null($this->mailer) )
        {
            $this->mailer = new PHPMailer;
        }
        
        return $this->mailer;
    }

    /**
     * Resets the email object
     * @return \mithra62\Email
     */
    public function clear()
    {
        $this->to = array();
        $this->subject = false;
        $this->message = false;
        return $this;
    }
    
    /**
     * Sends the email
     */
    public function send()
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
        
        foreach( $this->getTo() AS $to )
        {
            $this->getMailer()->addAddress($to);
        }
        
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
        
        $this->getMailer()->From = $this->config['from_email'];
        $this->getMailer()->FromName = $this->config['sender_name'];
        $this->getMailer()->Subject = $this->getSubject();
        $this->getMailer()->Body = ($this->view_template != '' ? $this->getView()->fetch($this->view_template, $this->view_options) : $this->getMessage());
        if( $this->getMailtype() == 'html' )
        {
            $this->getMailer()->isHTML(true);
        }
        
        if( $this->config['type'] == 'smtp' )
        {
            $this->getMailer()->isSMTP();
            $this->getMailer()->Host = $this->config['smtp_options']['host'];
            $this->getMailer()->SMTPAuth = true;
            $this->getMailer()->Username = $this->config['smtp_options']['connection_config']['username'];
            $this->getMailer()->Password = $this->config['smtp_options']['connection_config']['password'];
            $this->getMailer()->Port = $this->config['smtp_options']['port'];
        }
        
        if( !$this->getMailer()->send() )
        {
            throw new EmailException($this->getMailer()->ErrorInfo);
        }
    }
}