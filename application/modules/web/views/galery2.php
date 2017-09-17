  	
        <div class="galery">
        <h2>Galery Gambar</h2>
        	<ul class="photos">
				<?php
				foreach($galery as $image){?>
            	<li ><a href="<?php echo base_url()."data/galery/".$image?>" class="fancybox" rel="gal"><img src="<?php echo base_url()."data/galery/".$image?>" /></a></li>
				<?php 
				} 
				?>
			</ul>
        </div>