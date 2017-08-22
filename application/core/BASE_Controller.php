<?php

defined('BASEPATH') or exit('No direct script access allowed!');

/**
 * Base Controller
 *
 * @author      arvernester@gmail.com
 * @package     Core
 * @subpackage  Controller
 * @copyright   2011
 *
 * @property	CI_Benchmark $benchmark
 * @property    CI_Calendar $calendar
 * @property    CI_Cart $cart
 * @property    CI_Config $config
 * @property    CI_DB_Active_record $db
 * @property    CI_Email $email
 * @property    CI_Encrypt $encrypt
 * @property    CI_Form_validation $form_validation
 * @property    CI_Image_lib $image_lib
 * @property    CI_Input $input
 * @property    CI_Lang $lang
 * @property    CI_Loader $load
 * @property    CI_Output $output
 * @property    CI_Pagination $pagination
 * @property    CI_Router $router
 * @property    CI_Security $security
 * @property    CI_Session $session
 * @property    CI_Upload $upload
 * @property    CI_Uri $uri
 * @property    CI_User_agent $agent
 * @property    MY_Session $session
 * @property	MY_Form_validation $form_validation
 *
 * @property    Auth $auth
 * @property    Template $template
 * @property    Captcha $captcha
 * @property    Setting $setting
 * @property    Theme $theme
 * */
class BASE_Controller extends MX_Controller 
{
    #-- CLASS PROPERTIES --#
    /**
    * Module name 
    */ 
    public $module          = '';
    
    /**
    * Class name
    */          
    protected $class        = '';
    
    /**
    * Base dependency model
    */
    protected $model        = '';
    
    /**
    * Variable data assignment to view
    */
    protected $data         = array();
    #-- END OF CLASS PROPERTIES --#
    
    #-- PAGE PROPERTIES --#
    /**
    * Default Page Type
    * Option ms or list 
    */
    protected $pagetype     = 'list';
    
    /**
    * Default Page Title
    */
    protected $pagetitle    = '';

    /**
    * Default Page URL
    */
    protected $pageurl      = '';
    #-- END OF PAGE PROPERTIES --#

    #-- LAYOUT PROPERTIES --#
    /**
    * Layout variable 
    */
    protected $layout       = array();
    
    /**
    * Template for content
    */
    protected $template     = '';
    #-- END OF LAYOUT PROPERTIES --#
    
    #-- AUTHENTICATION --#
    /**
    * Variable using authentication 
    */
    protected $isauth       = TRUE;
    #-- END OF AUTHENTICATION --#

    /**
     * Constructor
     */
    function __construct() 
    {
        parent::__construct();
        
        #attribute initiation
        $this->class = strtolower(get_class($this));
        
        #load basic model returning as $this->model variable
        $this->loadBaseModel();
        
        #reset log query
        //$this->resetLogQuery();
        
        #check authentication
        if( $this->module )
            $this->checkAuth();
        
        #set page properties
        $this->pageProperties();
    }
    
    #-- LOAD MODEL --#
    /**    
    * Load base model from class references
    *
    * @return Object $this
    */
    protected function loadBaseModel() 
    {
        if( !empty($this->model) )
        {
            $this->loadModel($this->model, $this->model);
        }
        
        return $this;
    }
    
    /**    
    * Load model
    *
    * @param String $model_name
    * @param String @callback_name
    * @return Void
    */
    protected function loadModel($model_name, & $callback_name)
    {
        if( strpos($model_name, 'model') !== FALSE ) 
        {
            $aliases = str_replace('model_', '', $model_name);
        }
        else 
        {
            $aliases = $model_name;
        }
        
        $this->load->model($model_name, $aliases);
        
        $this->$aliases->setReferer($this);
        
        $callback_name = $this->$aliases;   
    }
    #-- END OF LOAD MODEL --#
    
    #-- PAGE PROPERTIES --#
    /**
    * Checking Basic Authentication
    * 
    * @return void 
    */
    protected function checkAuth()
    {
        $token = $this->auth->getToken(3);
        
        if( $this->isauth ) 
        {
            $this->data['auth'] = $token;
            
            #auto logout
            if( !$token['islogin'] ) 
                redirect(base_url('gate/sso'));
            
            #auto menu    
            /*if( $this->module != $this->auth->getSIM() and $this->module != 'gate' )
                redirect(base_url('gate/menu'));*/
        }            
    }

    /**
    * Page Properties
    * 
    * @return void 
    */
    protected function pageProperties()
    {
        $this->pageurl          = $this->module . '/' . $this->class;
        $this->data['pageurl']  = $this->pageurl;
    }
    
