<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* View Object
* 
* Renders a layout with partials (blocks) inside.
* Renders partials only (header,content,footer. etc).
* Allows a plugin or module to render a partial.
* 
* The source directory can be specified.
* Works with Matchbox modules.
* 
* Version 2.1.0 Wiredesignz (c) 2008-02-18
**/
class View
{
    /**
    * Class properties
    */
    var $layout, $data, $partials = array();
    
    /**
    * Constructor
    */
    function View($file = NULL)            //specify a layout file to use
    {
        $this->layout = $file;
        
        static $data = array(
            'directory' => '',
            'module'    => '',
        );

        $this->data =& $data;            //data is static
    }
    
    /**
    * Loading view
    *
    * @param String $view
    * @param Array $data
    * @return void 
    */
    function load($views, $data = NULL)    //store partials as nested objects
    {
        if (is_array($views))
        {
            foreach ($views as $k => $v) 
            {
                $this->set($k, $v);
            }
        }
        else $this->set(NULL, $views);
        
        if (is_array($data))
        {
            $this->data($data);
        }
    }
    
    /**
    * Create or overwrite a partial
    *
    * @param String $view
    * @param Object $file
    * @return void 
    */
    function set($view, $file)
    {
        $this->partials[$view] = (is_object($file)) ? $file : new View($file);
    }
    
    /**
    * Store data for view
    *
    * @param String $view
    * @param Int $value
    * @return void 
    */
    function data($data, $value = NULL)
    {
        if (is_array($data)) 
        {
            $this->data = array_merge($this->data, $data);    
        }
        elseif ($value != NULL)
        {
            $this->data[$data] = $value;
        }
    }
  
    /**
    * Returns data value(s)
    *
    * @param Int $key
    * @return String 
    */
    function fetch($key = NULL)
    {
        return ($key) ? (isset($this->data[$key])) ? $this->data[$key] : NULL : $this->data;
    }

    /**
    * Create the page
    *
    * @param Boolean $render
    * @return String 
    */        
    function render($render = FALSE) 
    {
        if ($this->layout)
        {
            $ci = & get_instance();
            $ci->load->vars($this->partials);
            return $ci->load->view($this->data['directory'].$this->layout, $this->data, $render, $this->data['module']);
        }
        else 
        {
            foreach($this->partials as $k => $v) 
            {
                $v->render();
            }
        }
    }
}