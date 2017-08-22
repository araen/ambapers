<form id="optiontable" name="optiontable" method="post">
    <div class="col-md-2" style="display: inline-block !important;">
        <div class="dataTables_length" id="example1_length">
            
            <?php 
                $a_limit = array(10 => '10 baris', 25 => '25 baris', 50 => '50 baris', 100 => '100 baris');

                echo createSelect('tablelimit', $a_limit, $limit, 'form-control', TRUE, 'aria-controls="example1" onchange="goLimit()"');
            ?>

        </div>
    </div>
    <div class="col-md-5">
        <div class="col-md-8">
            <!--<input type="search" name="cari" class="form-control" placeholder="Cari Data" aria-controls="example1">-->
            <?php echo createTextBox('cari', $find, 'form-control', NULL, NULL, TRUE, 'placeholder="Cari Data" aria-controls="example1" autocomplete="off"')?>
        </div>
        <div class="col-md-4">
            <input id="btn-a" type="submit" class="btn btn-primary" name="btncari" value="cari">
            <input id="btn-a" type="submit" class="btn btn-warning" name="btnreset" value="reset">
        </div>
    </div>
</form>
<div class="col-md-5">
    <?php $button->render()?>
</div>
<br><br><br>