    	<div class="slider-wrapper theme-default">
			<div id="slider" class="nivoSlider">
				<?php
				foreach($headline->result_array() as $row){
				?>
				<img src="<?php echo base_url().$row['image_headline']?>" alt="" title="#htmlcaption<?php echo $row['id']?>" />
				<?php
				}
				?>
			</div>
			
			<?php
			foreach($headline->result_array() as $row){
			?>
			<div id="htmlcaption<?php echo $row['id']?>" class="nivo-html-caption">
				<h2><a href="<?php echo base_url().$this->config->item('article_link').$row['permalink'];?>" ><?php echo $row['title']?></a></h2>
                <?php echo substr($row['description'],0,200)?>
			</div>
			<?php
			}
			?>
			<div id="htmlcaption" class="nivo-html-caption">
				<h2>Peresmian Pengerukan Alur Ambang Barito</h2>
                <p>Peresmian dimulainya pengerukan Alur Ambang Barito Kalimantan Selatan Oleh Gubernur Kalsel H Rudy Arifin. Selama ini dengan alur lama lalulintas kapal melalui pelabuhan trisakti banjarmasin hanya dimungkinkan bila air laut pasang.....</p>
			</div>
		</div>
		
		<script type="text/javascript">
		  $(window).load(function() {
			  $('#slider').nivoSlider();
		  });
		</script>
		<?php foreach($article->result_array() as $row){?>
		<div class="post">
        	<div class="intro">
                <div class="content">
                    <h2>
                        <a href="<?php echo $this->config->item('base_url').$this->config->item('article_link').$row['permalink']?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a>
                    </h2>
                    
                    <div class="summary">
                        <p><?php 
                        echo $row['introcontent'];											
                        ?>
                        </p>
                    </div>
                </div>
            </div>
		</div>
        <div class="galery">
        <h2>Galery Gambar</h2>
        	<ul>
				<?php
				$count=1;
				$max=5;
				foreach($galery as $image){?>
            	<li ><a id="fancy" href="<?php echo base_url()."data/galery/".$image?>" class="fancybox" rel="gal"><img src="<?php echo base_url()."data/galery/".$image?>" /></a></li>
				<?php 
					$count++;
					if($count > $max)
						break;
				} 
				?>
			</ul>
        </div>
		<?php } ?>