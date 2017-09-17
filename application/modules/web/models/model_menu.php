<?php
class Model_menu extends CI_Model {
	
    function Model_menu()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM menus WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function get_menu($menutype=''){
		$this->load->database();					
		$sql = "SELECT * FROM menus WHERE parent='0' AND menutype='$menutype' ORDER BY `order` ASC;";
		$query = $this->db->query($sql);
		$menu = array();
		foreach($query->result_array() as $row)
		{
			$menu[$row['id']]['data'] = $row;
			$menu[$row['id']]['sub'] = $this->_page_child($row['id']);
		}
		$this->db->close();
		return $menu;
	}
	
	function _page_child($id){
		$this->load->database();					
		$sql = "SELECT * FROM menus WHERE parent='$id' ORDER BY `order` ASC;";
		$query = $this->db->query($sql);		
		$menu = array();
		foreach($query->result_array() as $row)
		{
			$menu[$row['id']]['data'] = $row;
			$menu[$row['id']]['sub'] = $this->_page_child($row['id']);
		}
		$this->db->close();
		return $menu;
	}
	
	function add($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('menus',$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('menus',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM menus WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	} 
}
?>