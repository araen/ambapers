<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_tarif extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'tarif';
    protected $keys     = 'id';
    
    public function __construct() 
    {
        parent::__construct();
    }
}

?>
