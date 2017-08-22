<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
    /**
    * Token variable
    */
    private $token = '';
    
    /**
    * Constructor
    * 
    * @return void
    */
    public function Auth()
    {
        $this->token = $this->getToken(3);    
    }
    
    /**
    * Setting token and save into session
    *
    * @param String $token
    */
    public function setToken($token)
    {
        $_SESSION['TOKEN'] = encryptUrl($token);
    }
    
    /**
    * getting token from session
    *
    * @param Int $INT_MODE
    */
    public function getToken($INT_MODE = 1)
    {
        if( $_SESSION['TOKEN'] )
        {
            switch( $INT_MODE )
            {
                #return as encrypted
                case 1 :
                    $token = $_SESSION['TOKEN'];
                break;
                #return as decrypted/JSON 
                case 2 :
                    $token = decryptUrl($_SESSION['TOKEN']);
                break;
                #return as array
                case 3 :
                    $token = getJSON(decryptUrl($_SESSION['TOKEN']));
                break;
            } 
            
            return $token;       
        }
        else 
        {
            return false;
        }
    }
    
    /**
    * Set accessed active SIM
    *
    * @param String $sim
    * @return void
    */
    public function setSIM($sim)
    {
        $_SESSION['SIM'] = $sim;
    }
    
    /**
    * Get accessed active SIM
    *
    * @return String
    */
    public function getSIM()
    {
        return $_SESSION['SIM'];
    }

    /**
    * Setting menu and save into session
    *
    * @param String $token
    */
    public function setMenu($menu)
    {
        $_SESSION['MENU'] = encryptUrl($menu);
    }

    /**
    * getting menu from session
    *
    * @param Int $INT_MODE
    */
    public function getMenu($INT_MODE = 1)
    {
        if( $_SESSION['MENU'] )
        {
            switch( $INT_MODE )
            {
                #return as encrypted
                case 1 :
                    $token = $_SESSION['MENU'];
                break;
                #return as decrypted/JSON 
                case 2 :
                    $token = decryptUrl($_SESSION['MENU']);
                break;
                #return as array
                case 3 :
                    $token = getJSON(decryptUrl($_SESSION['MENU']));
                break;
            } 
            
            return $token;       
        }
        else 
        {
            return false;
        }
    }
    
    /**
    * Get credential Id User
    *
    * @return Int
    */
    public function getIdUser()
    {
        $token = $this->getToken(3);
        
        return $token['id'];
    }
    
    /**
    * Get credential Username
    *
    * @return String
    */
    public function getUserName()
    {
        $token = $this->getToken(3);
        
        return $token['username'];
    }
    
    /**
    * Get credential Nama User
    *
    * @return String
    */
    public function getNamaUser()
    {
        $token = $this->getToken(3);
        
        return $token['name'];
    }
}