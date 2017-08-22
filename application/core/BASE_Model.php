<?php

defined('BASEPATH') or exit('No direct script access allowed!');

class BASE_Model extends CI_Model 
{
    /**
    * Database group connection
    *
    * @var String 
    */
    protected $db_group    = 'default';
    
    /**
    * Database group connection object
    *
    * @var String 
    */
    //protected $db          = NULL;
    
    /**
    * Table schema
    * default `public`
    *
    * @var String
    */
    protected $schema      = 'public';
    
    /**
    * Table name
    *
    * @var String
    */
    protected $table       = '';
    
    /**
    * Called by controller class
	* Object of referer class
    */
    protected $referer     = NULL;
    
    /**
    * Table primary key
    * default `id`
    *
    * @var Array
    */
    protected $keys        = array('id');
    
    /**
    * Table combo value
    *
    * @var String
    */
    protected $values      = array();
    
    /**
    * Default filter
    *
    * @var Array[] 
    */
    protected $filter      = array();
    
    /**
    * Default sort
    *
    * @var String[] 
    */
    protected $sort        = '';
    
    /**
    * Default limit of active record
    *
    * @var Integer 
    */
    protected $limit       = 10;
    
    /**
    * Default offset of active record
    *
    * @var Integer 
    */
    protected $offset      = 0;
    
    /**
    * Constructor
    *
    * @var String $callback_name
    */
    public function __construct(&$callback_name = NULL) 
    {
        parent::__construct();
        
        //load db group
        if( $this->db_group != 'default' ) 
        {
            #clear db
            unset($this->db);
            
            #reinitiate db
            $this->db = $this->load->database($this->db_group, TRUE);
        }
            
        $callback_name = $this->db;
    }
    
    /**
    * Destructor
    */
    public function __destruct()
    {
		#unset db when not in default connection group
        if( $this->db_group != 'default' )
            $this->db      = NULL;
    }
    
    /**
    * Get table name
    *
    * @param String $tablename
    * @param String $aliases
    * @return String
    */ 
    protected function getTable($tablename = '', $aliases = '') 
    {
        $schema = NULL;
        
        if( empty($tablename) ) 
        {
            return $this->schema . '.' .$this->table . ' ' . $aliases . ' ';
        }
        else 
        {
            if( strpos('.', $tablename) !== FALSE )
                list($schema, $tablename) = explode('.', $tablename);
            
            if ( $schema and $tablename ) 
            {
                return $schema . '.' .$tablename . ' ' . $aliases . ' ';
            }
            else 
            {
                return $this->schema . '.' . $tablename . ' ' . $aliases;
            }
        }
    }
    
    /**    
    * Get keys combination
    *
    * @param Int $INT_MODE
    * @return String
    */
    public function getKeys($INT_MODE = 0) 
    {
        switch ( $INT_MODE ) 
        {
            case 0 : 
                return $this->keys;
            break;
            
            case 1 :
                return implode('/', $this->keys);
            break;
            
            case 2 :
                return implode('_', $this->keys);
            break;

            case 3 :
                return implode(',', $this->keys);
            break;
        }
    }
    
    /** 
    * Get pairing of keys and values
    *
    * @param Array $keys or String with comma separator $keys ex : array(key1, key2, key3) or key1,key2,key3
    * @param Array $values or String with comma separator $values ex : array(val1, val2, val3) or val1,val2,val3
    * @return Array pairing keys and values
    */
    protected function getKeyValue($keys, $values) 
    {
        $a_result = array();

        if( is_array($keys) ) 
        {
            if( !is_array($values) ) 
                $values = explode(',', $values);    
            
            for( $i = 0; $i < count($keys); $i++ )
            {
                if( !empty($values[$i]) )
                    $a_result[trim($keys[$i])] = trim($values[$i]);
            }
        }
        else 
        {
            $keys = explode(',', $keys);
            
            if( !is_array($values) ) 
                $values = explode(',', $values);    
            
            for( $i = 0; $i < count($keys); $i++ )
            {
                if( !empty($values[$i]) )
                    $a_result[trim($keys[$i])] = trim($values[$i]);
            }    
        }
        
        return $a_result;    
    }
    
