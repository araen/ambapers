<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_menutype";
    
    protected $pagetitle    = "Pengguna";

	public function __construct() 
	{
		parent::__construct();
	}

	public function lst($page = 0)
	{
		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

		$this->data['a_kolom'][] = array('kolom' => 'title', 'label' => 'JUDUL');
		$this->data['a_kolom'][] = array('kolom' => 'menutype', 'label' => 'TIPE');
		$this->data['a_kolom'][] = array('kolom' => 'description', 'label' => 'DESKRIPSI');

		parent::initView('list_menu');
        parent::lst($page);
	}

	public function detail($value = 0)
	{
		$this->loadModel('model_menu');

		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

		$this->data['a_kolom'][] = array('kolom' => 'name', 'label' => 'JUDUL');
		$this->data['a_kolom'][] = array('kolom' => 'menutype', 'label' => 'TIPE');
		$this->data['a_kolom'][] = array('kolom' => 'link', 'label' => 'LINK');
		$this->data['a_kolom'][] = array('kolom' => 'ordered', 'label' => 'ORDER');
		$this->data['a_kolom'][] = array('kolom' => 'publiced', 'label' => 'PUBLISH', 'type' => 'S', 'option' => array('yes' => 'Ya', 'no' => 'Tidak'));

		$menutype = $this->model->getData($value);
		$this->data['a_data'] = $this->menu->getMenu($menutype['menutype']);

		debug($this->data['a_data']);

		$this->initView('data_menu');
        $this->build();
	}
}