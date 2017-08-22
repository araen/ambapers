<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_category";
    
    protected $pagetitle    = "Kategori";

	public function lst($page = 1)
	{
		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

		$this->data['a_kolom'][] = array('kolom' => 'name', 'label' => 'KATEGORI');
		$this->data['a_kolom'][] = array('kolom' => 'permalink', 'label' => 'PERMALINK');
		$this->data['a_kolom'][] = array('kolom' => 'published', 'label' => 'PUBLISED', 'type' => 'S', 'option' => array('yes' => 'Ya', 'no' => 'Tidak'));
        
        parent::initView('list_master');
        parent::lst($page);
	}
}
