<?php
class Model_category extends CI_Model {
	
    function Model_category()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM categories WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function get_all($page=0,$limit=20, $q=''){
		$this->load->database();
		$filter='';
		$page = $page*$limit;
		if($q != ''){
			$filter = " WHERE (";
			$fields = $this->db->list_fields('categories');
			foreach ($fields as $field){
			   $filter .= " $field LIKE '%$q%' OR" ;
			}
			$filter = rtrim($filter,'OR').")";
		}

		$sql = "SELECT * FROM categories $filter ORDER BY id ASC LIMIT $page,$limit;";
		$query['data'] = $this->db->query($sql);
		
		$sql = "SELECT * FROM categories $filter";
		$query['count'] = $this->db->query($sql);
		$this->db->close();
		
		return $query;
	}
    
	function add($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('categories',$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('categories',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM categories WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
}
?>