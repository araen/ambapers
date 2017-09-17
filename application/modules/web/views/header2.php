<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo $this->config->item('base_url') ?>" />

<title><?php echo $this->config->item('site_title')?></title>
  
<meta name="description" content="<?php echo $this->config->item('description')?>" />
<meta name="keywords" content="<?php echo $this->config->item('keyword')?>" />

<link href="<?php echo $this->config->item('base_url')?>templates/default/css/reset.css" type="text/css" media="screen" rel="stylesheet" />
<link href="<?php echo $this->config->item('base_url')?>templates/default/css/text.css" type="text/css" media="screen" rel="stylesheet"/>
<link href="<?php echo $this->config->item('base_url')?>templates/default/css/960_16_col.css" type="text/css" media="screen" rel="stylesheet"/>

<!-- nivo-slider -->
<link rel="stylesheet" href="<?php echo $this->config->item('base_url')?>plugins/nivo-slider/nivo-slider.css" />
<link rel="stylesheet" href="<?php echo $this->config->item('base_url')?>plugins/nivo-slider/themes/floatingPaper-col16-grid10/default.css" />

<link href="<?php echo $this->config->item('base_url')?>templates/default/css/style.css" type="text/css" media="screen" rel="stylesheet" />

<!-- fancybox -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url')?>plugins/fancybox/jquery.fancybox-1.3.4.css">
<!--<link href="<?php echo $this->config->item('base_url')?>templates/default/css/superfish.css" type="text/css" rel="stylesheet">-->

  
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>templates/default/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>templates/default/js/yetii-min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>templates/default/js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>templates/default/js/Bauhaus_italic_500.font.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>templates/default/js/superfish.js"></script>

<!-- fancybox-->
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>plugins/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<!--nivo-slider-->
<script defer src="<?php echo $this->config->item('base_url')?>plugins/nivo-slider/jquery.nivo.slider.pack.js"></script>

<!--Fusion Chart-->
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>plugins/fchart/JSClass/FusionCharts.js"></script> 
<script type="text/javascript">
	Cufon.replace('.content h2',{
textShadow: '1px 1px 80px #1f7681'});
	Cufon.replace('.galery h2, .news-title');
	
	$(document).ready(function() {
		$(".fancybox").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	false
		});
	});
</script>
<script language="javascript">  
   $(document).ready(function() {
       $('ul.sf-menu').superfish();
   });     
</script>
</head>

<body>
  