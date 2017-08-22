<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_category extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'categories';
    protected $keys     = 'id';
    
    public function __construct() 
    {
        parent::__construct();
    }
}

?>
