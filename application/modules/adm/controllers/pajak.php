<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pajak extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_pajak";
    
    protected $pagetitle    = "Pajak";

	public function lst($page = 1)
	{
		#dictionary
		$a_curr = strCurrency();
		
		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = "Kurs Pajak " . dateIndo(date('Y-m-d'), TRUE);;

		$this->data['a_kolom'][] = array('kolom' => 'kode', 'label' => 'KODE');
		$this->data['a_kolom'][] = array('kolom' => 'kode', 'label' => 'NAMA', 'type' => 'S', 'option' => $a_curr);
		$this->data['a_kolom'][] = array('kolom' => 'nominal', 'label' => 'NOMINAL', 'type' => 'N', 'format' => 'strNumber');

        parent::initView('list_master');
        parent::lst($page);
	}
}
