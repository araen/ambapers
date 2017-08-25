<?php 
    $p_key = getKeyValue($key, $row);
?>

<div class="contentpanel">  
    <section class="content">  
        <form id="form_edit" class="form-horizontal form-bordered" method="post" action="<?php echo base_url($pageurl."/edit/$p_key")?>">    
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
                </div> </br>          
                <div class="row panel panel-default">
                    <div class="col-md-12">
                        <?php if( isset($a_kolom) ) {?>
                        <div class="col-md-12 panel-body">
                            <?php foreach ( $a_kolom as $col ) { ?>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-12" for="<?php echo $col['kolom'] ?>"> <?php echo $col['label']?> </label>
                                        <?php echo getInput($col, $isedit, $row[$col['kolom']])?>
                                    </div>

                            <?php $n++; }?>
                        </div> 
                        <?php }?>                 
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div> 
        </form>    
    </section>
</div>

<?php
    $this->load->view($script_path . '/data_detail_script.php');
?>