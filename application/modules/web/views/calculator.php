<form action="index.php" method="post" name="form_pppa" id="form_pppa">
<div class=" calc">   
    <b>[ Estimasi Biaya Jasa Alur Per 1 Juli 2016 ]</b>
    <br>Yang Menerapkan Bea Meterai untuk Transaksi PPA.
    <br>
    Mohon Isikan Kurs Pajak yang berlaku per Tanggal Pengesahan PPPA <br>
    Mohon perhatikan Penggunaan Pemisah Desimal,<br>
    <b>Desimal menggunakan titik [ . ] untuk Berat Muat!</b>
	<div class="tabitem">
    	<label>Jenis Muatan</label>
        <select name="jenis" onchange="jenisChange()" class="selectmenu"> 
        <option value=0 selected>-- select one --</option>
        <?php foreach($this->calculator->result() as $jenis){
                    echo "<option value=".$jenis->id.">".$jenis->jenis_muatan."</option>";
        }?>                     
        </select>
    </div>
<!--    <div class="tabitem">
        <label>Mata Uang</label>
        <select name="matauang" onchange="tarifChange()" class="selectmenu">
        <option value=3 selected>-- select one --</option> 
        <option value=1>USD</option>
        <option value=2>IDR</option>
        </select>
    </div> -->
    <div class="tabitem">
    	<label>Berat Muatan</label>
        <input align="right" type="text" name="berat" id="berat" size="17" style="text-align: right;" autocomplete="off" onkeyup="addSeparator(this)" onkeypress="kursFocus(event)"/>
    </div>
    <div class="tabitem">
        <label>Kurs Pajak</label>
        <input align="right" type="text" name="kpjk" id="kpjk" size="17" style="text-align: right;" autocomplete="off" onkeyup="addSeparator(this)" onkeypress="runEnter(event)"/>
    </div>    
    <div class="tabitem">
    	<label>Satuan Muat</label>
        <input type="text" name="satuan" id="satuan" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>
    <div class="tabitem">
    	<label>Tarif [USD]</label>
       <input type="text" name="tarif" id="tarif" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>

    <div class="tabitem">
    	<label>Nilai [IDR]</label>
        <input type="text" name="nilai" id="nilai" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>
    <div class="tabitem">
    	<label>PPN (10%) [IDR]</label>
        <input type="text" name="ppn" id="ppn" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>    
    <div class="tabitem">
        <label>Bea Materai</label>
        <input type="text" name="matr" id="matr" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/> 
    </div>
    <div class="tabitem">
    	<label>Total [IDR]</label>
        <input type="text" name="total" id="total" size="17"  readonly style="background-color:#fffffff; text-align: right;" class="inputbox"/>
    </div>
    <div class="tombol">
    	<input type="button" name="submit" value="<?php echo "Hitung"; ?>" onClick="calculate_pppa();" class="button" />        
    </div>
    <div class="tabitem">
        <label></label>
    </div>    
        <br>  Hasil Perhitungan Ini Merupakan <b>Estimasi</b>, Jika Terdapat Perbedaan Karena Entry Kurs Pajak, 
              Maka yang <b>Dianggap Benar Adalah Hasil Perhitungan Pada Aplikasi di Loket PPSA/PPPA</b>
</div>
</form>

<script type="text/javascript">
var ArrMuatan = new Array(<?php echo count($this->calculator->result())?>);

<?php
foreach($this->kurs->result() as $row){
    echo "var kurs='".$row->value."';";
}

foreach($this->calculator->result() as $rec){
    echo "ArrMuatan[$rec->id] = new Array(2);";
    echo "ArrMuatan[$rec->id][0] = '$rec->satuan';";
    echo "ArrMuatan[$rec->id][1] = $rec->tarif_usd;";
    //echo "ArrMuatan[$rec->id][2] = $rec->tarif_idr;";
} 
?>

function jenisChange(){
    var form = document.form_pppa;
    var jenis = form.jenis.value;
    form.satuan.value = ArrMuatan[jenis][0];        
    form.berat.value = '';
    form.nilai.value = '';
    form.ppn.value = '';       
    form.matr.value = '';     
    form.total.value = '';
    form.berat.focus();
    form.tarif.value = ArrMuatan[jenis][1];  
    form.kurs.value=kurs;
    form.matauang.value=3; 
}

/*function tarifChange(){
    var form = document.form_pppa;
    var jenis = form.jenis.value;
    var matauang = form.matauang.value;
    form.tarif.value = ArrMuatan[jenis][matauang];       
    form.berat.value = '';
    form.nilai.value = '';
    form.ppn.value = '';
    form.total.value = '';
}  */

function calculate_pppa(){
    var form = document.form_pppa;
    var berat = form.berat.value;
    var tarif = form.tarif.value;
    var satuan = form.tarif.value;
    var kpjk = form.kpjk.value;   
    var matr = form.matr.value;  
                                    
    berat = berat.replace(/,/g ,"");
    kpjk = kpjk.replace(/,/g ,"");
    var nilai = Math.round(berat*tarif*kpjk,0);
    var ppn = Math.round((10/100)*nilai,0);
    /*var total = (parseFloat(nilai)+parseFloat(ppn)).toFixed(2);*/
    var total = Math.round((nilai + ppn+6000)*100)/100;
    var matr = Math.round(6000);       
        
    /*Cetak*/
    form.nilai.value = addCommas(nilai);
    form.ppn.value = addCommas(ppn);
    form.matr.value = addCommas(matr); 
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

function kursFocus(e) {
    if (e.keyCode == 13) {
        document.getElementById("kpjk").focus();
    }
}

</script>
