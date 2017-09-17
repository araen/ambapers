<div class="pajak">
   <?php include 'test.php'?>   
<!--	<div class="item head">
        <div class="col01">Kurs</div>
        <div class="col02">Nilai</div>
    </div>
    <div class="item head">
        <div class="col01">Kurs</div>
        <div class="col02">Nilai</div>
    </div>
    <?php
    $jumlah = 20;
    for($i=1;$i<=$jumlah;$i++){
          $rep = strip_tags($this->pajak_view[$i]);
          $rep = preg_replace( "#\s{2,}#i", " ", $rep );
          $rep = str_replace("&nbsp;", "", $rep);
          $rep = str_replace(" ", "", $rep)."<br>";
          $col1 = substr($rep,1,3)." ";
          $col2 = substr($rep,4);
          $col2 = substr($col2,0,-6);
          if(fmod($i,2)!=0){
                echo "<div class='item odd'><div class='col01'>".$col1."</div><div class='col02'>".$col2."</div></div>";
          }else{
                echo "<div class='item even'><div class='col01'>".$col1."</div><div class='col02'>".$col2."</div></div>";
          }
    }
    ?>
-->     
     <div class="item data">
		<!--<?php echo $this->pajak_tanggal; ?><br />-->
        Referensi sumber kurs pajak lainnya: 
        <a href="http://fiskal.kemenkeu.go.id/dw-kurs-db.asp" target="_blank">http://fiskal.kemenkeu.go.id</a> <br>
        <a href="http://beacukai.go.id/" target="_blank">http://beacukai.go.id</a>   <br>
        <a href="http://pajak.go.id/" target="_blank">http://pajak.go.id</a>   <br>
        atau hubungi counter PPA Ambapers
     </div>
</div>
