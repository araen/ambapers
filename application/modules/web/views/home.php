    	<div class="slider-wrapper theme-default">
			<div id="slider" class="nivoSlider">
				<?php
				foreach($headline->result_array() as $row){
				?>
				<img src="<?php echo strpos($row['image_headline'],"http") === false?base_url().$row['image_headline']:$row['image_headline']?>" alt="" title="#htmlcaption<?php echo $row['id']?>" />
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
        <h2><a href="<?php echo $this->config->item('base_url')?>galery.html">Galery Gambar</a></h2>
        	<ul>
				<?php
				$count=1;
				$max=5;
				foreach($galery->result_array() as $row){?>
            	<li >
				<a id="fancy" href="<?php echo base_url()."galery/".$row['id']?>" title="<?php echo $row['title']?>">
					<img src="<?php echo base_url().$row['image_url']?>" />
				</a></li>
				<?php 
					$count++;
					if($count > $max)
						break;
				} 
				?>
			</ul>
        </div>
		<?php } ?>