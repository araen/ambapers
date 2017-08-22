<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_article";
    
    protected $pagetitle    = "Artikel";

	public function lst($page = 1)
	{
		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

		$this->data['a_kolom'][] = array('kolom' => 'created', 'label' => 'TANGGAL', 'format' => 'dateToIndo');
		$this->data['a_kolom'][] = array('kolom' => 'title', 'label' => 'JUDUL');
		$this->data['a_kolom'][] = array('kolom' => 'published', 'label' => 'PUBLISED', 'type' => 'S', 'option' => array('yes' => 'Ya', 'no' => 'Tidak'));
        
        parent::lst($page);
	}
}
