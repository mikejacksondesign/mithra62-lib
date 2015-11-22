<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	mithra62/Twig/m62LangTwigExtension.php
 */
 
namespace mithra62\Twig;

use Twig_Extension;
use Twig_Filter_Method;
use mithra62\Traits\DateTime;

/**
 * mithra62 - Twig View Helpers
 *
 * Contains all the view helpers for Twig
 *
 * @package 	Twig
 * @author		Eric Lamb <eric@mithra62.com>
 */
class m62LangTwigExtension extends \Twig_Extension
{
    use DateTime;
    
    /**
     * Whether to 
     * @var unknown
     */
    public $autoescape = false;
    
    /**
     * The Language object
     * @var \mithra62\Language
     */
    private $lang = null;
    
    /**
     * The File object
     * @var \mithra62\Files
     */
    private $file = null;
    
    /**
     * The File object
     * @var \mithra62\Settings
     */
    private $settings = null;
    
    /**
     * The File object
     * @var \mithra62\Encrypt
     */
    private $encrypt = null;
    
    /**
     * The Platform object 
     * @var \mithra62\Platforms
     */
    private $platform = null;
    
    /**
     * Set it up
     * @param \mithra62\Language $lang
     * @param \mithra62\Files $file
     * @param \mithra62\Settings $setting
     * @param \mithra62\Encrypt $encrypt
     * @param \mithra62\Platforms\AbstractPlatform $platform
     */
    public function __construct(
        \mithra62\Language $lang, 
        \mithra62\Files $file, 
        \mithra62\Settings $setting,
        \mithra62\Encrypt $encrypt,
        \mithra62\Platforms\AbstractPlatform $platform)
    {
        $this->lang = $lang;
        $this->file = $file;
        $this->settings = $setting->get();
        $this->encrypt = $encrypt;
        $this->platform = $platform;
        $this->setTz($this->platform->getTimezone());
    }
    
    /**
     * (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'm62Lang';
    }
        
    /**
     * (non-PHPdoc)
     * @see Twig_Extension::getFilters()
     */
    public function getFilters()
    {
        return array(
            'm62Lang' => new Twig_Filter_Method($this, 'm62Lang'),
            'm62FileSize' => new Twig_Filter_Method($this, 'm62FileSize'),
            'm62DateTime' => new Twig_Filter_Method($this, 'm62DateTime'),
            'm62Encode' => new Twig_Filter_Method($this, 'm62Encode'),
            'm62Decode' => new Twig_Filter_Method($this, 'm62Decode'),
            'm62RelativeDateTime' => new Twig_Filter_Method($this, 'm62RelativeDateTime'),
        );
    }
    
    /**
     * Just passes to the Language object for translation
     * @param string $string The language key to translate
     * @return \mithra62\string
     */
    public function m62Lang($string)
    {
        return $this->lang->__($string);
    }
    
    /**
     * Formats a file value into a human readable format
     * @param string $string
     * @return \mithra62\string
     */
    public function m62FileSize($string)
    {
        return $this->file->filesizeFormat($string);
    }
    
    /**
     * Formats a date
     * @param string $date
     * @param string $html
     * @return string
     */
    public function m62DateTime($date, $html = true)
    {
        if($this->settings['relative_time'] == '1')
        {
            if($html)
            {
                $date = '<span class="backup_pro_timeago" title="'.$this->convertTimestamp($date, $this->settings['date_format']).'">'.$this->getRelativeDateTime($date).'</span>';
            }
            else
            {
                $date = $this->getRelativeDateTime($date);
            }
        }
        else
        {
            $date = $this->convertTimestamp($date, $this->settings['date_format']);
        }
        
        return $date;
    }
    
    /**
     * Encodes a string securely
     * @param string $string
     * @return string
     */
    public function m62Encode($string)
    {
        return $this->encrypt->encode($string);
    }
    
    /**
     * Decodes a string securely
     * @param string $string
     * @return string
     */
    public function m62Decode($string)
    {
        return $this->encrypt->decode($string);
    }
    
    /**
     * Creates a date in human readable format (1 hour, 7 years, etc...)
     * @param unknown $date
     * @return string
     */
    public function m62RelativeDateTime($date)
    {
        return $this->getRelativeDateTime($date, false);
    }
}