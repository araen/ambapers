<?php //$pageheader->render()?>

<?php $pagefilter->render()?>

<div class="content-wrapper">
    <section class="content">  
        <div class="box box-warning">
            <div class="box-body">

            <!--TABLE-->
            <div class="row">

                <?php $optiontable->render()?>

                <div class="col-sm-12">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead style="background:#1d1e21; color:#f0f1f2">
                        <th>No.</th>
                        <?php 
                        if ( isset($a_kolom) ) {
                        foreach ( $a_kolom as $col ) {?>
                            <th <?= isset($col['add']) ? $col['add'] : ''?>><?php echo $col['label']?></th>
                        <?php } }?>
                        <th width="10%" align="center">Aksi</th>
                    </thead>
                        <tbody>
                            <form id="update-inline" method="post">
                                <?php 
                                foreach ( $a_data['data'] as $row ) {
                                    $p_key = getKeyValue($key, $row);
                                ?>
                                    <tr>
                                        <td><?php echo ++$offset?></td>
                                        <?php foreach( $a_kolom as $col ) {?>
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
            <!--END TABLE-->

            <?php $pagination->render();?>                 
                
            </div>
        </div>
    </section>
</div>

<?php
    $this->load->view($script_path . '/list_data_script.php');
?>