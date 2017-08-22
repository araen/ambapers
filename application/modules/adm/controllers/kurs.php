<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurs extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_kurs";
    
    protected $pagetitle    = "Kurs";

	public function lst($page = 1)
	{
		#dictionary
		$a_curr = strCurrency();

		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle . " Bank Indonesia " . dateIndo(date('Y-m-d'), TRUE);

		$this->data['a_kolom'][] = array('kolom' => 'kode', 'label' => 'KODE');
		$this->data['a_kolom'][] = array('kolom' => 'kode', 'label' => 'NAMA', 'type' => 'S', 'option' => $a_curr);
		$this->data['a_kolom'][] = array('kolom' => 'hbeli', 'label' => 'HARGA BELI', 'type' => 'N', 'format' => 'strNumber');
		$this->data['a_kolom'][] = array('kolom' => 'hjual', 'label' => 'HARGA JUAL', 'type' => 'N', 'format' => 'strNumber');

        parent::initView('list_master');
        parent::lst($page);
	}
}
