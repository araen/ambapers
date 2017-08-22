<div class="actions" style="float: left;width:50%">
    <b>Cari : </b><input type="text" autocomplete="off" value="" id="q" name="q" placeholder="Cari Data Halaman">
    <input type="submit" value="Cari" class="button blue">
    <?php if(isset($arr_page_filter)) {
        foreach( $arr_page_filter as $row ) {
    ?>
        <br><span><?php echo $row?></span>
    <?php } 
    }?>
</div>