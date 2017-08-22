<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_assets()?>themes/main/images/favicon.ico">
    
	<!-- ganti seng bagian ngisor iki yo bro-->
	
    <title>Sistem rencana marketing bulanan</title>
    <link href="<?= base_assets()?>themes/main/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_assets()?>themes/main/css/custom_style.css" rel="stylesheet">

  </head>
    <style>
    h3 {font-weight:bold; color:#FFF}
    ul > li > a{color:#ff9933}
    </style>
  <body> 
    <div class="container">

	<div style="margin:0 auto">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12"> 
					<div class="col-md-12" style="margin-top:70px">
						<div class="panel" style="border:solid 1px #ff9933 ">
							<div class="header-top" style="min-height:90px; padding:0 0 0 10px">
								<div class="logo-header visible-md visible-lg visible-sm visible-xs">
									<img src="<?= base_assets()?>themes/main/images/logo_header.png" class="logo">
								</div>
								<div class="text-header">
									<span class="company-name">BANK RAKYAT INDONESIA</span><br> 
									<span class="app-name">Sistem Monitoring Marketing Bulanan</span>
								</div>
							
							</div>
							<div style="min-height:30px; background-color: #ff9933; color:#FFF; padding:3px 0 0 10px; text-align:center">Silahkan pilih Modul dan Role</div>
							<div style="min-height:350px; padding:10px; ">
								<div class="col-md-4">
									<div class="col-md-12" style="border:solid 1px #006699;min-height:300px; color:#FFF;  background: #006699 url('../../dist/img/bg.png') repeat scroll 0 0;">
										<h3>Administrasi SIM</h3>
										<hr>
										<p>
											<ul>
												<li><a href="<?= base_url("gate/menu/portal/$sim[ADM]")?>">Administrator</a></li>
												<li><a href="">Manager Marketing</a></li>
												<li><a href="">Keuangan</a></li>
											</ul>
											<br><br>
											Keterangan : <br> ini adalah penjelasan singkat dari modul di dalam kotak ini, silahakan dibaca sendiri
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="col-md-12" style="border:solid 1px #006699;min-height:300px; color:#FFF;  background: #006699 url('../../dist/img/bg.png') repeat scroll 0 0;">
										<h3>SIAO</h3>
										<hr>
										<p>
											<ul>
												<li><a href="<?= base_url("gate/menu/portal/$sim[SIAO]")?>">Administrator</a></li>
												<li><a href="">Manager Marketing</a></li>
												<li><a href="">Keuangan</a></li>
											</ul>
											<br><br>
											Keterangan : <br> ini adalah penjelasan singkat dari modul di dalam kotak ini, silahakan dibaca sendiri
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="col-md-12" style="border:solid 1px #006699;min-height:300px; color:#FFF;  background: #006699 url('../../dist/img/bg.png') repeat scroll 0 0;">
										<h3>Finance</h3>
										<hr>
										<p>
											<ul>
												<li><a href="">Administrator</a></li>
												<li><a href="">Manager Marketing</a></li>
												<li><a href="">Keuangan</a></li>
											</ul>
											<br><br>
											Keterangan : <br> ini adalah penjelasan singkat dari modul di dalam kotak ini, silahakan dibaca sendiri
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div><!--/.col-xs-12.col-sm-9-->
		</div><!--/row-->
	</div>
 
	<!-- karo iki barang-->
    </div><!--/.container--> 
  </body>
</html>
