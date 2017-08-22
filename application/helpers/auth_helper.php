<?php

    function getIdUser()
    {
        $ci = & get_instance();
        
        return $ci->auth->getIdUser();
    }
    
    function getUserName()
    {
        $ci = & get_instance();
        
        return $ci->auth->getUserName();
    }
    
    function getNamaUser()
    {
        $ci = & get_instance();
        
        return $ci->auth->getNamaUser();
    }

    function getMenu()
    {
        $ci = & get_instance();
        
        return $ci->auth->getMenu(3);
    }
    
?>