    /**    
    * Get all fields from table
    *
    * @return Array
    */
    protected function getFields()
    {
        $fields = array();
        
        if( $this->db->dbdriver == 'mysql' ) 
        {
            $fields = $this->db->list_fields($this->getTable());
        } 
        else 
        {
            $sql = "SELECT *
                    FROM information_schema.columns
                    WHERE table_schema = '".$this->schema."'
                    AND table_name   = '".$this->table."'";

            $result = $this->db->query($sql)->result_array();

            foreach( $result as $row )
            {
                $fields[] = $row['column_name'];
            }
        }
            
        return $fields;
    }
    
    /**
    * Basic query for select 
    */
    protected function getBaseQuery() 
    {
        $this->db->select('*');
        $this->db->from($this->getTable());
        
        $compiled_sql = $this->db->get_compiled_select() . ' ';
        
        return $compiled_sql;
    }
    
    /**
    * Set controller class referer basicly from this model
    *
    * @param String $referer
    */
    public function setReferer($referer) 
    {
        $this->referer = $referer;
    }
    
    /**
    * Set filter for selecting data
    *
    * @param Array $a_filter[] = Array($key, $value)
    */
    protected function setFilter($a_filter = NULL) 
    {
        if( is_array($a_filter) )
        {
            foreach( $a_filter as $index => $filters )
            {
                //foreach( $filters as $key => $value )
                list($key, $value) = $filters;
                
                $this->addFilter($key, $value);
            }
        }
        elseif( strpos('where', strtolower($a_filter)) !== FALSE )
        {
            $this->filter = $a_filter;    
        }
        else 
        {
            $filters[] = array($this->getKeys(), $a_filter);
            
            $this->setFilter($filters);
        }        
    }
    
    /**
    * Set Key for Filter Definition
    *
    * @param String $key
    * @return Array key and function
    */
    private function setKeyFilter($key) 
    {
        #reformating key case
        $key = strtolower($key);
        
        $function = "where";
       
        #produce key
        if ( strpos($key, '{or}') !== FALSE ) 
        {
            $key = trim(str_replace('{or}', '', $key)); 

            $function = "or_where";    
        }
        else if( strpos($key, '{in}') !== FALSE ) 
        {
            $key = trim(str_replace('{in}', '', $key)); 
            
            $function = "where_in";
        }
        else if ( strpos($key, '{or in}') !== FALSE ) 
        {
            $key = trim(str_replace('{or in}', '', $key)); 
            
            $function = "or_where_in";    
        }
        else if ( strpos($key, '{not in}') !== FALSE ) 
        {
            $key = trim(str_replace('{not in}', '', $key)); 
            
            $function = "where_not_in";    
        }
        else if ( strpos($key, '{or not in}') !== FALSE ) 
        {
            $key = trim(str_replace('{or not in}', '', $key)); 
            
            $function = "or_where_not_in";    
        }
        else if ( strpos($key, '{like}') !== FALSE ) 
        {
            $key = trim(str_replace('{like}', '', $key)); 
            
            $function = "like";    
        }
        else if ( strpos($key, '{or like}') !== FALSE ) 
        {
            $key = trim(str_replace('{or like}', '', $key)); 
            
            $function = "or_like";    
        }
        else if ( strpos($key, '{not like}') !== FALSE ) 
        {
            $key = trim(str_replace('{not like}', '', $key)); 
            
            $function = "not_like";    
        }
        else if ( strpos($key, '{or not like}') !== FALSE ) 
        {
            $key = trim(str_replace('{or not like}', '', $key)); 
            
            $function = "or_not_like";    
        }
        else
        {
            $key = trim($key); 
            
            $function = "where";    
        }
        
        return array('key' => $key, 'function' => $function);    
    }
    
    /**
    * Adding filter for selecting data
    *
    * @param String $key
    * @param String $value
    * @return Array
    */
    public function addFilter($key, $value) 
    {
        array_push($this->filter, array($key => $value));
    }
    
    /**
    * Get page filter
    */
    public function getPageFilter()
    {
        $module     = strtoupper($this->referer->module);
        $class      = strtoupper(get_class($this->referer));
        
        foreach( $_SESSION[$module][$class]['VAR']['FILTER'] as $index => $filter )
        {
            foreach( $filter as $key => $value )
                $this->addFilter($key, $value);   
        }    
    }
    
