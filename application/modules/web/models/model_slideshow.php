<?php
class Model_slideshow extends CI_Model {
	
    function Model_slideshow()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM slideshow WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function get_slide(){
		$this->load->database();					
		$sql = "SELECT * FROM slideshow ORDER BY `order` ASC;";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}
	
	function add($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('slideshow',$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('slideshow',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM slideshow WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	} 
}
?>