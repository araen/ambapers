<script type="text/javascript">
function getData(){
	if(jQuery("#tahun").val() != 'null'){
		jQuery.ajax({
			type: 'POST',
			url: '<?php echo base_url()?>home/pppa',
			data: {tahun:jQuery("#tahun").val()},
			success: function(data) {
				jQuery("#ajaxDiv div").remove();
				jQuery("#ajaxDiv").append(data);
			}
		});
	}
}
</script>          
<form>
<div class="tabitem">
	<label>Tahun </label>
	<select id="tahun" name="pppa" onchange="getData()" class="selectmenu">
		<option value=null>--select one--</option>
	<?php 
		foreach($this->tahun_pppa->result() as $tahun){
			echo "<option value=".$tahun->tahun.">".$tahun->tahun."</option>";
		}
	?>
	</select>
</div>
</form>
<br />
<div id='ajaxDiv'></div>
</body>
</html>