    /**
    * Get filter of Active Record
    *
    * @param Boolean $is_return_clausa
    * @return String
    */
    protected function getFilter($is_return_clausa = TRUE)
    {
        if( is_array($this->filter) ) 
        {
            foreach( $this->filter as $index => $filters ) 
            {
                foreach( $filters as $key => $value ) 
                {
                    #produce value
                    if( !is_array($value) and strpos($value, 'select') !== FALSE ) 
                    {
                        $a_value = $this->db->query($value)->result_array();
                        
                        if( $a_value ) {
                            foreach( $a_value as $a_k => $a_val )
                                foreach( $a_val as $k => $v )
                                    $v_val[] = $v;
                                
                            $keys = $this->setKeyFilter("$key in");
                            
                            $this->db->$keys['function']($keys['key'], $v_val);
                        }
                    } 
                    else 
                    {
                        $keys = $this->setKeyFilter($key);

                        $this->db->$keys['function']($keys['key'], $value);    
                    }
                }
            }
            
            $clausa = $this->db->_compile_wh('qb_where');
        }
        else
        {
            $clausa = $this->filter;    
        }
        
        if( $is_return_clausa )
            return $clausa;
        else
            return $this->db;
    }
    
    /**
    * Set order of active record
    *
    * @param $order Array or String
    */
    protected function setSort($order = array(), $is_return_order = FALSE)
    {
        if( is_array($order) ) 
        {
            foreach( $order as $key => $value ) 
            {
                if( is_numeric($key) )
                {
                    $this->db->order_by($value, 'asc');        
                }
                elseif( strpos(strtolower($value), 'asc') === FALSE
                or strpos(strtolower($value), 'desc') === FALSE ) 
                {
                    $this->db->order_by($value, 'asc');    
                }
                else
                {
                    $this->db->order_by($key, $value);
                }
            }
        }
        elseif( empty($order) ) 
        {
            $this->setSort($this->keys);
        }
        else
        {
            $this->db->order_by($order);    
        }
    }
    
    /**
    * Adding sort for selecting data
    *
    * @param String $key
    * @param String $value
    * @return Array
    */
    public function addSort($key, $value, $callable_class) 
    {
        array_push($this->sort, array($key => $value));
    }
    
    /**
    * Getting sort for selecting data
    *
    * @param String $key
    * @param String $value
    * @return String
    */
    protected function getSort($is_return_order = TRUE) 
    {
        if( empty($this->sort) )
        {
            $this->setSort($this->keys);
        }
        else
        {
            $this->setSort($this->sort);
        }
                
        $sort = $this->db->_compile_order_by();
        
        if( $is_return_order )
            return $sort;
        else
            return $this->db;    
    }
    
    /**
    * Set limit of active record
    *
    * @param int $limit
    * @param int offset 
    * @param Boolean $is_return_limit_offset
    * @return Array
    */
    public function setLimit($limit = NULL, $offset = NULL, $is_return_limit_offset = FALSE)
    {
        #check if variable $limit empty
        if( !is_null($limit) ) 
        {
            $this->limit    = $limit;
            $this->offset   = $offset;
            
            #$this->db->limit($limit, $offset);
        }
        else 
        {
            $this->offset   = $offset;
            
            #$this->db->limit($this->limit, $offset);
        }
        
        if( $is_return_limit_offset )
            return array($this->limit, is_null($this->offset) ? 0 : $this->offset);
        else
            return $this->db;        
    }
    
    /**
    * Getting limit for selecting data
    *
    * @return String
    */
    public function getLimit($is_return_element = FALSE) 
    {
        if( $is_return_element )
        {
            $a_limit['limit']   = $this->limit;
            $a_limit['offset']  = $this->offset;

            return $a_limit;
        }
        
        return "limit " . $this->limit . " offset " . $this->offset;    
    }
    
