<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Traits/View/Helpers.php
 */
namespace mithra62\Traits\View;

use mithra62\Traits\DateTime;
use RelativeTime\RelativeTime;

/**
 * mithra62 - View Helper Trait
 *
 * Contains all the view helper methods we use
 *
 * @package View
 * @author Eric Lamb <eric@mithra62.com>
 */
trait Helpers
{
    use DateTime;
    
    /**
     * Whether to
     *
     * @var unknown
     */
    public $autoescape = false;
    
    /**
     * The Language object
     *
     * @var \mithra62\Language
     */
    protected $lang = null;
    
    /**
     * The File object
     *
     * @var \mithra62\Files
     */
    protected $file = null;
    
    /**
     * The File object
     *
     * @var \mithra62\Settings
     */
    protected $settings = null;
    
    /**
     * The File object
     *
     * @var \mithra62\Encrypt
     */
    protected $encrypt = null;
    
    /**
     * The Platform object
     *
     * @var \mithra62\Platforms
     */
    protected $platform = null;
    
    /**
     * A key value pairing mostly for select dropdown form fields
     * @var array
     */
    protected $options = array(
        'email_type' => array('html' => 'html', 'text' => 'text')
    );
    
    /**
     * Set it up
     *
     * @param \mithra62\Language $lang
     * @param \mithra62\Files $file
     * @param \mithra62\Settings $setting
     * @param \mithra62\Encrypt $encrypt
     * @param \mithra62\AbstractPlatform $platform
     */
    public function __construct(\mithra62\Language $lang, \mithra62\Files $file, \mithra62\Settings $setting, \mithra62\Encrypt $encrypt, \mithra62\Platforms\AbstractPlatform $platform)
    {
        $this->lang = $lang;
        $this->file = $file;
        $this->settings = $setting->get();
        $this->encrypt = $encrypt;
        $this->platform = $platform;
        $this->setTz($this->platform->getTimezone());
    }
    
    /**
     * Just passes to the Language object for translation
     *
     * @param string $string
     *            The language key to translate
     * @return \mithra62\string
     */
    public function m62Lang($string)
    {
        return $this->lang->__($string);
    }
    
    /**
     * Formats a file value into a human readable format
     *
     * @param string $string
     * @return \mithra62\string
     */
    public function m62FileSize($string, $html = true)
    {
        if( $string == '' )
        {
            return $this->m62Lang('na');
        }
        $formatted_size = $this->file->filesizeFormat($string);
        $return = '';
        if( $html )
        {
            $return = '<span class="backup_pro_filesize" title="' . number_format($string) . ' bytes">' . $formatted_size . '</span>';
        }
        else
        {
            $return = $formatted_size;
        }
    
        return $return;
    }
    
    /**
     * Formats a date
     *
     * @param string $date
     * @param string $html
     * @return string
     */
    public function m62DateTime($date, $html = true)
    {
        if ($this->settings['relative_time'] == '1') {
            if ($html) {
                $date = '<span class="backup_pro_timeago" title="' . $this->convertTimestamp($date, $this->settings['date_format']) . '">' . $this->getRelativeDateTime($date) . '</span>';
            } else {
                $date = $this->getRelativeDateTime($date);
            }
        } else {
            $date = $this->convertTimestamp($date, $this->settings['date_format']);
        }
    
        return $date;
    }
    
    /**
     * Encodes a string securely
     *
     * @param string $string
     * @return string
     */
    public function m62Encode($string)
    {
        return $this->encrypt->encode($string);
    }
    
    /**
     * Decodes a string securely
     *
     * @param string $string
     * @return string
     */
    public function m62Decode($string)
    {
        return $this->encrypt->decode($string);
    }
    
    /**
     * Creates a date in human readable format (1 hour, 7 years, etc...)
     *
     * @param unknown $date
     * @return string
     */
    public function m62RelativeDateTime($date)
    {
        return $this->getRelativeDateTime($date, false);
    }
    
    /**
     * Formats a time string into a human friendly format
     *
     * @param number $time
     * @param string $html
     * @param number $truncate
     * @return string
     */
    public function m62TimeFormat($time, $html = true, $truncate = 1)
    {
        $config = array(
            'separator' => ', ',
            'suffix' => false,
            'truncate' => $truncate
        );
    
        if (round($time) == '0') {
            $time = time() + ceil($time);
        } else {
            $time = time() + round($time);
        }
    
        $relativeTime = new \RelativeTime\RelativeTime($config);
        $formatted_time = $relativeTime->convert(time(), $time);
    
        $config = array(
            'separator' => ', ',
            'suffix' => false,
            'truncate' => 3
        );
        $relativeTime = new \RelativeTime\RelativeTime($config);
        $formatted_time_tip = $relativeTime->convert(time(), $time);
    
        if ($html) {
            return '<span class="backup_pro_timeago" title="' . $formatted_time_tip . '">' . $formatted_time . '</span>';
        }
    
        return $formatted_time;
    }
    
    /**
     * Returns a string to use for the form field errors
     *
     * @return string
     */
    public function m62FormErrors($errors)
    {
        $return = '';
        if (is_array($errors) && count($errors) >= 1) {
            $return = '<ul style="padding-top:5px; color:red;">';
            foreach ($errors as $error) {
                $return .= '<li class="notice">' . $this->m62Escape($error) . '</li>';
            }
            $return .= '</ul>';
        }
    
        return $return;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\View\ViewInterface::m62Escape()
     */
    public function m62Escape($string)
    {
        $escaper = new \Zend\Escaper\Escaper('utf-8');
        return $escaper->escapeHtml($string);
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Platforms\View\ViewInterface::m62Options()
     */
    public function m62Options($type, $translate = true)
    {
        if( !isset($this->options[$type]) )
        {
            return array(); //@todo add exception
        }
        
        $options = $this->options[$type];
        if( $translate )
        {
            foreach($options As $key => $value)
            {
                $options[$key] = $this->m62Lang($value);
            }
        }
        return $options;
    }
}