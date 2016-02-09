<?php
/**
 * mithra62 - Backup Pro
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./mithra62/BackupPro/Platforms/View/Concrete5.php
 */
namespace mithra62\Platforms\View;

/**
 * Backup Pro - Concrete5 View Object
 *
 * Contains the view helpers for Concrete5
 *
 * @package BackupPro\View
 * @author Eric Lamb <eric@mithra62.com>
 */
class Concrete5 extends AbstractView
{
    /**
     * The path to the partials directory
     * @var string
     */
    protected $partials_path = '';
    
    /**
     * The URL base to use for calling static assets in view partials
     * @var string
     */
    protected $static_assets_url_base = '';
    
    /**
     * Renders a view partial
     * @param string $template The partial path to render. 
     *      Note that the base view path is from single_pages\dashboard\backup_pro
     * @param array $variables 
     * @param string $context
     */
    public function partial($template, array $variables = array(), $context = null)
    {
        $partial = $this->getPartialsPath().$template.'.php';
        extract($variables);
        $view_helper = $this;
        $bp_static_path = $this->getStaticAssetsUrlBase();
        if( file_exists($partial) )
        {
            include $partial;
        }
        else
        {
            echo 'Partial not found! '.$partial;
        }
    }
    
    public function setPartialsPath($path)
    {
        $this->partials_path = $path;
        return $this;
    }
    
    public function getPartialsPath()
    {
        return rtrim($this->partials_path, DIRECTORY_SEPARATOR).
            DIRECTORY_SEPARATOR.'single_pages'.
            DIRECTORY_SEPARATOR.'dashboard'. 
            DIRECTORY_SEPARATOR.'backup_pro'.DIRECTORY_SEPARATOR;
                
    }
    
    public function setStaticAssetsUrlBase($url_base)
    {
        $this->static_assets_url_base = $url_base;
        return $this;
    }
    
    public function getStaticAssetsUrlBase()
    {
        return $this->static_assets_url_base;
    }
}