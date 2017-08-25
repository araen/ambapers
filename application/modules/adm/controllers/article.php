<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_article";
    
    protected $pagetitle    = "Artikel";

	public function lst($page = 0)
	{
		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

		$this->data['a_kolom'][] = array('kolom' => 'created', 'label' => 'TANGGAL', 'format' => 'dateToIndo');
		$this->data['a_kolom'][] = array('kolom' => 'title', 'label' => 'JUDUL');
		$this->data['a_kolom'][] = array('kolom' => 'published', 'label' => 'PUBLISED', 'type' => 'S', 'option' => array('yes' => 'Ya', 'no' => 'Tidak'));
        
        parent::lst($page);
	}

	protected function detailSet()
	{
		$this->data['a_kolom'][] = array('kolom' => 'title', 'label' => 'Judul');
		$this->data['a_kolom'][] = array('kolom' => 'description', 'label' => 'Meta Description');		
		$this->data['a_kolom'][] = array('kolom' => 'keyword', 'label' => 'Meta Tag');
		$this->data['a_kolom'][] = array('kolom' => 'content', 'label' => 'Konten', 'type' => 'A');
		$this->data['a_kolom'][] = array('kolom' => 'category', 'label' => 'Kategori');
	}

	public function detail($values)
	{
		$this->detailSet($values);

		parent::initView('data_article');
		parent::detail($values);
	}

	public function edit($values)
	{
		$this->detailSet($values);

		parent::initView('data_article');
		parent::edit($values);
	}
}
