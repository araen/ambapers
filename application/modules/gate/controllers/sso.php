<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SSO extends BASE_Controller {

	#package module
	public $module      = "gate";
    #dependency model
    protected $model    = "model_user";
    #default check authentication
    protected $isauth   = FALSE;

    /**
    * @Override
    */
	public function lst($page = 1)
	{
        #helper
        $this->load->helper('cookie');
        
        #depedency model
        $this->loadModel('model_menuadmin');

        $post = $this->input->post();

        if( $post )
        {
            if( empty($post['username']) or empty($post['password']) )
            {
                $this->data['alert'] = lang('userpass_null');       
            }
            else 
            {
                list($poststatus, $postmessage, $postdata) = $this->model->login($post['username'], $post['password']);
            
                #login failed
                if( !$poststatus )
                {
                    $this->data['alert'] = $postmessage;
                }
                #login success
                else
                {
                    #remember cookie
                    if( $post['rememberme'] )
                    {
                        $cookietoken = encryptUrl($postdata['iduser'] . '_' . $postdata['username'] . '_' . $postdata['namauser']);
                        
                        $status = setcookie('login', $cookietoken, time() + (86400 * 30), "/");
                    }
                    
                    #set basic auth
                    $token['islogin']   = TRUE;
                    $token['referer']   = $this->class;
                    $token['id']        = $postdata['id'];
                    $token['username']  = $postdata['username'];
                    $token['name']      = $postdata['name'];
                    $token['id_group']  = $postdata['id_group'];
                    $token['logintime'] = time();
                    
                    $this->auth->setToken(setJSON($token));

                    #set menu
                    $menu = $this->menuadmin->getMenu();
                    
                    $this->auth->setMenu(setJSON($menu));

                    redirect(base_url('adm/home'));
                }
            }
        }
        
        parent::initView('login', 'login');
        parent::lst($page);
	}
    
    /**
    * Logout from SESSION
    */
    public function logout()
    {
        #destroy session
        session_destroy();
        session_unset();
        
        #destroy cookie
        unset($_COOKIE['login']);
        setcookie('login', null, -1, '/');
        
        redirect(base_url('gate/sso'));
    }
}