    /**
    * Create breadcrums
    *
    * @param String $uristring
    */
    protected function setBreadcrums($uristring) 
    {
        $uristring = explode('/', $uristring);
        
        $a_breadcrums = array();
        
        foreach( $uristring as $uri )
        {
            if( $uri == $this->module )
            {
                $a_breadcrums[] = anchor(base_url($uri), 'Home');
            }
            elseif ( $uri == $this->class ) 
            {
                $a_breadcrums[] = anchor(base_url($this->pageurl), $this->pagetitle);
            }
            elseif( $uri == 'lst' or $uri == 'add' or $uri == 'detail' or $uri == 'edit' ) 
            {
                $a_breadcrums[$i] = $this->data['pagetitle'];
            }   
        }
        
        $this->data['breadcrums'] = $a_breadcrums;
    }
    
    /**
    * Add page filter
    *
    * @param String $key
    * @param String $value
    */
    protected function addPageFilter($key, $value)
    {
        $module = strtoupper($this->module);    
        $class  = strtoupper($this->class);
        
        $_SESSION[$module][$class]['VAR']['FILTER'][$key] = $value;    
    }

    /**
    * Get page filter
    *
    * @param String $key
    * @param String $value
    */
    protected function getPageFilter()
    {
        $module = strtoupper($this->module);    
        $class  = strtoupper($this->class);
        
        if( $_SESSION[$module][$class]['VAR']['FILTER'] )
            return $_SESSION[$module][$class]['VAR']['FILTER'];
        else 
            return FALSE;
    }

    /**
    * Reset page filter
    *
    * @return void
    */
    protected function resetPageFilter()
    {
        $module = strtoupper($this->module);    
        $class  = strtoupper($this->class);
        

        unset($_SESSION[$module][$class]['VAR']['FILTER']); 
        unset($_SESSION[$module][$class]['VAR']['FIND']);
    }
    
    /**
    * Add page find
    *
    * @param String $key
    * @param String $value
    */
    protected function addPageFind($value)
    {
        $module = strtoupper($this->module);    
        $class  = strtoupper($this->class);
        
        $_SESSION[$module][$class]['VAR']['FIND']= $value;    
    }

    /**
    * Get page find
    *
    * @param String $key
    * @param String $value
    */
    protected function getPageFind()
    {
        $module = strtoupper($this->module);    
        $class  = strtoupper($this->class);
        
        if( $_SESSION[$module][$class]['VAR']['FIND'] )
            return $_SESSION[$module][$class]['VAR']['FIND'];
        else 
            return FALSE;
    }

    /**
    * Add page limit
    *
    * @param Int $limit
    * @return void
    */
    protected function addPageLimit($limit)
    {
        $module = strtoupper($this->module);    
        $class  = strtoupper($this->class);
        
        $_SESSION[$module][$class]['VAR']['LIMIT'] = $limit;    
    }
    
    /**
    * Get page limit
    *
    * @param Int $limit
    * @return void
    */
    protected function getPageLimit()
    {
        $module = strtoupper($this->module);    
        $class  = strtoupper($this->class);
        
        if( !empty($_SESSION[$module][$class]['VAR']['LIMIT']) )
            return $_SESSION[$module][$class]['VAR']['LIMIT']; 
        else
            return FALSE;
    }

    /**
    * Reset page limit
    *
    * @param Int $limit
    * @return void
    */
    protected function resetPageLimit()
    {
        $module = strtoupper($this->module);    
        $class  = strtoupper($this->class);
        
        if( !empty($_SESSION[$module][$class]['VAR']['LIMIT']) )
        {
            unset($_SESSION[$module][$class]['VAR']['LIMIT']); 
        }    
    }
    
    /**
    * Set Pagination
    *
    * @param String $base
    * @param Int $limit
    * @param Int $page
    * @param Int $total
    */
    protected function setPaging($base, $limit, $page, $total) 
    {
        include_once( COREPATH . 'core/Base_pagination.php' );
        
        $this->base_pagination = new Base_Pagination();

        $config['base_url']      = $base;
        $config['total_rows']    = $total;
        $config['per_page']      = $limit;
        
        //initialize config
        $this->base_pagination->initialize($config);
        
        $this->data['offset']           = $page;
        $this->data['paging_link']      = $this->base_pagination->create_links();
        $this->data['paging_display']   = 'Showing ' . ($page + 1)." to ".((($page + $limit) > $total) ? $total : ($page + $limit))." of $total entries";
    }
    #-- END OF PAGE PROPERTIES --#
    