    /**
    * Get one record of data
    *
    * @param Array $filter
    * @return Array Result of Active Record
    */
    public function getData($a_filter = array())
    {
        #call base query
        $sql = $this->getBaseQuery();
        
        //set filter
        if( !empty($a_filter) )
            $this->setFilter($a_filter);
        
        /*if( is_array($a_filter) )
        {
            $this->setFilter($a_filter);
        }
        else 
        {
            $keys = $this->getKeys();

            if( is_array($keys) )
            {
                $t_filter[] = $this->getKeyValue($keys, $a_filter);
            }
            else 
            {
                $t_filter[] = array($keys => $a_filter);
            }
            
            $this->setFilter($t_filter);
        }*/
        
        $sql .= $this->getFilter();
        
        $sql .= $this->getSort();
        
        $a_result = $this->db->query($sql)->row_array();
        
        #reset query
        $this->resetCondition();
        
        #log query
        $this->setLogQuery($sql);
        
        return $a_result;
    }
    
    /**
    * Get pair data key and values
    *
    * @param Array $filter
    * @return Array Result of Active Record
    */
    public function getPair($a_filter = array(), $key = "", $value = "")
    {
        $a_data = $this->getList($a_filter);

        if( empty($key) )
        {
            if( is_array($this->keys) ) 
            {
                $key = $this->keys[0];
            }
            else {
                $key = $this->keys;
            }
        }

        if( empty($value) )
        {
            if( is_array($this->values) ) 
            {
                $value = $this->values[0];
            }
            else {
                $value = $this->values;
            }
        }
		
        foreach( $a_data as $row )
        {
            $a_result[$row[$key]] = $row[$value];
        }
        
        return $a_result;   
    }
    
    /**
    * Get common list data all without pagination
    *
    * @param Array $filter                                             
    * @param String $sort                                            
    * @param String $sql (override sql query)                                            
    * @return Array Result of Active Record
    */
    public function getList($a_sort = '', $sql = '') 
    {
        //set filter
        if( !empty($a_filter) )
            $this->setFilter($a_filter);
            
        //set filter
        if( !empty($a_sort) )
            $this->setSort($a_sort);
        
        if( empty($sql) )
        {
            #call base query
            $sql  = $this->getBaseQuery() . ' ';
        }

        #call filter
        $sql .= $this->getFilter() . ' ';
        #call sorting
        $sql .= $this->getSort() . ' ';
        
        $a_result = $this->db->query($sql)->result_array();
        
        #reset query
        $this->resetCondition();
        
        #log query
        $this->setLogQuery($sql);
        
        return $a_result;    
    }
    
    /**
    * Get list data all with pagination
    *
    * @param Array $filter
    * @return Array Result of Active Record
    */
    public function getListPager($a_sort = NULL, $limit = NULL, $offset = NULL)
    {
        $a_data = array();
        $a_total = array();
        
        #get generated sql base query
        $base_sql = $this->getBaseQuery() .' ';

        #set filter
        if( !empty($a_filter) )
            $this->setFilter($a_filter);
            
        #set sort
        if( !empty($sort) )
            $this->setSort($a_sort);
        
        #set limit    
        if( !empty($limit) and !empty($offset) )
            $this->setLimit($limit, $offset);
        
        #get generated sql clausa        
        $base_sql .= $this->getFilter();
        
        #get generated sql order
        $base_sql .= $this->getSort();
        
        #get generated sql limit
        $limit = $this->getLimit();

        $sql = "select * from ( ". $base_sql ." ) x " . $limit;

        #get base total record
        $a_total = $this->db->query($base_sql)->num_rows();
        
        #get data
        $a_data = $this->db->query($sql)->result_array();

        #reset query
        $this->resetCondition();
        
        #log query
        $this->setLogQuery($sql);
        
        #combine result        
        $a_return['data'] = $a_data;                
        $a_return['total'] = $a_total; 
        
        return $a_return;               
    }

