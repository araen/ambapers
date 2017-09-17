<?php
class Model_user extends CI_Model {
	
    function Model_User()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function login($user,$pass){
		$this->load->database();
						
		$sql = "SELECT * FROM users WHERE username='$user' and password=md5('$pass') AND active='yes';";
		$query = $this->db->query($sql);
		
		$this->db->close();
		
		foreach($query->result() as $row){
			$data = array(
				'login'		=> TRUE,
				'id_user'	=> $row->id,
				'name'		=> $row->name,
				'username'	=> $row->username,
			);
			$this->session->set_userdata($data);
			$sql = "UPDATE users SET online='yes' WHERE username='$user' and password=md5('$pass') AND active='yes';";
			$this->db->query($sql);
			
			return true;
		}		
		return false;
	}
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM users WHERE id='$id';";
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
			$fields = $this->db->list_fields('users');
			foreach ($fields as $field){
			   $filter .= " $field LIKE '%$q%' OR" ;
			}
			$filter = rtrim($filter,'OR').")";
		}

		$sql = "SELECT users.*, groups.name `group` FROM users LEFT JOIN groups ON id_group=groups.id $filter ORDER BY id ASC LIMIT $page,$limit;";
		$query['data'] = $this->db->query($sql);
		
		$sql = "SELECT users.*, groups.name `group` FROM users LEFT JOIN groups ON id_group=groups.id $filter";
		$query['count'] = $this->db->query($sql);
		$this->db->close();
		
		return $query;
	}
    
	function add($user){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('users',$user);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}

	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('users',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM users WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
}
?>