<?php
class Model_randomimage extends CI_Model {
	
    function Model_randomimage()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM randomimage WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function get_slide(){
		$this->load->database();					
		$sql = "SELECT * FROM randomimage ORDER BY `id` ASC;";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}
	
	function add($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('randomimage',$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('randomimage',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM randomimage WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	} 
}
?>