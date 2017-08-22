<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_user";
    
    protected $pagetitle    = "Pengguna";

	public function __construct() 
	{
		parent::__construct();

		$this->loadModel('model_group');

		$this->data['group'] = $this->group->getPair();
	}

	public function lst($page = 0)
	{
		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

		$this->data['a_kolom'][] = array('kolom' => 'name', 'label' => 'NAMA');
		$this->data['a_kolom'][] = array('kolom' => 'email', 'label' => 'EMAIL');
		$this->data['a_kolom'][] = array('kolom' => 'id_group', 'label' => 'GROUP', 'type' => 'S', 'option' => $this->data['group']);
		$this->data['a_kolom'][] = array('kolom' => 'active', 'label' => 'ACTIVE', 'type' => 'S', 'option' => array('yes' => 'Ya', 'no' => 'Tidak'));

        parent::lst($page);
	}

	function detailSet($value)
	{
		$this->data['a_kolom'][] = array('kolom' => 'name', 'label' => 'NAMA');
		$this->data['a_kolom'][] = array('kolom' => 'username', 'label' => 'Username');
		$this->data['a_kolom'][] = array('kolom' => 'newpassword', 'label' => 'Password');
		$this->data['a_kolom'][] = array('kolom' => 'confirmpassword', 'label' => 'Confirm Password');
		$this->data['a_kolom'][] = array('kolom' => 'email', 'label' => 'EMAIL');
		$this->data['a_kolom'][] = array('kolom' => 'id_group', 'label' => 'GROUP', 'type' => 'S', 'option' => $this->data['group']);
		$this->data['a_kolom'][] = array('kolom' => 'active', 'label' => 'ACTIVE', 'type' => 'S', 'option' => array('yes' => 'Ya', 'no' => 'Tidak'));
	}

	function detail($value) 
	{
		$this->detailSet($value);
		parent::detail($value);
	}

	function edit($value) 
	{
		$this->detailSet($value);

		$post = $this->input->post();

		if( $post )
		{
			$record = getDataPost($this->data['a_kolom'], $post);

			if( !empty($record['newpassword']) and $record['newpassword'] == $record['confirmpassword'] )
				$record['password'] = md5($record['newpassword']);
			else
				redirect(base_url($this->pageurl. "/edit/$value"));

			list($poststatus, $postmessage, $postdata) = $this->model->update($record, $value);
		}

		parent::edit($value);
	}
}