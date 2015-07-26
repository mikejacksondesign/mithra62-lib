<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/View.php
 */
 
namespace mithra62;

/**
 * mithra62 - View Object
 *
 * Simple View abstraction object
 *
 * @package 	View
 * @author		Eric Lamb <eric@mithra62.com>
 */
class View implements \ArrayAccess
{
    /**
     * Template file to include
     * @var string
     */
    protected $template = null;

    /**
     * View data
     * @var array
     */
    protected $data = array();

    /**
     * Layout to include (optional)
     * @var string
     */
    protected $layout = null;
    
    /**
     * The directory View scripts are stored
     * @var string
     */
    protected $view_dir = null;
    
    /**
     * Sets the View directory
     * @param string $path The directory where view scripts are stored
     * @return \mithra62\View
     */
    public function setViewDir($path)
    {
        $this->view_dir = $path;
        return $this;
    }
    
    /**
     * Returns the directory view scripts are stored in
     * @return string
     */
    public function getViewDir()
    {
        return $this->view_dir;
    }

    /**
     * Renders the view using the given data
     * @param string $template The template to use
     * @param array $data An array of to use in the template
     */
    public function render($template, array $data = array())
    {
        $this->data = $data;
        $this->layout = null;

        ob_start();

        include ($this->getViewDir().DIRECTORY_SEPARATOR.$template.'.php');
        if (null === $this->layout)
        {
            ob_end_flush();
        }
        else
        {
            ob_end_clean();
            $this->includeFile($this->layout);
        }
        return $this;
    }
    
    /**
     * Fetches the view result intead of sending it to the output buffer
     * @param string $template The tempalte to use
     * @param array $data An array of to use in the template
     * @return string
     */
    public function fetch($template, array $data)
    {
        ob_start();
        $this->template = $template;
        $this->render($template, $data);
        return ob_get_clean();
    }

    /**
     * Returns the view data
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets up the sub views
     * @param string $file
     * @return void
     */
    protected function includeFile($file)
    {
        $v = new View();
        $v->setViewDir($this->getViewDir());
        $v->render($file, $this->data);
        $this->data = $v->getData();
        return $this;
    }

    /**
     * Sets the layout template to use
     * @param string $file
     * @return void
     */
    protected function setLayout($file)
    {
        $this->layout = $file;
        return $this;
    }

    /**
     * capture Used by view to capture output.
     *
     * When a view is using a layout (via set_layout()), the only way to pass
     * data to the layout is via capture(), but the view can use capture()
     * to capture text any time, for any reason, even if the view is not using
     * a layout
     *
     * @return void
     */
    protected function capture()
    {
        ob_start();
        return $this;
    }

    /**
     * end_capture Used by view to signal end of a capture().
     *
     * The content of the capture is stored under $name
     *
     * @param string $name
     * @return void
     */
    protected function endCapture($name)
    {
        $this->data[$name] = ob_get_clean();
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetSet()
     * @ignore
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetExists()
     * @ignore
     */
    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetUnset()
     * @ignore
     */
    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetGet()
     * @ignore
     */
    public function offsetGet($offset) {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

}