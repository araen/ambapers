<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_12">
            <article id="dashboard"> 
                <div>
                    <h1>Sistem Informasi Managemen Rs. Syuhada</h1>
                    <h2>Menu</h2>
                    <section class="icons">
                        <ul>
                            <li>
                                <a href="<?php echo "$uriclass/lst/GT"?>">
                                    <div class="dash home"></div>
                                    <span>Administrasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo "$uriclass/lst/SDM"?>">
                                    <div class="dash order"></div>
                                    <span>HRIS</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . "login/logout"?>">
                                    <div class="dash logout"></div>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </section>
                </div>
                <div>
                    <h2>Role</h2>
                    <ul>
                        <li>
                            <a href="<?php echo "$uriclass/setmenu/" . encrypt_url('GT_1_AD_1')?>">
                                <span><b>Administrator</b></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </article>
        </section>
    </section>
</section>
