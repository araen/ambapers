<?php if( $this->session->flashdata('notification_error') ) {?>
<div class="error msg"><?php echo $this->session->flashdata('notification_error')?></div>
<?php }?>
