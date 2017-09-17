<?php
class Model_dashboard extends CI_Model {
	
    function Model_article()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_count_user(){
		$this->load->database();
			
			$total = 0;
			$sql = "SELECT COUNT(*) total FROM users;";
			$query = $this->db->query($sql);
			
			foreach($query->result_array() as $row){
				$total = $row['total'];
			}
		$this->db->close();
		
		return $total;
	}
	
	function get_count_post(){
		$this->load->database();
			
			$total = 0;
			$sql = "SELECT COUNT(*) total FROM articles;";
			$query = $this->db->query($sql);
			
			foreach($query->result_array() as $row){
				$total = $row['total'];
			}
		$this->db->close();
		
		return $total;
	}
	
	function get_count_page(){
		$this->load->database();
			
			$total = 0;
			$sql = "SELECT COUNT(*) total FROM menus;";
			$query = $this->db->query($sql);
			
			foreach($query->result_array() as $row){
				$total = $row['total'];
			}
		$this->db->close();
		
		return $total;
	}
	
	function get_count_category(){
		$this->load->database();
			
			$total = 0;
			$sql = "SELECT COUNT(*) total FROM categories;";
			$query = $this->db->query($sql);
			
			foreach($query->result_array() as $row){
				$total = $row['total'];
			}
		$this->db->close();
		
		return $total;
	}
	
	function get_count_comment(){
		$this->load->database();
			
			$total = 0;
			$sql = "SELECT COUNT(*) total FROM comments;";
			$query = $this->db->query($sql);
			
			foreach($query->result_array() as $row){
				$total = $row['total'];
			}
		$this->db->close();
		
		return $total;
	}
	
	function get_count_view(){
		$this->load->database();
			
			$total = 0;
			$sql = "SELECT SUM(`read`) total FROM articles;";
			$query = $this->db->query($sql);
			
			foreach($query->result_array() as $row){
				$total = $row['total'];
			}
		$this->db->close();
		
		return $total;
	}
}
?>