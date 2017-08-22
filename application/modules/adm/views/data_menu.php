<div class="content-wrapper">
    <section class="content">  
        <div class="box box-warning">
            <div class="box-body">

            <!--TABLE-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead style="background:#1d1e21; color:#f0f1f2">
                        <?php 
                        if ( isset($a_kolom) ) {
                        foreach ( $a_kolom as $col ) {?>
                            <th <?= isset($col['add']) ? $col['add'] : ''?>><?php echo $col['label']?></th>
                        <?php } }?>
                        <th width="15%" align="center">AKSI</th>
                    </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!--END TABLE-->                 
                
            </div>
        </div>
    </section>
</div>

<?php
    $this->load->view($script_path . '/list_master_script.php');
?>