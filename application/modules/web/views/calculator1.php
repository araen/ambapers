<form action="index.php" method="post" name="form_pppa" id="form_pppa">
<div class=" calc">
	<div class="tabitem">
    	<label>Jenis Muatan</label>
        <select name="jenis" onchange="jenisChange()" class="selectmenu"> 
        <option value=0 selected>-- select one --</option>
        <?php foreach($this->calculator->result() as $jenis){
                    echo "<option value=".$jenis->id.">".$jenis->jenis_muatan."</option>";
        }?>
        </select>
    </div>
    <div class="tabitem">
        <label>Mata Uang</label>
        <select name="matauang" onchange="tarifChange()" class="selectmenu">
        <option value=3 selected>-- select one --</option> 
        <option value=1>USD</option>
        <option value=2>IDR</option>
        </select>
    </div>
    <div class="tabitem">
    	<label>Berat Muatan</label>
        <input align="left" type="text" name="berat" id="berat" size="17" style="text-align: right;" autocomplete="off" onkeyup="addSeparator(this)" onkeypress="runEnter(event)"/>
    </div>
    <div class="tabitem">
    	<label>Satuan Muat</label>
        <input type="text" name="satuan" id="satuan" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>
    <div class="tabitem">
    	<label>Tarif/Satuan</label>
        <input type="text" name="tarif" id="tarif" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>
    <div class="tabitem">
    	<label>Nilai</label>
        <input type="text" name="nilai" id="nilai" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>
    <div class="tabitem">
    	<label>PPN (10%)</label>
        <input type="text" name="ppn" id="ppn" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>
    <div class="tabitem">
    	<label>Total</label>
        <input type="text" name="total" id="total" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>
    <div class="tombol">
    	<input type="button" name="submit" value="<?php echo "Hitung"; ?>" onClick="calculate_pppa();" class="button" />        
    </div>
    <div class="tabitem">
        <label></label>
    </div>
</div>
</form>

<script type="text/javascript">
var ArrMuatan = new Array(<?php echo count($this->calculator->result())?>);

<?php
foreach($this->calculator->result() as $rec){
    echo "ArrMuatan[$rec->id] = new Array(2);";
    echo "ArrMuatan[$rec->id][0] = '$rec->satuan';";
    echo "ArrMuatan[$rec->id][1] = $rec->tarif_usd;";
    echo "ArrMuatan[$rec->id][2] = $rec->tarif_idr;";
} 
?>

function jenisChange(){
    var form = document.form_pppa;
    var jenis = form.jenis.value;
    form.satuan.value = ArrMuatan[jenis][0];
    form.berat.value = '';
    form.nilai.value = '';
    form.ppn.value = '';
    form.total.value = '';
    form.tarif.value ='';
    form.matauang.value=3; 
}

function tarifChange(){
    var form = document.form_pppa;
    var jenis = form.jenis.value;
    var matauang = form.matauang.value;
    form.tarif.value = ArrMuatan[jenis][matauang];
    form.berat.value = '';
    form.nilai.value = '';
    form.ppn.value = '';
    form.total.value = '';
}

function calculate_pppa(){
    var form = document.form_pppa;
    var berat = form.berat.value;
    var tarif = form.tarif.value;
    var satuan = form.tarif.value;
            
    berat = berat.replace(",","");
    var nilai = (berat*tarif).toFixed(2);
    var ppn = ((10/100)*nilai).toFixed(2);
    var total = (parseFloat(nilai)+parseFloat(ppn)).toFixed(2);
            
    /*Cetak*/
    form.nilai.value = addCommas(nilai);
    form.ppn.value = addCommas(ppn);
    form.total.value = addCommas(total);
}

function addSeparator(fldID) { 
var posCaret = getPosition(fldID); 
var fldVal = fldID.value; 
if((fldVal.length === 3 || 7 || 11) && (fldVal.length === posCaret)) { 
  posCaret = posCaret +1;  
  } 
       nStr = fldVal.replace(/,/g,'');    
        nStr += ''; 
        x = nStr.split('.'); 
         x1 = x[0]; 
       x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/; 
        while (rgx.test(x1)) { 
           x1 = x1.replace(rgx, '$1' + ',' + '$2'); 
          } 
        fldID.value = x1+x2; 
       setCaretPosition(fldID, posCaret); 
    }

 function setCaretPosition(elem, caretPos) {
      if(elem != null) {
           if(elem.createTextRange) {
            var range = elem.createTextRange();
               range.move('character', caretPos);
              range.select();
         }
         else {
             if(elem.selectionStart) {
                elem.focus();
              elem.setSelectionRange(caretPos, caretPos);
            }
       else
          elem.focus();
          }
     }
 }
 function getPosition(amtFld) {
     var iCaretPos = 0;
     if (document.selection) { 
       amtFld.focus ();
       var oSel = document.selection.createRange ();
       oSel.moveStart ('character', - amtFld.value.length);
       iCaretPos = oSel.text.length;
     }
     else if (amtFld.selectionStart || amtFld.selectionStart == '0')
       iCaretPos = amtFld.selectionStart;
     return(iCaretPos);
   }
 
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function runEnter(e) {
    if (e.keyCode == 13) {
        this.calculate_pppa();
    }
}

</script>
