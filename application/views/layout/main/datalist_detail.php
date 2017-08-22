<?php $pageheader->render()?>

<?php 

    $n_col = round(count($a_kolom)/2); 
    
    $p_key = getKeyValue($key, $row);

?>

<div class="content-wrapper">  
    <section class="content">  
        <form id="form_edit" method="post" action="<?php echo base_url($pageurl."/edit/$p_key")?>">    
        <div class="box box-warning"> 
            <div class="box-body">
                <div class="row bord-bottom">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <a href="<?php echo base_url($pageurl)?>" id="btn-back" type="button" class="btn btn-primary">Kembali</a>
                            <a href="<?php echo base_url($pageurl."/edit/$p_key")?>" id="btn-save" type="button" class="btn btn-warning">Edit</a>
                            <button id="btn-save" type="button" class="btn btn-success" onclick="goSave();">Simpan</button>
                            <input id="btn-delete" type="button" class="btn btn-danger" value="Hapus">
                        </div>
                    </div>
                </div>          
                <div class="row">
                    <div class="col-md-12">
                        <?php if( isset($a_kolom) ) {?>
                        <div class="col-md-6">
                            <?php for ( $i = 0; $i < $n_col; $i++ ) {
                                if ( isset($a_kolom[$i]) ) {
                                    $col = $a_kolom[$i]; ?>

                                    <div class="row bord-bottom">
                                        <label class="col-md-5" for="<?php echo $col['kolom'] ?>"> <?php echo $col['label']?> </label>
                                        <div class="col-md-7">
                                            <?php echo getInput($col, $isedit, $row[$col['kolom']])?>
                                        </div>
                                    </div>

                            <?php } $n++; }?>
                        </div>
                        <div class="col-md-6">
                            <?php for ( $i = $n; $i < ($n + $n_col); $i++ ) {
                                if ( isset($a_kolom[$i]) ) {
                                    $col = $a_kolom[$i]; ?>

                                    <div class="row bord-bottom">
                                        <label class="col-md-5" for="<?php echo $col['kolom'] ?>"> <?php echo $col['label']?> </label>
                                        <div class="col-md-7">
                                            <?php echo getInput($col, $isedit, $row[$col['kolom']])?>
                                        </div>
                                    </div>
                            <?php } } ?>
                        <?php }?>
                        </div>                  
                    </div>
                </div>
                <div class="clear"></div>

                <!-- TABLE -->
                <?php if( $a_kolomdetail ) {?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead style="background:#1d1e21; color:#f0f1f2">
                            <th></th>
                            <?php 
                            if ( isset($a_kolomdetail) ) {
                            foreach ( $a_kolomdetail as $col ) {?>
                                <th <?= isset($col['add']) ? $col['add'] : ''?>><?php echo $col['label']?></th>
                            <?php } }?>
                            <th width="7%" align="center">Aksi</th>
                        </thead>
                            <tbody>
                                <form id="update-inline" method="post">
                                    <?php 
                                    foreach ( $a_datadetail as $row ) {
                                        $p_key = getKeyValue($key, $row);
                                    ?>
                                        <tr>
                                            <td><?php echo ++$offset?></td>
                                            <?php foreach( $a_kolomdetail as $col ) {?>
                                                <td><?= getInputUpdateInPlace($col, $row[$col['kolom']], $u_key, $p_key)?></td>
                                            <?php }?>
                                            
                                            <td align="center">
                                                <a href="<?= base_url($pageurl .'/detail/'. $p_key)?>">
                                                    <span class="btn btn-xs btn-info" title="Edit">
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                    </span>
                                                </a>
                                                <a href="<?= base_url($pageurl .'/delete/'. $p_key)?>" onclick="return confirm('<?= lang('db_delete_confirm')?>')">
                                                    <span class="btn btn-xs btn-danger" title="Hapus">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </form>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <?php }?>
                <!--END TABLE-->                 
                    
                </div>
                <!-- END OF TABLE -->

            </div>
        </div>  
    
    </section>
</div>

<?php
    $this->load->view($script_path . '/data_detail_script.php');
?>