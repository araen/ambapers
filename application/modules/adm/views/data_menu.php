<div class="pull-right">
    <a href="<?php echo base_url($pageurl)?>" class="btn btn-sm btn-info" type="button" title="Kembali">
        <span >
            <i class="glyphicon glyphicon-backward"></i> Kembali
        </span>
    </a>
    <a href="<?php echo base_url($pageurl.'/add')?>" class="btn btn-sm btn-success" type="button" title="Tambah Data">
        <span >
            <i class="glyphicon glyphicon-plus"></i> Tambah Data
        </span>
    </a>
</div>

<br><br>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-5" for="name"> <b>Menu</b> </label>
                <div class="col-md-7">
                    Judul                                        
                </div>
            </div>
        </div>
    </div>
</div>

<br>

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
                        if ( isset($l_kolom) ) {
                        foreach ( $l_kolom as $col ) {?>
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