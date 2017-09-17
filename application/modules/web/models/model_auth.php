<?php
class Model_auth extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_menu_admin(){
		$id = $this->session->userdata('id_user');
		$this->load->database();					
		$sql = "SELECT groups.* FROM users, groups WHERE users.id_group=groups.id AND users.id='$id';";
		$query = $this->db->query($sql);
		
		$id_menu = array();
		foreach($query->result() as $row)
		{
			$id_menu = json_decode($row->access,TRUE);
		}
		$in = "(";
		foreach($id_menu as $row){
			$in .= $row.",";
		}
		$in = rtrim($in,",").")";
		$sql = "SELECT * FROM menu_admin WHERE id in $in AND parent='0' ORDER BY `order` ASC;";
		$query = $this->db->query($sql);
		$menu = array();
		foreach($query->result() as $row)
		{
			$menu[$row->id]['name'] = $row->name;
			$menu[$row->id]['url'] = $row->link;
			$menu[$row->id]['sub'] = $this->_get_child($row->id,$in);
		}
		$this->db->close();
		return $menu;
	}
	
	function _get_child($id,$in){
		$this->load->database();					
		$sql = "SELECT * FROM menu_admin WHERE parent='$id' AND id in $in ORDER BY `order` ASC;";
		$query = $this->db->query($sql);		
		$menu = array();
		foreach($query->result() as $row)
		{
			$menu[$row->id]['name'] = $row->name;
			$menu[$row->id]['url'] = $row->link;
			$menu[$row->id]['sub'] = $this->_get_child($row->id,$in);
		}
		$this->db->close();
		return $menu;
	}
	
	function get_access(){
		$id = $this->session->userdata('id_user');
		$this->load->database();					
		$sql = "SELECT groups.* FROM users, groups WHERE users.id_group=groups.id AND users.id='$id';";
		$query = $this->db->query($sql);
		
		$id_menu = array();
		foreach($query->result() as $row)
		{
			$id_menu = json_decode($row->access,TRUE);
		}
		$in = "(";
		foreach($id_menu as $row){
			$in .= $row.",";
		}
		$in = rtrim($in,",").")";
		$sql = "SELECT * FROM menu_admin WHERE id in $in;";
		$query = $this->db->query($sql);
		$access = array();
		foreach($query->result() as $row)
		{
			$access[$row->id] = $row->id_access;
			
		}
		//var_dump($access);
		$this->db->close();
		return $access;
	}
	
	function get_menu($menutype=''){
		$this->load->database();					
		$sql = "SELECT * FROM menus WHERE parent='0' AND published='yes' AND menutype='$menutype' ORDER BY `order` ASC;";
		$query = $this->db->query($sql);
		$menu = array();
		foreach($query->result() as $row)
		{
			$menu[$row->id]['name'] = $row->name;
			$menu[$row->id]['url'] = $row->link;
			$menu[$row->id]['sub'] = $this->_menu_child($row->id);
		}
		$this->db->close();
		return $menu;
	}
	
	function _menu_child($id){
		$this->load->database();					
		$sql = "SELECT * FROM menus WHERE parent='$id' AND published='yes' ORDER BY `order` ASC;";
		$query = $this->db->query($sql);		
		$menu = array();
		foreach($query->result() as $row)
		{
			$menu[$row->id]['name'] = $row->name;
			$menu[$row->id]['url'] = $row->link;
			$menu[$row->id]['sub'] = $this->_menu_child($row->id);
		}
		$this->db->close();
		return $menu;
	}
}
?>