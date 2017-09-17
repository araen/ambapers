<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_menutype";
    
    protected $pagetitle    = "Menu";

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

	public function listdetail($value = 0)
	{
		$this->loadModel('model_menu');

		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

		$this->data['a_kolom'][] = array('kolom' => 'name', 'label' => 'JUDUL');
		$this->data['a_kolom'][] = array('kolom' => 'menutype', 'label' => 'TIPE');
		$this->data['a_kolom'][] = array('kolom' => 'link', 'label' => 'LINK');
		$this->data['a_kolom'][] = array('kolom' => 'ordered', 'label' => 'ORDER');
		$this->data['a_kolom'][] = array('kolom' => 'publiced', 'label' => 'PUBLISH', 'type' => 'S', 'option' => array('yes' => 'Ya', 'no' => 'Tidak'));

		$this->data['l_kolom'][] = array('kolom' => 'name', 'label' => 'NAMA MENU');
		$this->data['l_kolom'][] = array('kolom' => 'order', 'label' => 'ORDER');
		$this->data['l_kolom'][] = array('kolom' => 'type', 'label' => 'TIPE');
		$this->data['l_kolom'][] = array('kolom' => 'link', 'label' => 'LINK');
		$this->data['l_kolom'][] = array('kolom' => 'publiced', 'label' => 'PUBLISH', 'type' => 'S', 'option' => array('yes' => 'Ya', 'no' => 'Tidak'));

		$menutype = $this->model->getData($value);
		$this->data['a_data'] = $this->menu->getMenu($menutype['menutype']);

		$this->initView('data_menu');
        $this->build();
	}
}