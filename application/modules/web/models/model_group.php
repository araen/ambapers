<?php
class Model_group extends CI_Model {
	
    function Model_group()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM groups WHERE id='$id';";
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
			$fields = $this->db->list_fields('groups');
			foreach ($fields as $field){
			   $filter .= " $field LIKE '%$q%' OR" ;
			}
			$filter = rtrim($filter,'OR').")";
		}

		$sql = "SELECT * FROM groups $filter ORDER BY id ASC LIMIT $page,$limit;";
		$query['data'] = $this->db->query($sql);
		
		$sql = "SELECT * FROM groups $filter";
		$query['count'] = $this->db->query($sql);
		$this->db->close();
		
		return $query;
	}
    
	function add($user){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('groups',$user);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}

	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('groups',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM groups WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function get_menu(){
		$this->load->database();					
		$sql = "SELECT * FROM menu_admin WHERE parent='0' ORDER BY `order`;";
		$query = $this->db->query($sql);
		$menu = array();
		foreach($query->result_array() as $row)
		{
			$menu[$row['id']]['data'] = $row;
			$menu[$row['id']]['sub'] = $this->_get_child($row['id']);
		}
		$this->db->close();
		return $menu;
	}
	
	function _get_child($id){
		$this->load->database();					
		$sql = "SELECT * FROM menu_admin WHERE parent='$id' ORDER BY `order`;";
		$query = $this->db->query($sql);		
		$menu = array();
		foreach($query->result_array() as $row)
		{
			$menu[$row['id']]['data'] = $row;
			$menu[$row['id']]['sub'] = $this->_get_child($row['id']);
		}
		$this->db->close();
		return $menu;
	}
}
?>