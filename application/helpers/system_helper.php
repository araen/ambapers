<?php

    function base_app() {
        $ci = & get_instance();
        return $ci->config->item('base_app');
    }
    
    function base_assets() {
        $ci = & get_instance();
        return $ci->config->item('base_assets');
    }

    function base_module() {
        $ci = & get_instance();
        return $ci->config->item('base_module');
    }

    function encryptUrl($string) {
        $ci = & get_instance();
        $key = $ci->config->item('encryption_key');

        for( $i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char) + ord($keychar));

            $test[$char] = ord($char)+ord($keychar);
            $result .= $char;
        }

       return urlencode(base64_encode($result));
    }

    function decryptUrl($string) {
        $ci = & get_instance();
        $key = $ci->config->item('encryption_key');
        
        $string = base64_decode(urldecode($string));
        for( $i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result .= $char;
        }
        
        return $result;
    }

    function getKeyValue($key, $row, $separator = '_') {
        $separator = empty($separator) ? '_' : $separator;
        
        $a_key = explode($separator, $key);
        
        $s_key = '';
        foreach ( $a_key as $val )
            $s_key[] = $row[strtolower($val)];
            
        return implode($separator, $s_key);
    }

    function getCondition($key, $value, $separator = '_') {
        $result = array();
        
        $a_key = explode($separator, $key);
        $a_value = explode($separator, $value);
        
        if( is_array($a_key) ) {
            for ( $i = 0; $i < count($key); $i++ )
                $result[$a_key[$i]] = $a_value[$i];
        }   
        else {
            $result[$key] = $value;        
        }
        
        return $result;  
    }

    function getJSON($data) {
        return json_decode($data, true);    
    }

    function setJSON($data) {
        return json_encode($data);
    }

    function getDataPost($kolom, $post, $prefix = null) {
        $record = array();
        
        foreach ( $kolom as $row) {
            if(!$row['readonly'])
                $record[$row['kolom']] = !is_null($prefix) ? $post[$prefix . '_' . $row['kolom']] : $post[$row['kolom']];
        }
            
        return $record;
    }

    /**
    * =====================
    * Used to file function
    * ===================== 
    */
    function uploadfile($path, $files, $upname) {
        $ci = & get_instance();
        
        if ($files[$upname]['error'] == 0) 
        {
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xls|xlsx';
            
            $ci->load->library('upload', $config);
            
            if ( ! $ci->upload->do_upload($upname) ) 
            {
                debug($ci->upload->display_errors());    
            } 
            else 
            {
                $data = $ci->upload->data();
                
                return $data;
            }
        }    
    }

    function excelreader($file) {
        $ci = & get_instance();
        $ci->load->library('phpexcel');
        $ci->load->library('phpexcel/iofactory');
        
        try {
            $inputFileType = IOFactory::identify($file['full_path']);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file['full_path']);
        } 
        catch(Exception $e) 
        {
            die('Error loading file '.$file['file_name'].' : '.$e->getMessage());
        }
        
        $sheet = $objPHPExcel->getSheet(0)->toArray(null,true,true,true); ;

        return $sheet;    
    }
