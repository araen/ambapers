<div class="footer-wrapper">
	<div class="footmenus">
        <div class="container_16">
            <ul>
            	<h3>Profil</h3>
				<?php
					$base = $this->config->item('base_url');
					$menu = $this->auth->get_menu('profilemenu');
 	
					menu($menu,$base);
				?>
            </ul>
            <ul>
            	<h3>Layanan</h3>
                <?php
					$base = $this->config->item('base_url');
					$menu = $this->auth->get_menu('layananmenu');
 	
					menu($menu,$base);
				?>
            </ul>
            <ul>
            	<h3>Link terkait</h3>
                <?php
					$base = $this->config->item('base_url');
					$menu = $this->auth->get_menu('linkterkait');
 	
					menu($menu,$base);
				?>
            </ul>
            <img src="<?php echo $this->config->item('base_url')?>templates/default/img/logo_big.png" class="logosmall" />
        </div>
    </div>
    <div class="container_16 footbottom"><p><?php echo $this->config->item('footer_text')?></p></div>
</div>