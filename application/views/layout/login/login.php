<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel" class="pull-left">
                        <img src="<?php echo base_assets()?>themes/login/images/logo.png" width="94" height="119" />
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Selamat datang di halaman administrasi ambapers.com</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Artikel dan Berita</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Galeri Photo</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Kalkulator TPPA</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> WYSIWYG CKEditor</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> dan banyak lagi...</li>
                    </ul>
                    <div class="mb20"></div>
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
                <form method="post" action="<?php echo base_url('gate/sso')?>">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                
                    <input type="text" name="username" class="form-control uname" placeholder="Username" />
                    <input type="password" name="password" class="form-control pword" placeholder="Password" />
                    <a href="#"><small>Forgot Your Password?</small></a>
                    <button class="btn btn-success btn-block">Sign In</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2017. All Rights Reserved. PT Ambang Barito Nusapersada
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>


<script src="<?php echo base_assets()?>themes/login/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_assets()?>themes/login/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_assets()?>themes/login/js/bootstrap.min.js"></script>
<script src="<?php echo base_assets()?>themes/login/js/modernizr.min.js"></script>
<script src="<?php echo base_assets()?>themes/login/js/retina.min.js"></script>
<script src="<?php echo base_assets()?>themes/login/js/custom.js"></script>