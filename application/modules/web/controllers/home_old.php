<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	private $template = "default";
	public $calculator;
    public $kurs;
	public $pajak_tanggal;
	public $pajak_view;
	public $tahun_pppa;
	
	function __construct()
    {
		// Call the Model constructor
        parent::__construct();
		
		$this->load->model('model_setting');
		$this->load->model('model_calculator');
		$this->load->model('model_pppa');
        $this->load->library('pajak');
		
		//get setting from db
		$setting = $this->model_setting->get_all();
		foreach($setting->result_array() as $row){
			$this->config->set_item($row['variable'], $row['value']);
		}
		
		$this->template = $this->config->item('template');
		
		//get calculator drom db
		$this->calculator = $this->model_calculator->get_all();
        $this->kurs = $this->model_calculator->get_kurs(); 
        
        //grabbing
        $url = "http://www.beacukai.go.id/index.html?page=kurs";
        $cache_file = 'cache/pajak.html';
        $cache_time = 10800;
        $grab = $this->pajak->grab($url,$cache_file,$cache_time);
        $pajak = $this->extracting($grab);
        $this->pajak_tanggal = $pajak['tanggal'];
        $this->pajak_view = $pajak['view'];
		$this->tahun_pppa = $this->model_pppa->get_pppa();
        //end of grabbing
    }
	
	public function index($page=1)
	{
		
		$this->load->model('model_article');
		$this->load->model('model_comment');
		$this->load->model('model_galery');
        
		$limit = 5;
		$data['article']= $this->model_article->get_by(1);
		$data['headline']= $this->model_article->get_headline();
		$data['galery']= $this->model_galery->get_album("yes");
		$data['page'] = $page;
		$data['limit'] = $limit;
        
		$view['content'] = $this->load->view('web/'.$this->template.'/home',$data,TRUE);
        
		$this->load->view('web/'.$this->template.'/index',$view);
	}
    
    public function admin()
    {
        redirect('admin/main');
    }
	
	public function article($link='')
	{
		$this->load->model('model_article');
		$this->load->model('model_comment');
		$this->load->model('model_hit');
		
		if(isset($_POST['comment_act'])){
			$data = $_POST['data'];
			$data['content'] = htmlspecialchars($data['content'], ENT_QUOTES);;
			$data['id_parent'] = 0;
			$data['id_author'] = $this->session->userdata('id_user');
			$data['author_ip'] = $_SERVER['REMOTE_ADDR'];
			$data['is_spam'] = 'no';
			$data['published'] = 'yes';
			$data['created'] = date('Y-m-d H:i:s');
			$data['modified'] = date('Y-m-d H:i:s');
			
			$this->model_comment->add($data);
		}
		unset($data);
		$data['article']= $this->model_article->get_by_link($link,'yes');
		$read=0;
        $id=null;
        if($data['article']['total'] > 0){
		    foreach($data['article']['rows']->result_array() as $row){
			    $id = $row['id'];
			    $this->config->set_item('site_title', $row['title']." - ".$this->config->item('site_title'));
			    $this->config->set_item('description', $row['description']);
			    $this->config->set_item('keyword', $row['keyword']);
			    $read = $row['read'] + 1;
		    }
		    
		    $data['related_article'] = $this->model_article->get_related($id);
		    $this->model_article->edit($id,array('read'=>$read));
		    $this->model_hit->add_hit($id);

		    $data['comment']= $this->model_comment->get_all(0,10,'','yes');
		    $data['article_comm']= $this->model_comment->get_by_link($link);
		    $view['content'] = $this->load->view('web/'.$this->template.'/article',$data,TRUE);
		    $this->load->view('web/'.$this->template.'/index',$view);
        }else{
            redirect(base_url());   
        }
	}
	
	public function category($category,$page=1)
	{
		
		$this->load->model('model_article');
		$this->load->model('model_comment');
		
		$limit = 5;
		$data['article']= $this->model_article->get_by_category(($page-1),$limit,$category,'yes');
		$data['comment']= $this->model_comment->get_all(0,10,'','yes');
		$data['page'] = $page;
		$data['category'] = $category;
		$data['limit'] = $limit;
		$view['content'] = $this->load->view('web/'.$this->template.'/category',$data,TRUE);
		$this->load->view('web/'.$this->template.'/index',$view);
	}
	
	public function galery($id_album=0)
	{
		$this->load->model('model_galery');
		
		if($id_album==0){
			$data['galery']= $this->model_galery->get_album("yes");
			$view['content'] = $this->load->view('web/'.$this->template.'/galery',$data,TRUE);
		}else{
			$data['album']= $this->model_galery->get_album_by($id_album);
			$data['photo']= $this->model_galery->get_photo($id_album,"yes");
			$view['content'] = $this->load->view('web/'.$this->template.'/photo',$data,TRUE);
		}
		
		
		$this->load->view('web/'.$this->template.'/index',$view);
	}
    
    public function document()
    {
        $this->load->model('model_filemanager');

        $data['document']= $this->model_filemanager->get_document("data/document");
        $view['content'] = $this->load->view('web/'.$this->template.'/document',$data,TRUE);
        $this->load->view('web/'.$this->template.'/index',$view);
    }
	
	public function contact()
	{
		$data = array();
		if(isset($_POST['send_act'])){
			$email = $this->config->item('email');
				

			$this->load->library('email');	
			
			//config
			$config['wordwrap'] = FALSE;
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
			//send to email
			$this->email->from($_POST['author_email'], $_POST['author_name']);
			$this->email->to($email); 

			$this->email->subject($_POST['author_subject']);
			$this->email->message($_POST['message']);

			$this->email->send();
		}
		$view['content'] = $this->load->view('web/'.$this->template.'/contact',$data,TRUE);
		$this->load->view('web/'.$this->template.'/index',$view);
	}
	
	public function chat($target='operasional')
	{	
		$data['target'] = $target;
		$this->load->view('web/'.$this->template.'/chat',$data);
	}
	
	public function search()
	{		
		$this->load->model('model_article');
		$q = $_GET['q'];
		$start = 0;
		$limit = 20;
		
		if(isset($_GET['start']))
			$start = $_GET['start'];
		
		$data['article']= $this->model_article->get_search(($page-1),$limit,$q);
		
		//$url = "http://ajax.googleapis.com/ajax/services/search/web?rsz=large&v=1.0&start=$start&q=".urlencode('site:http://ambapers.com '.$q);
//		$handle = fopen($url, 'rb');
//		$body = '';
//		while (!feof($handle)) {
//			$body .= fread($handle, 8192);
//		}
//		fclose($handle);
//		
//		$result = json_decode($body,TRUE);
//		$data['result'] = $result;
		//echo "<pre>";var_dump($result);
		$data['q'] = $q;
		//$data['category'] = $category;
		// $data['limit'] = $limit;
		$view['content'] = $this->load->view('web/'.$this->template.'/search',$data,TRUE);
		$this->load->view('web/'.$this->template.'/index',$view);
	}
	
	function extracting($grab){
        $this->load->library('pajak');
        $pecah = $this->pajak->extract_string('<table cellpadding="0" cellspacing="0" border="0" style="width:100%; background-color: #fff">',$grab,1);
        $sk = $this->pajak->extract_string('</table>',$pecah,0);
        $kurs = $this->pajak->extract_string('</table>',$pecah,1);
        $tgl = $this->pajak->extract_string('<tr>',$sk,3);
        $valuta = $this->pajak->extract_string("<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:100%; background-color: #fff; margin-top: 20px\">",$kurs,1);
        $out = explode("<tr>",$valuta);
        $pajak = array('tanggal' => $tgl, 'view' => $out);
        return $pajak;
    }
	
	function pppa(){
        $this->load->model('model_pppa');
        $this->load->library('fusioncharts');
        
		echo $head = '
		<div class="pajak">
			<div class="item head">
				<div class="col01">Bulan</div>
				<div class="col02">Tongkang</div>
			</div>
			<div class="item head">
				<div class="col01">Bulan</div>
				<div class="col02">Tongkang</div>
			</div>
		';

        $tahun = $this->input->post('tahun');
        $data = $this->model_pppa->get_trafik($tahun);
        $chart = $this->model_pppa->get_chart($tahun);
        $jumlah = $this->model_pppa->get_jumlah($tahun)->row();
        $strXML = "<graph caption='Grafik Jumlah Tongkang(Unit) Tahun $tahun' subCaption='' xAxisName='Bulan' yAxisName='Trafik' decimalPrecision='0' showNames='1' showValues='0' numberSuffix='' pieSliceDepth='30' formatNumberScale='0'>";
        foreach($data->result() as $rec)
        {
			echo "<div class='item odd'><div class='col01'>".$rec->bulan1."</div><div class='col02'>".$rec->trafik1."</div></div>";
			echo "<div class='item even'><div class='col01'>".$rec->bulan2."</div><div class='col02'>".$rec->trafik2."</div></div>";
        }
			echo "<div class='item odd'><div class='col01'>TOTAL</div><div class='col02'>&nbsp;</div></div>";
			echo "<div class='item even'><div class='col01'>&nbsp;</div><div class='col02'>".$jumlah->trafik."</div></div>";
		echo '</div>';
        foreach($chart->result() as $rec){
            $strXML .= "<set name='" . $rec->singkat . "' value='" . $rec->trafik . "' />";
        }
        $strXML .= "</graph>";
        echo $this->fusioncharts->renderChart(base_url().'plugins/fchart/Charts/FCF_Line.swf','',$strXML,'PPPA',300,200);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */