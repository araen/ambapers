  	
        <div class="galery">
        <h2>Galery Album</h2>
        	<ul class="photos">
				<?php
				foreach($galery->result_array() as $row){?>
            	<li >
				<a href="<?php echo base_url()."galery/".$row['id']?>" title="<?php echo $row['title']?>">
					<img src="<?php echo base_url().$row['image_url']?>" />
					<div><?php echo $row['title']?></div>
				</a></li>
				<?php 
				} 
				?>
			</ul>
        </div>