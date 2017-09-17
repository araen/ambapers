<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends BASE_Controller {

	#package module
	public $module          = "web";
    #dependency model
    protected $model        = "model_user";
    
    protected $pagetitle    = "Dashboard";

    protected $isauth		= FALSE;

    public function __construct()
    {
    	$this->load->model('model_auth', 'auth');

		$this->data['menu'] = $this->auth->get_menu('mainmenu');
    }

	public function index()
	{
		#dependency model
		$this->load->model('model_auth', 'auth');

		$data['menu'] = $this->auth->get_menu('mainmenu');

        $this->load->view('index', $this->data);
	}

	public function article($link='')
	{
		$this->load->model('model_article');
		$this->load->model('model_comment');
		$this->load->model('model_hit');
		
		if(isset($_POST['comment_act'])){
			$data = $_POST['data'];
			$data['content'] = htmlspecialchars($data['content'], ENT_QUOTES);;
			$data['id_parent'] = 0;
			$data['id_author'] = $this->session->userdata('id_user');
			$data['author_ip'] = $_SERVER['REMOTE_ADDR'];
			$data['is_spam'] = 'no';
			$data['published'] = 'yes';
			$data['created'] = date('Y-m-d H:i:s');
			$data['modified'] = date('Y-m-d H:i:s');
			
			$this->model_comment->add($data);
		}
		unset($data);
		$this->data['article']= $this->model_article->get_by_link($link,'yes');

		$this->load->view('index', $this->data);
	}
}
