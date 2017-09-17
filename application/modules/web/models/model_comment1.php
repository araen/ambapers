<?php
class Model_comment extends CI_Model {
	
    function Model_comment()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM comments WHERE id='$id' ORDER BY id;";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function get_by_link($link){
		$this->load->database();
						
			$sql = "SELECT comments.* FROM comments JOIN articles ON id_article=articles.id WHERE articles.permalink='$link' ORDER BY id;";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function get_all($page=0,$limit=20, $q='',$published=''){
		$this->load->database();
		$filter='';
		$page = $page*$limit;
		if($q != ''){
			$filter = " WHERE (";
			$fields = $this->db->list_fields('comments');
			foreach ($fields as $field){
			   $filter .= " comments.$field LIKE '%$q%' OR" ;
			}
			$filter = rtrim($filter,'OR').")";
		}
		
		if($published!='')
			$filter .= " AND comments.published='$published'";

		$sql = "SELECT comments.*, articles.title,articles.permalink link FROM comments LEFT JOIN articles ON id_article=articles.id $filter ORDER BY comments.id DESC LIMIT $page,$limit;";
		$query['data'] = $this->db->query($sql);
		
		$sql = "SELECT comments.*, articles.title,articles.permalink link FROM comments LEFT JOIN articles ON id_article=articles.id $filter";
		$query['count'] = $this->db->query($sql);
		$this->db->close();
		
		return $query;
	}
    
	function add($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('comments',$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('comments',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM comments WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function import(){
		$this->load->database();
		$article = array();
		$sql = "SELECT * FROM articles;";
		$query = $this->db->query($sql);
		foreach($query->result_array() as $row){
			$article[strtolower($row['title'])] = $row['id'];
		}
		$sql = "SELECT * FROM komentar ORDER BY `wp:comment_id`;";
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row){
			$data['id_article'] = isset($article[strtolower($row['title'])])?$article[strtolower($row['title'])]:0;
			$data['id_parent'] = 0;
			$data['id_author'] = 0;
			$data['author_name'] = $row['wp:comment_author'];
			$data['author_email'] = $row['wp:comment_author_email'];
			$data['author_website'] = $row['wp:comment_author_url'];
			$data['author_ip'] = $row['wp:comment_author_IP'];
			$data['is_spam'] = 'no';
			$data['content'] = $row['wp:comment_content'];
			$data['add_date'] = date("Y-m-d H:i:s",strtotime($row['wp:comment_date']));
			$data['last_modified'] = date("Y-m-d H:i:s",strtotime($row['wp:comment_date']));
			$data['published'] = 'yes';
			
			$this->add($data);
		}
		$this->db->close();
	}
}
?>