<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends BASE_Controller {

	#package module
	public $module          = "adm";
    #dependency model
    protected $model        = "model_user";
    
    protected $pagetitle    = "Dashboard";

	public function lst($page = 1)
	{
		$this->data['pagetitle'] 	= $this->pagetitle;
		$this->data['subpagetitle'] = $this->pagetitle;

        parent::initView('dashboard');
        parent::lst($page);
	}
}
