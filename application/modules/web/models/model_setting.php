<?php
class Model_setting extends CI_Model {
	
    function Model_setting()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all(){
		$this->load->database();

		$sql = "SELECT * FROM setting;";
		$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function edit($variable,$value){
		$this->load->database();
			$data['value'] = $value;
			$this->db->where('variable',$variable);
			$this->db->update('setting',$data);
		$this->db->close();
	}
}
?>