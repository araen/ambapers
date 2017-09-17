		<div class="galery album page">
            <h2 class="page-title">Galery Album</h2>
            <div class="content">
                <ul class="photos">
                    <?php
                    foreach($galery->result_array() as $row){?>
                    <li >
                        <div class="thumb"><img src="<?php echo base_url().$row['image_url']?>" /></div>
                        <a href="<?php echo base_url()."galery/".$row['id']?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a>
                    </li>
                    <?php 
                    } 
                    ?>
                </ul>
            </div>
        </div>