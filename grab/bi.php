<?php
    header('Content-type: application/json');

    require_once('simple_html_dom.php');
    require_once('grab.class.php');
    
    $url = 'http://www.bi.go.id/id/moneter/informasi-kurs/transaksi-bi/Default.aspx';
    
    #persistance
    $i = 0;
    do
    {
        $grab = Grab::grabbing($url, 'bi.html');

        $i++;
    } 
    while ( !$grab and $i < 5 );

    if( $grab )
    {
        $dom = str_get_html($grab);

        foreach($dom->find("table#ctl00_PlaceHolderMain_biWebKursTransaksiBI_GridView1") as $html) 
        {
            foreach($html->find('tr') as $tr) 
            {               
                foreach( $tr->find('span,input,select,br,td.alignRight') as $sp )
                    $sp->clear();

                $td = str_replace('<td style="text-align:right;">', ' ', $tr->outertext);
                
                $a_tag[] = str_replace("&nbsp;", '', preg_replace('#\<(.*?)\>#', '', $td));
            }
        }
        
        $max    = count($a_tag);    
        $kurs   = array();
        
        for( $i = 1; $i <= ($max - 1); $i++ ) 
        {
            #change decimal separator from (,) to (.)
            $a_tag[$i] = str_replace(',', '', $a_tag[$i]);
            
            $trim = explode(' ', trim($a_tag[$i]));

            $n = 0;
            $name = $trim[0];
            
            $kurs[$name][$n] = $trim[$n];
            
            for ( $j = 1; $j <= count($trim); $j++ ) 
            {
                if( !empty($trim[$j]) )
                    $kurs[$name][++$n] = $trim[$j];    
            }            
        }
        
        echo json_encode($kurs);
        
        Grab::createResultFile('result_kurs_bi.json', json_encode($kurs));
    }
?>
