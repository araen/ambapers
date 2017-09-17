<?php
class Model_log extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_log($date_a,$date_b,$page=0,$limit=20,$q='',$custom=''){
		$this->load->database();
		$filter='';
		$page = $page*$limit;
		
		if($q != ''){
			$filter .= " AND (";
			$fields = $this->db->list_fields('logger');
			foreach ($fields as $field){
			   $filter .= " logger.$field LIKE '%$q%' OR" ;
			}
			$filter .= " users.id_user='$q' OR users.name='$q' OR users.username='$q')";
		}
		if($custom != ''){
			$filter .= "AND $custom ";
		}
				
		$sql = "SELECT logger.*, users.name FROM logger LEFT JOIN users ON users.id_user=logger.id_user WHERE DATE(time) >= '$date_a' AND DATE(time) <= '$date_b' $filter ORDER BY id_log DESC LIMIT $page,$limit;";
		$query['data'] = $this->db->query($sql);
		
		$sql = "SELECT logger.*, users.name FROM logger LEFT JOIN users ON users.id_user=logger.id_user WHERE DATE(time) >= '$date_a' AND DATE(time) <= '$date_b' $filter;";
		$query['count'] = $this->db->query($sql);
		$this->db->close();
		
		return $query;
	}
	
	function add($log){
		$log['id_user']=$this->session->userdata('id_user');;
		$log['time']=date("Y-m-d H:i:s");
		$log['ip_address']=$_SERVER['REMOTE_ADDR'];
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('logger',$log);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
}