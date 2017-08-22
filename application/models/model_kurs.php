<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_kurs extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'sys_user';
    protected $keys     = 'kode';

    private $graburl    = '';

    public $kurs        = array();
    
    #construktor
    public function __construct() 
    {
        parent::__construct();

        $this->graburl  = base_url('grab/bi.php');
        $this->kurs     = getJSON(file_get_contents($this->graburl));

        ksort($this->kurs);
    }
    
    public function getList() 
    {
        $i       = 0;
        $a_data  = array();

        if( $this->kurs )
        {
            foreach( $this->kurs as $key => $value )
            {
                $a_data[$i]['kode']     = $key;
                $a_data[$i]['hbeli']    = $value[1];
                $a_data[$i]['hjual']    = $value[2];

                $i++;
            }
        }

        return $a_data;
    }
}

?>
