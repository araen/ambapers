<?php
class Model_pppa extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    var $table='pppa';
	
	function get_all($tahun=0){
		$this->load->database();
		
		$sql = "SELECT * FROM {$this->table} WHERE tahun='$tahun' ORDER BY bulan ASC;";
		$query['data'] = $this->db->query($sql);

		$this->db->close();
		
		return $query;
	}
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM {$this->table} WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function is_record($bulan,$tahun){
		$this->load->database();			
			$sql = "SELECT * FROM {$this->table} WHERE bulan='$bulan' AND tahun='$tahun';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}	
	
    function get_pppa(){
        $this->load->database();
        $this->db->select('tahun');
        $this->db->distinct();
        return $this->db->get($this->table);
    }
    
    function get_chart($tahun){
        $this->load->database();
        $sql = "select
                a.nama, a.singkat, a.id as bulan, ifnull(b.trafik,0) as trafik
                from bulan a
                left join (select * from pppa where tahun = $tahun) b on a.id = b.bulan";
        return $this->db->query($sql);
    }
    
    function get_jumlah($tahun){
        $this->load->database();
        $this->db->select_sum('trafik');
        $this->db->where('tahun',$tahun);
        return $this->db->get($this->table); 
    }
    
    function get_trafik($tahun){
        $this->load->database();
        $sql = "select a.nama as bulan1 ,a.trafik as trafik1,b.nama as bulan2,b.trafik as trafik2
                from (
                select
                1 as kolom,a.nama, a.singkat, a.id as bulan, ifnull(b.trafik,0) as trafik
                from bulan a
                left join (select * from pppa where tahun = $tahun) b on a.id = b.bulan
                where a.id <=6
                ) a
                left join (select
                1 as kolom,a.nama, a.singkat, a.id as bulan, ifnull(b.trafik,0) as trafik
                from bulan a
                left join (select * from pppa where tahun = $tahun) b on a.id = b.bulan
                where a.id >6) b on a.kolom=b.kolom
                where b.bulan - a.bulan = 6";
        return $this->db->query($sql);
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
}
?>