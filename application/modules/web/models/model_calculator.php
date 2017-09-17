<?php
class Model_calculator extends CI_Model {
	
	var $table = "calculator";
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }	
	
	function get_all(){
		$this->load->database();
        $this->db->from($this->table);
        $this->db->order_by('id','asc');
        return $this->db->get();
	}
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM {$this->table} WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function add($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert($this->table,$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM {$this->table} WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
    
    function update($index,$data){
        $this->load->database();
        
        $this->db->where('variable',$index);
        $this->db->update('setting',$data); 
    }
    
    function get_kurs(){
        $this->load->database();
        
        $this->db->select('value');
        $this->db->where('variable','kurs_calc');
        
        return $this->db->get('setting');
    }
}
?>