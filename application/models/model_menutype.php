<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_menutype extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'menu_types';
    protected $keys     = 'id';
    
    public function __construct() 
    {
        parent::__construct();
    }
}

?>
