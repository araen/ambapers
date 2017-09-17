<?php
class Model_filemanager extends CI_Model {
	
	private $path;
	private $type;
	
    function Model_filemanager()
    {
        // Call the Model constructor
        parent::__construct();
		
		$this->path = $this->config->item('path_file');
		$this->type = array('png','gif','jpg','jpeg','doc','docx','pdf','xls','xlsx');
    }
	
	function get_all($dir="data"){
		
		$filetype = array('png','gif','jpg','jpeg');
		// full server path to directory
		$base= $this->path;
			
        $listDir = array(); 
        if($handler = opendir($base.$dir)) { 
            while (($sub = readdir($handler)) !== FALSE) { 
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db" && $sub != "Thumbs.db") { 
                    if(is_file($dir."/".$sub)) {
						$exp = explode(".",$sub);
						if(in_array(strtolower($exp[count($exp)-1]),$filetype))
							$listDir[] = $sub; 
                    }elseif(is_dir($dir."/".$sub)){
						$tmp = $this->get_all($dir."/".$sub);
						foreach($tmp as $img)
							$listDir[] = "$sub/$img";                    } 
                } 
            } 
            closedir($handler); 
        } 
        return $listDir; 
    }
    
    function get_document($dir="data"){
        
        $filetype = array('doc','docx','pdf','xls','xlsx');
        // full server path to directory
        $base= $this->path;
            
        $listDir = array(); 
        if($handler = opendir($base.$dir)) { 
            while (($sub = readdir($handler)) !== FALSE) { 
                if ($sub != "." && $sub != "..") { 
                    if(is_file($dir."/".$sub)) {
                        $exp = explode(".",$sub);
                        if(in_array(strtolower($exp[count($exp)-1]),$filetype))
                            $listDir[] = "<a href=".base_url().$dir."/".$sub.">".strtoupper($sub)."</a>"; 
                    }elseif(is_dir($dir."/".$sub)){
                        $tmp = $this->get_document($dir."/".$sub);
                        foreach($tmp as $doc)
                            //$listDir[] = "$sub/$doc";
                            $listDir[] = "<a href=".base_url().$dir."/".$sub/$doc.">".strtoupper($sub/$doc)."</a>";
                    } 
                } 
            } 
            closedir($handler); 
        } 
        return $listDir;
        //$base= $this->path;  
// 
//        $dh = opendir($base.$dir);
//        $lstfile = array();
//        while (($file = readdir($dh)) !== false) {
//        $lstfile['file']="<a href=\"$dir/$file\">$file</a>";
//        }
//        closedir($dh);
//        return $lstfile; 
    }
	
	function list_dir($dir){
		
		$filetype = $this->type;
		// full server path to directory
		$base= $this->path;

        $listDir = array();
		$folder = array();
		$temp_dir = array();
		$file = array();
		$temp_file = array();
        if($handler = opendir($base.$dir)) { 
            while (($sub = readdir($handler)) !== FALSE) {
				$tmp = array();
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db" && $sub != "Thumbs.db") { 
                    if(is_file($dir."/".$sub)) {
						$exp = explode(".",$sub);
						if(in_array(strtolower($exp[count($exp)-1]),$filetype)){
							$tmp['name'] = $sub;
							$tmp['type'] = 'file';
							$tmp['size'] = filesize($dir."/".$sub);
							$file[] = $tmp;
							$temp_file[] = $sub;
						}
                    }elseif(is_dir($dir."/".$sub)){
						$tmp['name'] = $sub;
						$tmp['type'] = 'dir';
						$tmp['size'] = '';
						$folder[] = $tmp;
						$temp_dir[] = $sub;
					}
					
					//$listDir[] = $tmp;	
                }			
            } 
            closedir($handler); 
        }
		
		array_multisort($temp_dir,$folder);
		array_multisort($temp_file,$file);
		
		foreach($folder as $item)
			$listDir[] = $item;
			
		foreach($file as $item)
			$listDir[] = $item;
		
		// echo "<pre>";
		// var_dump($folder);
		// var_dump($file);
		// var_dump($listDir);
		
        return $listDir; 
    }
	
	function list_image($dir){
		
		$filetype = array('png','gif','jpg','jpeg','ico','bmp');
		// full server path to directory
		$base= $this->path;

        $listDir = array();
		$folder = array();
		$temp_dir = array();
		$file = array();
		$temp_file = array();
        if($handler = opendir($base.$dir)) { 
            while (($sub = readdir($handler)) !== FALSE) {
				$tmp = array();
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db" && $sub != "Thumbs.db") { 
                    if(is_file($dir."/".$sub)) {
						$exp = explode(".",$sub);
						if(in_array(strtolower($exp[count($exp)-1]),$filetype)){
							$tmp['name'] = $sub;
							$tmp['type'] = 'file';
							$tmp['size'] = filesize($dir."/".$sub);
							$file[] = $tmp;
							$temp_file[] = $sub;
						}
                    }elseif(is_dir($dir."/".$sub)){
						$tmp['name'] = $sub;
						$tmp['type'] = 'dir';
						$tmp['size'] = '';
						$folder[] = $tmp;
						$temp_dir[] = $sub;
					}
					
					//$listDir[] = $tmp;	
                }			
            } 
            closedir($handler); 
        }
		
		array_multisort($temp_dir,$folder);
		array_multisort($temp_file,$file);
		
		foreach($folder as $item)
			$listDir[] = $item;
			
		foreach($file as $item)
			$listDir[] = $item;
		
		// echo "<pre>";
		// var_dump($folder);
		// var_dump($file);
		// var_dump($listDir);
		
        return $listDir; 
    }
	
	function create_dir($path,$dir_name){
		$base= $this->path;
		
		mkdir($base.$path.'/'.$dir_name, 0755);
	}
	
	function delete($path,$file){
		$base= $this->path;
		$path = $base.$path.'/'.$file;
		
		if(is_dir($path)){
			$this->rrmdir($path);
		}else if(is_file($path)){
			unlink($path);
		}
	}
	
	function rrmdir($dir) {
	   if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
		   }
		 }
		 reset($objects);
		 rmdir($dir);
	   }
	 }
}
?>