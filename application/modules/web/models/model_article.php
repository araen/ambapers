<?php
class Model_article extends CI_Model {
	
    function Model_article()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_by($id){
		$this->load->database();
						
			$sql = "SELECT * FROM articles WHERE id='$id';";
			$query = $this->db->query($sql);
		
		$this->db->close();
		
		return $query;
	}
	
	function get_by_link($link){
		$this->load->database();
						
			$sql = "SELECT * FROM articles WHERE permalink='$link';";
			$query['rows'] = $this->db->query($sql);
		    $query['total'] = $query['rows']->num_rows();
		$this->db->close();
		
		return $query;
	}
	
	function get_headline($limit=10){
		$this->load->database();
						
			$sql = "SELECT * FROM articles WHERE headline='yes' AND published='yes' ORDER BY created DESC LIMIT $limit;";
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
			$fields = $this->db->list_fields('articles');
			foreach ($fields as $field){
			   $filter .= " articles.$field LIKE '%$q%' OR" ;
			}
			$filter .= " categories.name LIKE '%$q%' OR" ;
			$filter = rtrim($filter,'OR').")";
		}
		
		if($published!='')
			$filter .= " AND articles.published='$published'";	
				
		$sql = "SELECT articles.*, categories.name FROM articles LEFT JOIN categories ON id_category=categories.id $filter ORDER BY articles.id DESC LIMIT $page,$limit;";
		$query['data'] = $this->db->query($sql);
		
		$sql = "SELECT articles.*, categories.name FROM articles LEFT JOIN categories ON id_category=categories.id $filter";
		$query['count'] = $this->db->query($sql);
		$this->db->close();
		
		return $query;
	}
	
	function get_by_category($page=0,$limit=20, $c='',$published){
		$this->load->database();
		$filter='';
		$page = $page*$limit;
		
		if($published!='')
			$filter .= " AND articles.published='$published'";	
				
		$sql = "SELECT articles.*, categories.name FROM articles LEFT JOIN categories ON id_category=categories.id WHERE (categories.permalink='$c' OR categories.parent='$c') $filter ORDER BY articles.id DESC LIMIT $page,$limit;";
		$query['data'] = $this->db->query($sql);
		
		$sql = "SELECT articles.*, categories.name FROM articles LEFT JOIN categories ON id_category=categories.id WHERE (categories.permalink='$c' OR categories.parent='$c') $filter";
		$query['count'] = $this->db->query($sql);
		$this->db->close();
		
		return $query;
	}
	
	function get_related($id_article){
		$this->load->database();
			$title='';
			$content='';
			$keyword='';
			$weighttitle=3;
			$weightcontent=3;
			$weightkeyword=2;
			
			$article = $this->get_by($id_article);
			foreach($article->result_array() as $row){
				$title = $row['title'];
				//$content = mysql_escape_string(preg_replace( '/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i', '',$row['content']));//
				$keyword = str_replace(",","",$row['title']);
			}
			
			$sql = "SELECT title, created,  ROUND(0 + (MATCH (title) AGAINST ('$title'))*$weighttitle + (MATCH (content) AGAINST ('$content'))*$weightcontent +(MATCH (keyword) AGAINST ('$keyword'))*$weightkeyword,1) as score FROM articles WHERE id<>$id_article AND published='yes' ORDER BY score DESC LIMIT 10;";
			$query = $this->db->query($sql);
			$this->db->close();
			
			return $query;
	}
	
	function get_search($page=0,$limit=10,$key){
		$this->load->database();
			$title='';
			$content='';
			$keyword='';
			$weighttitle=4;
			$weightcontent=3;
			$weightkeyword=2;
			
			$key = mysql_escape_string(preg_replace( '/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i', '',$key));
			
			$sql = "SELECT *,  ROUND(0 + (MATCH (title) AGAINST ('$key'))*$weighttitle + (MATCH (content) AGAINST ('$key'))*$weightcontent +(MATCH (keyword) AGAINST ('$key'))*$weightkeyword,1) as score FROM articles WHERE published='yes' ORDER BY score DESC LIMIT $page,$limit;";
			$query['data'] = $this->db->query($sql);
			
			$sql = "SELECT *, ROUND(0 + (MATCH (title) AGAINST ('$key'))*$weighttitle + (MATCH (content) AGAINST ('$key'))*$weightcontent +(MATCH (keyword) AGAINST ('$key'))*$weightkeyword,1) as score FROM articles WHERE published='yes';";
			$query['count'] = $this->db->query($sql);
			$this->db->close();
			
			return $query;
	}
    
	function add($data){
		$this->load->database();		
		$this->db->trans_start();
			$this->db->insert('articles',$data);
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function edit($id,$data){
		$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('articles',$data);
		$this->db->close();
	}
	
	function delete($id){
		$this->load->database();
		
		$this->db->trans_start();
			$this->db->query("DELETE FROM articles WHERE id='$id'");
		$this->db->trans_complete();
		
		$return = $this->db->trans_status();
		
		$this->db->close();
		return $return;
	}
	
	function import(){
		$this->load->database();
		$category = array();
		$sql = "SELECT * FROM categories;";
		$query = $this->db->query($sql);
		foreach($query->result_array() as $row){
			$category[strtolower($row['name'])] = $row['id'];
		}
		$sql = "SELECT * FROM article ORDER BY `wp:post_id`;";
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row){
			$data['title'] = $row['title'];
			$data['permalink'] = strtolower(str_replace(" ","-",$row['title']));
			$data['content'] = $row['content:encoded'];
			$data['description'] = substr(preg_replace( '/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i', '', $row['content:encoded'] ) ,0,200);
			$data['created'] = date("Y-m-d H:i:s",strtotime($row['wp:post_date']));
			$data['modified'] = date("Y-m-d H:i:s",strtotime($row['wp:post_date']));
			$data['id_category'] = isset($category[strtolower($row['category'])])?$category[strtolower($row['category'])]:16;
			$data['created_by'] = 1;
			$data['modified_by'] = 1;
			$data['read'] = 100;
			$data['comment'] = 'yes';
			$data['published'] = 'yes';
			
			$this->add($data);
		}
		$this->db->close();
	}
}
?>