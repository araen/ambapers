<?php
class Model_hit extends CI_Model {
	
    function Model_hit()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function add_hit($id_article){
		$this->load->database();
		
		$hit['id_article'] = $id_article;		
		$hit['date'] = date('Y-m-d');
		$ip=$_SERVER['REMOTE_ADDR'];
		
		$sql = "SELECT * FROM hits WHERE date='$hit[date]' AND id_article='$id_article';";
		$query = $this->db->query($sql);
		if($query->num_rows() == 0){
			$hit['ip_address'] = json_encode(array(0=>$ip));
			$this->db->insert('hits',$hit);
		}else{
			foreach($query->result_array() as $row){
				$id = $row['id'];
				$hit['total'] = $row['total'] + 1;
				$tmp_ip = json_decode($row['ip_address'],true);
				$tmp_ip[] = $ip;
				$hit['ip_address'] = json_encode($tmp_ip);
			}
			$this->db->where('id',$id);
			$this->db->update('hits',$hit);
		}
		
		$this->db->close();
	}
}
?>