<?php
    header('Content-type: application/json');
    
    require_once('simple_html_dom.php');
    require_once('grab.class.php');
    
    $url = 'http://www.fiskal.kemenkeu.go.id/dw-kurs-db.asp';
    
    #persistance
    $i = 0;
    do
    {
        $grab = Grab::grabbing($url, 'pajak.html');

        $i++;
    }
    while( !$grab and $i < 5 );

    if( $grab )
    {
        $dom = str_get_html($grab);
        
        foreach($dom->find("table.table") as $html) 
        {
            foreach( $html->find('tr') as $tr ) 
            {
                foreach( $tr->find('img') as $sp )
                    $sp->clear();
                    
                $a_tag[] = preg_replace('#\<(.*?)\>#', '', $tr->outertext);
            }
        }
        
        $tax    = array();
        
        foreach( $a_tag as $row )
        {
            #get currency
            preg_match('#\((.*?)\)#', $row, $match);
            $curr =  $match[1];

            #get number
            $tag = explode(')', $row);
            list($num, $percent) = explode(' ', $tag[1]);
            $number = str_replace(',','',$num); 
            
            #tax reference
            $tax[$curr] = $number;  
        }
        
        echo json_encode($tax);
        
        Grab::createResultFile('result_pajak.json', json_encode($tax));
    }
?>
