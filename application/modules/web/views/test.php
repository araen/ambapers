<?php
   include 'dom.php';
?>
<?php
    
$source = file_get_html('http://beacukai.go.id/');            
?>
        <hr>
        <?php
        $element=$source->find('p',6);
        echo "<div style='text-align: justify'><b>".$element->plaintext."</b></div>";        
        echo "<br>";
        $element=$source->find('td',0);
        echo "<br>"; //"<hr>";
        echo "<div style='font-size: 20px; text-align: center'>".$element->plaintext;;    
        echo ' = ';
        $element=$source->find('td',3);              
        $element=str_replace(".","",$element->plaintext);
        $element=number_format($element,2,'.',',');
        echo "<b>".$element."</b>&nbsp;IDR";     
        ?>
     </div>
     <hr>
     <div class="item data" style="text-align: justify;">
     Data tersebut adalah otomatis mengambil dari web site <a href="http://beacukai.go.id/" target="_blank">http://www.beacukai.go.id</a>,
     jika pada website ini belum terupdate sampai pada hari ini tanggal <b><?php echo date("d M Y");?></b>, 
     silakan langsung menuju link sumber referensi data kami
     <br><br>
     
     </div>
<hr>                                  

