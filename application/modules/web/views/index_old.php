<?php $this->load->view('web/default/header');?>
<?php
$menu = $this->auth->get_menu('mainmenu');
$base = $this->config->item('base_url');
function menu($menu,$base,$child=0){
	$akhiran='';
	if($child == 1)
		echo "<ul>";
	foreach($menu as $row){
		$url='';
		if(strpos($row['url'],'http') === false){
			if($row['url'] != "#")
				$akhiran = '.html';
			
			$url = "$base$row[url]$akhiran";
		}else{
			$url = $row['url'];
		}
		echo "<li>";		
		echo "<a class='sf-with-ul' href='$url'>$row[name]</a>";
		if(count($row['sub']) > 0){
			if($child['url'] != "#")
			$akhiran = '.html';
			echo "<ul style='display: none; visibility: hidden;'>";
			foreach($row['sub'] as $child){
				echo "<li>";
				echo "<a href='$base$child[url]$akhiran'>$child[name]</a>";
				if(count($child['sub']) > 0){
					menu($child['sub'],$base,1);
				}
				echo "</li>";
			}
			echo "</ul>";
				
		}
		echo "</li>";
	}
	
	if($child == 1)
		echo "</ul>";
}
?>

<div class="header-wrapper">
	<div class="container_16 forshdw"><div class="header">
    	<div style="color: #2F3589; font-size: 20px;">
    	<img src="<?php echo $this->config->item('base_url')?>templates/default/img/logo_big.png" class="logo" />
        PT AMBANG BARITO NUSAPERSADA
        </div>
        <div class="main-menu">
        	<ul id="mainmenu" class="sf-menu sf-js-enabled">
				<li id="home"><a href="<?php echo $this->config->item('base_url')?>">Beranda</a></li>
				<?php 	
				menu($menu,$base);
				?>
            </ul>
        </div>        
        <div class="search-wrapper">
        	<div class="searchbox">
				<form method="get" action="<?php base_url()?>search" >
                <input type="text" name="q" id="article" autocomplete="off" placeholder="cari artikel" value="<?php echo isset($_GET['q'])?$_GET['q']:''?>" />
                <button type="submit"></button>
				</form>
            </div>            
        </div>
    </div></div>
<!--    <div class="container_16 head-tools">
    	<div class="breadcrumb" style="color: #128CA3; font-size: 13px;">   
        	<ul><b>PENGUMUMAN: </b>
            	<a href="#" style="color: #128CA3; font-size: 13px;">&nbsp;</a>
            </ul>
           
        </div>
        <div class="webmail">
        	<a href="http://ambapers.com/webmail" target="_blank">WEBMAIL</a>
            Akses ke email Anda
        </div>
    </div>
    
</div>
/* css biar sempit templates/default/css/style.css line 191 */
-->
<div class="main-wrapper">
    <div class="container_16">
        <div class="grid_10 alpha main-content">
			<?php echo $content?>
        </div>
        <div class="grid_6">
            <div id="tab-webtool">
        
                <ul id="tab-webtool-nav">
                    <li class="wt1"><a href="#wt1">Calculator PPPA</a></li>
                    <li class="wt2"><a href="#wt2">Data PPPA</a></li>
                    <li class="wt3"><a href="#wt3">Kurs Pajak</a></li>
                </ul>
            
                <div class="tab" id="wt1">
                    <?php $this->load->view('web/default/calculator.php')?>
                </div>
                
                <div class="tab" id="wt2">
                    <?php $this->load->view('web/default/pppa.php')?>
                </div>
                
                <div class="tab" id="wt3">
                    <?php $this->load->view('web/default/pajak.php')?>
                </div>
                            
                <script type="text/javascript">
                    var tabber1 = new Yetii({
                    id: 'tab-webtool',
                    active: 1
                    });
                </script>
            </div>
            <div class="tools-bottom">
                <p><b>PT. AMBANG BARITO NUSAPERSADA</b></p>
                <ul>
                    <li>Jl. Yos Sudarso No 6 - Banjarmasin Kode Pos 70119</li>
                    <li>Phone. 0511-4423345, Fax. 0511-4423346</li>
                    <li>pelayanan@ambapers.com</li>
                </ul>
            </div>
        </div>
    </div>
</div>
    	
<?php $this->load->view('web/default/footer')?>
  
  <!-- end scripts-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27817540-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();         
</script>
  
</body>
</html>