    #-- LOG QUERY--#
    /**
     * Get logged query
     * 
     * @return Array
     */
    protected function getLogQuery()
    {
        $module = strtoupper($this->module);
        $class  = strtoupper($this->class);
        
        if( isset($_SESSION[$module][$class]) )
            return $_SESSION[$module][$class];
        else
            return FALSE;
    }
    
    /**
     * Reset log query for referer
     */
    protected function resetLogQuery()
    {
        $module = strtoupper($this->module);
        $class  = strtoupper($this->class);
        
        if( !empty($this->model) and !empty($this->class) )
            unset($_SESSION[$module][$class]['LOG']['SQLLOG']);
        
        return $this;
    }
    #-- END OF LOG QUERY--#
    
    #-- TEMPLATING --#
    /**
    * Used to initialize of view
    *
    * @param String template
    * @param String pagetype
    * @return Object this 
    */
    protected function initView($template, $pagetype = 'list')
    {
        # set variable
        $this->template = $template;
        $this->pagetype = $pagetype;
        
        # init layout
        $this->initLayout($this->template);
        
        # init assets
        $this->initAssets($this->layout[$this->pagetype]['directory']);
        
        return $this;
    }
    
    /**
    * Used to initialize layout
    *
    * @param String view
    * @return Object this
    */
    private function initLayout($view) 
    {
        $layout = $this->config->item('layout');
        
        foreach ( $layout as $key => $value )
        {
            $this->layout[$key]['directory'] = $value['directory'];        
            $this->layout[$key]['main'] = $value['directory'] . $value['main'];        
            
            foreach ( $value['items'] as $k => $val )
            {
                if ( $val == 'content' )
                {
                    if( file_exists(MODULEPATH . $this->module . '\\' . 'views\\' . $view . EXT) )
                    {
                        $this->layout[$key]['items'][$val] = $view;    
                    }
                    else
                    {
                        $this->layout[$key]['items'][$val] = $value['directory'] . $view;
                    }
                }
                else
                {
                    $this->layout[$key]['items'][$val] = $value['directory'] . $val;
                }
            }
        }
        
        return $this;
    }
    
    /**
    * 
    * Used to initialize asset of layout
    *
    * @param String layoutdir
    * @return Object this 
    */    
    private function initAssets($layoutdir)
    {
        if( is_dir( VIEWPATH . $layoutdir . 'script' ) )
        {
            $this->data['script_path'] = $layoutdir . 'script';
        }
        
        return $this;   
    }
    
    /**
    * Used to build view
    *
    * @return Object this 
    */
    protected function build() 
    {
        $this->load->library('view');
        
        // set layout
        $this->view->layout = $this->layout[$this->pagetype]['main'];
        
        // set data layout
        $this->view->data($this->data);
        
        // load view items
        $this->view->load($this->layout[$this->pagetype]['items']);
        
        //rendering
        $this->view->render();
        
        return $this;    
    }
    #-- END OF TEMPLATING --#
    
    #-- MAIN CONTENT --#
    /**
     * Default index page
     */
    public function index()
    {
        $this->lst();
    }

	/**
	 * Default list page
	 * 
	 * @param Int $page
	 */
	public function lst($page = 0)
	{
        #page properties
        if(empty($this->data['pagetitle']))
            $this->data['pagetitle']    = "Daftar " . $this->pagetitle;
        
        if(empty($this->data['subpagetitle']))
            $this->data['subpagetitle'] = "List Data " . $this->pagetitle;
        
        #breadcrums
        $this->setBreadcrums($this->uri->uri_string());
        
        #default view
        if ( empty($this->template) ) 
        {
            $this->initView('list_data');
        }
        
        #post data
        $post = $this->input->post();

        #insert inline
        if( $post['act'] == 'insertinline' ) 
        {
            $record = getDataPost($this->data['a_kolom'], $post, 'i');
            
            list($poststatus, $postmessage, $postdata) = $this->model->insert($record);
            
            if($poststatus)
                redirect(base_url($this->pageurl . '/lst'));
        }
        
        #update inline
        if( $post['act'] == 'updateinline' ) 
        {
            $record = getDataPost($this->data['a_kolom'], $post, 'u');
            
            list($poststatus, $postmessage, $postdata) = $this->model->update($record, $page);
            
            if($poststatus)
                redirect(base_url($this->pageurl . '/lst'));
        }
        
        #for list master
        if( $this->template <> 'list_data' )
        {
            if( empty($this->data['a_data']) )
            {
                $this->data['key']      = $this->model->getKeys();
                $this->data['u_key']    = ($page) ? $page : NULL;
                $this->data['a_data']   = $this->model->getList();
            }
        }
        #for list data
        else
        {
            # post table limit
            if( $post['tablelimit'] ) 
            {
                $this->addPageLimit($post['tablelimit']);
            }

            # post reset
            if( $post['btnreset'] ) 
            {
                $this->resetPageLimit();
                $this->resetPageFilter();
            }

            # post cari
            if( $post['btncari'] )
            {
                # save find query
                $this->addPageFind(strtolower($post['cari']));

                # add filter
                foreach ($this->data['a_kolom'] as $ndx => $row) 
                {
                    $this->addPageFilter("$row[kolom]", strtolower($post['cari']));
                }
            }

            if( empty($this->data['a_data']) )
            {
                # page filter
                if( $this->getPageFilter() )
                {
                    $filters = $this->getPageFilter();

                    foreach ($filters as $key => $value) 
                    {
                        $this->model->addFilter("$key {or like}", $value);
                    }
                }

                # limit
                $i_limit = ($this->getPageLimit()) ? $this->getPageLimit() : 10;
                
                # set limit    
                $this->model->setLimit($i_limit, $page);

                # get limit
                $limit = $this->model->getLimit(TRUE);

                # data properties
                $this->data['key']      = $this->model->getKeys();
                $this->data['find']     = $this->getPageFind();
                $this->data['limit']    = $i_limit; 
                $this->data['a_data']   = $this->model->getListPager($this->model->getKeys(), $limit['limit'], $page);

                # pagination
                $this->setPaging(base_url($this->pageurl . '/lst'), $limit['limit'], $page, $this->data['a_data']['total']);
            }
        }
        
        #build layout
        $this->build();
	}

