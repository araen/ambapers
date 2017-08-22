<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'users';
    protected $keys     = 'id';
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function login($username, $password) 
    {
        $a_filter[] = array('lower(username)', $username);
        $a_filter[] = array('active', 'yes');
        
        $row = $this->getData($a_filter);

        if ( $row ) 
        {
            if ( $row['password'] == md5($password) ) 
            {
                $log['lastlogintime'] = date('Y-m-d G:i:s');
                $log['lastloginip'] = $this->input->ip_address();

                //list($poststatus, $postmessage, $postdata) = $this->update($log, $row['ID']);
                $poststatus = TRUE;
            }
            else { 
                $poststatus     = 0;
                $postmessage    = lang('password_failed');
            }
        } 
        else {
            $poststatus     = 0;
            $postmessage    = lang('user_not_found');
        }

        return array($poststatus, $postmessage, $row);
    }
}

?>
