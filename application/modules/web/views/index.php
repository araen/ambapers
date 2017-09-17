<?php
$base = base_url();
function menu($menu,$base,$child=0){
    $akhiran='';
    if($child == 1)
        echo "<ul>";
    foreach($menu as $row){
        $url='';
        if(strpos($row['url'],'http') === false){
            if($row['url'] != "#")
                $akhiran = '.html';
            
            $url = "$base$row[url]$akhiran";
        }else{
            $url = $row['url'];
        }
        echo "<li class='dropdown'>";        
        echo "<a class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false' href='$url'>$row[name]</a>";
        if(count($row['sub']) > 0){
            if($child['url'] != "#")
            $akhiran = '.html';
            echo "<ul class='dropdown-menu'>";
            foreach($row['sub'] as $child){
                echo "<li>";
                echo "<a href='$base$child[url]$akhiran'>$child[name]</a>";
                if(count($child['sub']) > 0){
                    menu($child['sub'],$base,1);
                }
                echo "</li>";
            }
            echo "</ul>";
                
        }
        echo "</li>";
    }
    
    if($child == 1)
        echo "</ul>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ambapers</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta property="og:title" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="">
    <meta property="og:description" content="">

    <!-- Styles -->
    <link rel="icon" href="<?php echo base_assets()?>themes/web/img/favicon.png" />
    <link rel="stylesheet" href="<?php echo base_assets()?>themes/web/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_assets()?>themes/web/css/animate.css">
    <!--<link href="https://fonts.googleapis.com/css?family=Oxygen|Patua+One" rel="stylesheet">-->


    <link rel="stylesheet" href="<?php echo base_assets()?>themes/web/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_assets()?>themes/web/css/main.css">

    <script src="<?php echo base_assets()?>themes/web/js/modernizr-2.7.1.js"></script>

</head>

<body>
    <header>
        <div class="border-top"></div>
        <section class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay="0.3s">
                        <a href="index.html"><img src="<?php echo base_assets()?>themes/web/img/logo.png" alt="Logo" height="90"></a>
                        <span class="brand-title">PT Ambang Barito Nusapersada</span>
                    </div>
                    <div class="hidden-xs col-sm-6 padding-right-0 contact-loc text-right navbar-nav wow fadeInDown" data-wow-delay="0.6s">
                        <div class="desc">
                            <h3 class="fa fa-map-marker"></h3>
                            Jl. Yos Sudarso No 6<br/> Banjarmasin 70119
                        </div>
                        <div class="desc">
                            Hubungi Kami
                            <h4>Telp. 0511-4423345</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav wow fadeInDown" data-wow-delay="0.8s">
                            <li><a href="#pricing" class="scroll">Beranda</a></li>
                            <?php echo menu($menu, $base)?>
                        </ul>
                        <div class="navbar-right">
                            <div class="search">
                                <span class="fa fa-search default"></span>
                                <form class="form-inline">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Apa yang Anda cari?">
                                        </div>
                                        <span class="fa fa-search"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/.navbar-collapse -->
                </div>
            </div>
        </section>
        <div id="slider" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item">
                    <img src="<?php echo base_assets()?>themes/web/img/slider.jpg">

                    <div class="container">
                        <div class="header-info">
                            <div class="col-sm-10 col-sm-offset-1">
                                <h1 class="wow bounceInLeft" data-wow-delay="1s">Bergerak, Terdalam, Terdepan</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_assets()?>themes/web/img/1250.jpg">
                    
                    <div class="container">
                        <div class="row header-info">
                            <div class="col-sm-10 col-sm-offset-1">
                                <h1 class="wow bounceInLeft" data-wow-delay="1s">Ambapers</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </header>

    <div class="mouse-icon hidden-xs">
        <div class="scroll"></div>
    </div>




    <!--About-->
    <section id="about" class="pad-sm">
        <div class="container">
            <div class="row margin-40">
                <div class="col-sm-8">
                    <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">tentang ambapers</h2>

                    <p class="wow fadeInDown" data-wow-delay="0.6s"><img src="<?php echo base_assets()?>themes/web/img/profile.jpg" align="left" width="40%">PT Ambang Barito Nusapersada (AMBAPERS ) adalah Perusahaan di bidang pengerukan dan pengelolaan alur Ambang Barito Banjarmasin dan fasilitas penunjangnya.
                        <br/><br/> Ambapers senantiasa memberikan kelancaran bagi arus pelayaran yang melalui alur baru Sungai Barito dengan tingkat keamanan yang optimal, melalui pengelolaan alur yang baik serta menyediakan fasilitas penunjang yang bermutu, sehingga kepuasan pelanggan terpenuhi. </p><br/>
                    <div class="text-center"><button class="btn btn-primary btn-sm">Selengkapnya</button><br/><br/></div>
                </div>
                <div class="col-sm-3 col-sm-push-1">
                    <ul class="sidebar-nav wow fadeInRight" data-wow-delay="0.3s">
                        <a href="#">
                            <li>Kalkulator PPPA</li>
                        </a>
                        <li>Data PPPA Tahunan</li>
                        <li>Cek Kurs Pajak</li>
                        <li>Layanan PPPA</li>
                        <li>Press Release</li>
                        <li>Mitra Strategis</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="layanan" class="pad-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center margin-30 wow fadeIn" data-wow-delay="0.6s">
                    <h2 class="section-title white">Layanan PPPA</h2>
                    <p class="lead">Permintaan Pelayanan Penggunaan Alur</p>
                    <p class="white">PPPA diperuntukkan bagi pelanggan yang membutuhkan layanan penggunaan alur Ambang Barito Banjarmasin disertai dengan fasilitas penunjang dengan mengedepankan kepuasan pelangan </p>
                    <br/><br/>
                    <ul class="step">
                        <li class="diamond wow pulse" data-wow-delay="0.8s">
                            <h1 class="white fa fa-file-text-o"></h1>
                            <p class="white text-center">Formulir PPPA</p>
                        </li>
                        <li class="diamond wow pulse" data-wow-delay="1.3s">
                            <h1 class="white fa fa-pencil"></h1>
                            <p class="white text-center middle">Pengisian Formulir serta Diperiksa, disetempel, ditandatangani petugas PT Ambapers</p>
                        </li>
                        <li class="diamond wow pulse" data-wow-delay="1.8s">
                            <h1 class="white fa fa-anchor"></h1>
                            <p class="white text-center">Penyerahan formulir ke bagian terkait</p>
                        </li>
                    </ul>
                    <div class="text-center"><button class="btn btn-primary btn-lg">Pelajari Lebih Lanjut</button></div>
                </div>
            </div>
        </div>
    </section>
    <section id="press" class="pad-sm light-gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section-title text-center">PRESS Release</h2>
                    <br />
                    <div class="row wow fadeInDown">
                        <div class="col-sm-4"><img src="<?php echo base_assets()?>themes/web/img/img-default.png" width="100%"></div>
                        <div class="col-sm-8 featured-news">
                            <h3><a href="#">Ambapers Optimis 2016 Raih Laba 24 Milyar</a></h3>
                            <p>Pada hari Rabu (28/12/2016) telah dilangsungkan Rapat Umum Pemegang Saham (RUPS) untuk pengesahan Taksiran Realisasi (Taksasi) anggaran 2016 dan Rencana Kerja Anggaran Perusahaan (RKAP) 2017. Berlangsung dengan penuh keakraban direksi PT Ambapers (Ambang Barito Nusapersada) menyampaikan optimisme raih laba 24 milyar.</p>
                            <small>21 Desember 2016 08:41:45</small>
                        </div>
                    </div>
                </div>
            </div>
            <br/><br/>
            <div class="row">
                <div class="col-sm-12">
                    <h3>BERITA TERKINI</h3>
                    <br />
                    <div class="row">
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.4s">
                            <div class="news-img">
                                <img src="<?php echo base_assets()?>themes/web/img/img-default.png" width="100%">
                                <a class="more" href="#">Baca Selengkapnya</a>
                            </div>
                            <div class="news-content">
                                <h4><a>Direksi Baru Ambapers Siap Tingkatkan 
Kinerja Perusahaan</a></h4>
                                <p>Bertempat di kantor PT Ambang Barito Nusapersada pada hari Kamis 8 Desember 2016 ...</p>
                                <small>21 Desember 2016 08:41:45</small>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.8s">
                            <div class="news-img">
                                <img src="<?php echo base_assets()?>themes/web/img/img-default.png" width="100%">
                                <a class="more" href="#">Baca Selengkapnya</a>
                            </div>
                            <div class="news-content">
                                <h4><a>Direksi Baru Ambapers Siap Tingkatkan 
Kinerja Perusahaan</a></h4>
                                <p>Bertempat di kantor PT Ambang Barito Nusapersada pada hari Kamis 8 Desember 2016 ...</p>
                                <small>21 Desember 2016 08:41:45</small>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="1.2s">
                            <div class="news-img">
                                <img src="<?php echo base_assets()?>themes/web/img/img-default.png" width="100%">
                                <a class="more" href="#">Baca Selengkapnya</a>
                            </div>
                            <div class="news-content">
                                <h4><a>Direksi Baru Ambapers Siap Tingkatkan 
Kinerja Perusahaan</a></h4>
                                <p>Bertempat di kantor PT Ambang Barito Nusapersada pada hari Kamis 8 Desember 2016 ...</p>
                                <small>21 Desember 2016 08:41:45</small>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="text-center"><button class="btn btn-primary btn-lg">Lihat Semua Berita</button></div>
                </div>
            </div>
        </div>
    </section>
    <section id="kontak" class="pad-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="section-title">Kontak Kami</h2>
                    <br/>
                    <div class="diamond-blue wow fadeInLeft" data-wow-delay="0.3s">
                        <h1 class="fa fa-map-marker"></h1>
                        <p class="text-center">Jl. Yos Sudarso No 6 - Banjarmasin Kode Pos 70119</p>
                    </div>
                    <div class="diamond-blue wow fadeInLeft" data-wow-delay="0.6s">
                        <h1 class="fa fa-phone"></h1>
                        <p class="text-center">Phone. 0511-4423345<br/>Fax. 0511-4423346</p>
                    </div>
                    <div class="diamond-blue wow fadeInLeft" data-wow-delay="0.9s">
                        <h1 class="fa fa-envelope-o"></h1>
                        <p class="text-center"> pelayanan@ambapers.com</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <footer class="pad-sm">
        <div class="container wow fadeInDown" data-wow-delay="0.3s">

            <div class="row">
                <div class="col-sm-2 text-center">
                    <img src="<?php echo base_assets()?>themes/web/img/logo.png"><br/><br/>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2 col-xs-6">
                            <h5 class="text-softblue">PROFIL AMBAPERS</h5>
                            <br/>
                            <p><a class="white">Tentang Kami</a></p>
                            <p><a class="white">Visi & Misi</a></p>
                            <p><a class="white">Tujuan</a></p>
                            <p><a class="white">Sejarah</a></p>
                            <p><a class="white">Moto Perusahaan</a></p>
                            <p><a class="white">Struktur Organisasi</a></p>
                            <br/>
                        </div>
                        <div class="col-sm-2 col-xs-6">
                            <h5 class="text-softblue">MEDIA</h5><br/>
                            <p><a class="white">Press Release</a></p>
                            <p><a class="white">Berita Terkini</a></p>
                            <p><a class="white">Galeri Kegiatan</a></p>
                            <br/>
                            <h5 class="text-softblue">MEDIA SOSIAL</h5>
                            <a href="http://facebook.com"><span class="fa fa-facebook-square white"></span></a>
                            <a href="http://twitter.com"><span class="fa fa-twitter-square white"></span>
                            <a href="http://youtube.com"><span class="fa fa-youtube-square white"></span>
                            <br/>
                        </div>
                        <div class="col-sm-8 col-xs-12 link">
                            <h5 class="text-softblue">LINK TERKAIT</h5><br/>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p><a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/pelindo3.png">&nbsp;PT Pelabuhan Indonesia III</a></p>
                            <p>
                                <a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/banua-kalsel.png">&nbsp;PT Bangun Banua KalSel</a>
                            </p>
                            <p>
                                <a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/van-oord.png">&nbsp;Van Oord Marine Ingenuity</a>
                            </p>
                            <p>
                                <a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/damen.png">&nbsp;Damen Shipyard</a>
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <p>
                                <a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/por.png">&nbsp;Port of Rotterdam</a>
                            </p>
                            <p>
                                <a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/cdp.png">&nbsp;Canal de Panama</a>
                            </p>
                            <p>
                                <a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/ihc.png">&nbsp;Royal IHC</a>
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <p>
                                <a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/jkt.png">&nbsp;Jakarta International Container Terminal</a>
                            </p>
                            <p>
                                <a class="white"><img src="<?php echo base_assets()?>themes/web/img/footer/dermaga.png">&nbsp;Majalah Dermaga</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">

            <p class="copyright" align="right">Copyright © 2017 PT Ambang Barito Nusapersada. All Right Reserved</p>
        </div>
        </div>

        </div>
    </footer>


    <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_assets()?>themes/web/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_assets()?>themes/web/js/wow.min.js"></script>
    <script src="<?php echo base_assets()?>themes/web/js/bootstrap.min.js"></script>
    <script src="<?php echo base_assets()?>themes/web/js/main.js"></script>


</body>

</html>