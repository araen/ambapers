		<?php
			$title='';
			foreach($album->result_array() as $row){
				$title = '"'.$row['title'].'"';
			}
		?>
        <div class="galery">
        <h2>Galery Album <?php echo $title?></h2>
        	<ul class="photos">
				<?php
				foreach($photo->result_array() as $row){?>
            	<li >
				<a href="<?php echo base_url().$row['image_url']?>" class="fancybox" rel="gal" title="<?php echo $row['description']?>">
					<img src="<?php echo base_url().$row['image_url']?>" />
				</a></li>
				<?php 
				} 
				?>
			</ul>
        </div>