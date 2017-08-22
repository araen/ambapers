<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_group extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'groups';
    protected $keys     = 'id';
    protected $values   = 'name';
    
    public function __construct() 
    {
        parent::__construct();
    }
}

?>
