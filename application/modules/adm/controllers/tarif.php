<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_tarif";
    
    protected $pagetitle    = "Tarif Muatan";

	public function lst($page = 1)
	{
		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

		$this->data['a_kolom'][] = array('kolom' => 'jenis_muatan', 'label' => 'JENIS MUATAN');
		$this->data['a_kolom'][] = array('kolom' => 'satuan', 'label' => 'SATUAN');
		$this->data['a_kolom'][] = array('kolom' => 'tarif_usd', 'label' => 'TARIF USD');
        $this->data['a_kolom'][] = array('kolom' => 'tarif_idr', 'label' => 'TARIF IDR');

        parent::initView('list_master');
        parent::lst($page);
	}
}
