<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_article extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'articles';
    protected $keys     = 'id';
    
    public function __construct() 
    {
        parent::__construct();
    }
}

?>