	/**
	 * Insert data into table
     * 
     * @param Array $data
     * @param Bool $is_returning_key
	 */
	public function insert($data, $is_returning_key = TRUE)
	{
        $keys       = $this->getKeys();
        $a_kolom    = $this->getFields();

        foreach( $data as $key => $value ){
            if( in_array($key, $a_kolom) )
                $this->db->set($key, $value);
        }

        if ( in_array('t_insertuser', $a_kolom) )
            $this->db->set('t_insertuser', getUserName());
        if ( in_array('t_inserttime', $a_kolom) )
            $this->db->set('t_inserttime', date('Y-m-d H:i'));
        if ( in_array('t_insertip', $a_kolom) )
            $this->db->set('t_insertip', $_SERVER['REMOTE_ADDR']);
        if ( in_array('t_insertact', $a_kolom) )
            $this->db->set('t_insertact', $this->uri->uri_string());

        $sql = $this->db->get_compiled_insert($this->getTable());
        
        if( $is_returning_key )
            $sql .= " returning " . $this->getKeys();
            
        #log query
        $this->setLogQuery($sql);
        
        $status = $this->db->query($sql);
        
        if( $status )
        {
            $poststatus   = 1;
            $postmessage  = lang('db_insert_success');
            $postdata     = NULL;
        }
        else
        {
            $poststatus   = 0;
            $postmessage  = lang('db_insert_error');
            $postdata     = NULL;    
        }
        
        return array($poststatus, $postmessage, $postdata);              
	}
    
    /**
     * Insert data from definedly column
     * 
     * @param Array $kolom
     * @param Array $data
     */
    function insertRecord($kolom, $data)
    {
    }

	/**
	 * Delete data from table
	 * 
	 * @param Array $a_filter
     * @return Array
	 */
	function delete($a_filter)
	{
        if( !empty($a_filter) )
            $this->setFilter($a_filter);
        
        $sql = "delete from " . $this->getTable() . " ";
        $sql.= $this->getFilter();
        
        $status = $this->db->query($sql);
        
        #reset query
        $this->resetCondition();
        
        #log query
        $this->setLogQuery($sql); 
        
        if( $status )
        {
            $poststatus   = 1;
            $postmessage  = lang('db_delete_success');
            $postdata     = NULL;
        }
        else
        {
            $poststatus   = 0;
            $postmessage  = lang('db_delete_error');
            $postdata     = NULL;    
        }
        
        return array($poststatus, $postmessage, $postdata);   
	}
    
    /**
    * Update data from table
    *
    * @param Array $data 
    * @param Array $a_filter
    * @return Array 
    */              
    public function update($data, $a_filter = NULL) 
    {
        $a_kolom = $this->getFields();
        
        if( !empty($a_filter) )
            $this->setFilter($a_filter);
        
        foreach($data as $key => $value)  {
            if( in_array($key, $a_kolom) ) 
                $this->db->set($key, $value);
        }
        
        if ( in_array('t_updateuser', $a_kolom) )
            $this->db->set('t_updateuser', getUserName());
        if ( in_array('t_updatetime', $a_kolom) )
            $this->db->set('t_updatetime', date('Y-m-d H:i'));
        if ( in_array('t_updateip', $a_kolom) )
            $this->db->set('t_updateip', $_SERVER['REMOTE_ADDR']);
        if ( in_array('t_updateact', $a_kolom) )
            $this->db->set('t_updateact', $this->uri->uri_string());
            
        $sql = $this->db->get_compiled_update($this->getTable()) . ' ';
        $sql.= $this->getFilter();

        $status = $this->db->query($sql);

        #reset query
        $this->resetCondition();
        
        #log query
        $this->setLogQuery($sql);
        
        if( $status )
        {
            $poststatus   = 1;
            $postmessage  = lang('db_update_success');
            $postdata     = NULL;
        }
        else
        {
            $poststatus   = 0;
            $postmessage  = lang('db_update_error');
            $postdata     = NULL;    
        }
        
        return array($poststatus, $postmessage, $postdata);    
    }

	/**
	 * Save log query
	 *
	 * @param String sql
	 */
	protected function setLogQuery($sql)
	{
        $dbdriver   = strtoupper($this->db->dbdriver);
        $module     = strtoupper($this->referer->module);
		$class      = strtoupper(get_class($this->referer));
        
        $_SESSION[$module][$class]['LOG']['SQLLOG'][] = $dbdriver . ' : ' . $sql;
	}

    /**
    * Reset query condition/clausa
    *
    * @return void 
    */
	protected function resetCondition()
	{
        $this->filter  = array();
        $this->sort    = array();
        
        $this->db->_reset_select();
        
        return $this;
	}
}
?>