	/**
	 * Detail data
	 * 
	 * @param String value
	 */
	public function detail($value)
	{
        #page properties
        if(empty($this->data['pagetitle']))
            $this->data['pagetitle']    = "Detail " . $this->pagetitle;
        
        if(empty($this->data['subpagetitle']))
            $this->data['subpagetitle'] = "Detail Data " . $this->pagetitle;
        
        #breadcrums
        $this->setBreadcrums($this->uri->uri_string());

        if ( !isset($this->data['row']) ) 
        {
            $this->data['isedit']   = FALSE;
            $this->data['key']      = $this->model->getKeys(); 
            $this->data['row']      = $this->model->getData($value);
        }
        
        #default template
        if ( empty($this->template) )
        {
            $this->initView('data_detail');
        }
            
        #build layout
        $this->build();
	}

	/**
     * Edit data
     * 
     * @param value
     */
    public function edit($value = NULL)
    {
        if( !is_null($value) )
        {
            #page properties
            if(empty($this->data['pagetitle']))
                $this->data['pagetitle']    = "Edit " . $this->pagetitle;
            
            if(empty($this->data['subpagetitle']))
                $this->data['subpagetitle'] = "Edit Data " . $this->pagetitle;
        }
        else
        {
            #page properties
            if(empty($this->data['pagetitle']))
                $this->data['pagetitle']    = "Tambah " . $this->pagetitle;
            if(empty($this->data['subpagetitle']))
                $this->data['subpagetitle'] = "Tambah Data " . $this->pagetitle;
        }

        #breadcrums
        $this->setBreadcrums($this->uri->uri_string());

        #default setting edit
        $this->data['isedit']   = TRUE;

        #fetching data
        if ( !isset($this->data['row']) and !empty($value) ) 
        {
            $this->data['key']      = $this->model->getKeys(); 
            $this->data['row']      = $this->model->getData($value);
        }

        #post data
        $post = $this->input->post();

        if( $post )
        {
            $record = getDataPost($this->data['a_kolom'], $post);

            #edit
            if( !empty($value) )
            {
                list($poststatus, $postmessage, $postdata) = $this->model->update($record, $value);
            }
            #add
            else
            {
                list($poststatus, $postmessage, $postdata) = $this->model->insert($record, TRUE);
            }

            if($poststatus)
                redirect(base_url($this->pageurl . "/detail/$value"));   
        }
        
        #view
        if ( empty($this->template) )
        {
            $this->initView('data_detail');
        }
            
        #build layout
        $this->build();
    }
    
    /**
	 * Add data
	 */
	public function add()
	{
        $this->edit();
	}
    
    /**
    * Delete record
    * 
    * @param $values  
    */
    public function delete($value)
    {
        if( $value )
        {
            list($poststatus, $postmessage, $postdata) = $this->model->delete($value);
            
            if( $poststatus )
                redirect(base_url($this->pageurl));
        }
    }
    #-- END OF MAIN CONTENT --#
}

/* end of file MY_Controller.php */
/* location APPPATH/core/MY_Controller.php */