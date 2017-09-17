<?php
class Model_galery extends CI_Model {
	
	private $table_album="galery_albums";
	private $table_photo="galery_photos";
	
    function Model_galery()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_album($publised=''){
		$filter='';
		if($publised != ''){
			$filter="WHERE {$this->table_album}.published='$publised'";
		}
		
		$this->load->database();					
		$sql = "SELECT {$this->table_album}.*, {$this->table_photo}.image_url FROM {$this->table_album} LEFT JOIN {$this->table_photo} ON {$this->table_album}.id={$this->table_photo}.id_album $filter GROUP BY {$this->table_album}.id ORDER BY {$this->table_album}.created DESC;";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}
	
	function get_album_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM {$this->table_album} WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function add_album($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert($this->table_album,$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit_album($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update($this->table_album,$data);
		$this->db->close();
	}
	
	function delete_album($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM {$this->table_album} WHERE id='$id'");
			$this->db->query("DELETE FROM {$this->table_photo} WHERE id_album='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function get_photo($id_album=0,$published=''){
		$filter='';
		if($published != ''){
			$filter="AND {$this->table_photo}.published='$published'";
		}
		
		$this->load->database();					
		$sql = "SELECT {$this->table_photo}.* FROM {$this->table_photo} WHERE id_album='$id_album' $filter ORDER BY created DESC;";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}
	
	function get_photo_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM {$this->table_photo} WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function add_photo($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert($this->table_photo,$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit_photo($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update($this->table_photo,$data);
		$this->db->close();
	}
	
	function delete_photo($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM {$this->table_photo} WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	} 
}
?>