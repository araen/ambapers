<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
  
  <div class="leftpanel">
    
    <div class="logopanel" align="center">
      <h1><a href="<?php echo base_url()?>"><span>[</span> Ambapers <span>]</span></a></h1>
        <!--<img src="<?php echo base_assets()?>themes/main/images/logo_text.png" width="134" height="30" />-->
    </div><!-- logopanel -->
    
    <div class="leftpanelinner">    
            
            <?php $menu->render()?>
          
        </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->