<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pajak extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'sys_user';
    protected $keys     = 'kode';

    private $graburl    = '';

    public $pajak        = array();
    
    public function __construct() 
    {
        parent::__construct();

        $this->graburl  = base_url('grab/pajak.php');
        $this->pajak    = getJSON(file_get_contents($this->graburl));

        ksort($this->pajak);
    }
    
    public function getList() 
    {
        $i       = 0;
        $a_data  = array();

        if( $this->pajak )
        {
            foreach( $this->pajak as $key => $value )
            {
                $a_data[$i]['kode']     = $key;
                $a_data[$i]['nominal']  = $value;

                $i++;
            }
        }

        return $a_data;
    }
}

?>
