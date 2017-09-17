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
                            <form id="update-inline" method="post">
                                <?php 
                                foreach ( $a_data as $row ) {
                                    $p_key = getKeyValue($key, $row);
                                ?>
                                    <tr>
                                        <?php foreach( $a_kolom as $col ) {?>
                                            <td><?= getInputUpdateInPlace($col, $row[$col['kolom']], $u_key, $p_key)?></td>
                                        <?php }?>
                                        
                                        <?php if( $u_key == $p_key ) { ?>
                                            <td align="center">
                                                <input type="hidden" name="act" value="updateinline"> 
                                                <span class="btn btn-xs btn-success" title="Simpan" onclick="goUpdateInline()">
                                                    <i class="glyphicon glyphicon-floppy-disk"></i>
                                                </span>
                                            </td>
                                        <?php } else{?>
                                            <td align="center">
                                                <a href="<?= base_url($pageurl .'/listdetail/'. $p_key)?>">
                                                    <span class="btn btn-xs btn-warning" title="Detail">
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                    </span>
                                                </a>
                                                <a href="<?= base_url($pageurl .'/lst/'. $p_key)?>">
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
                                        <?php }?>
                                    </tr>
                                <?php }?>
                            </form>
                            
                            <?php if( !$u_key ) {?>
                                <form id="insert-inline" method="post">
                                    <tr>
                                        <?php foreach ( $a_kolom as $col ) {?>
                                        <td><?php echo getInputInsertInPlace($col)?></td>                
                                        <?php }?>
                                        <td align="center">
                                            <input type="hidden" name="act" value="insertinline"> 
                                            <span class="btn btn-xs btn-success" title="Simpan" onclick="goSaveInline()">
                                                <i class="glyphicon glyphicon-floppy-disk"></i>
                                            </span>
                                        </td>
                                    </tr>
                                </form>
                            <?php }?>
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