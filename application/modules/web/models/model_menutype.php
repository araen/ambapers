<?php
class Model_menutype extends CI_Model {
	
    function Model_menutype()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM menu_types WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function get_menu($menutype=''){
		$this->load->database();					
		$sql = "SELECT * FROM menu_types ORDER BY `id` ASC;";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}
	
	function add($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('menu_types',$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('menu_types',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM menu_types WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	} 
}
?>