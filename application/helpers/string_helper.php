<?php 

    function debug($vars, $is_die = TRUE)
    {
        if( is_object($vars) )
        {
            var_dump($vars);
        }
        else if( is_array($vars) ) 
        {
            echo "<pre>";
            print_r($vars);
            echo "</pre>";
        }
        else 
        {
            echo $vars;    
        }   
        
        if( $is_die )
            die();
    }

    function strToRand($length=0){
        $alphaNumeric= "ABCDEFGHIJKLMNOPQRSTUVWXYZ
                        abcdefghijklmnopqrstuvwxyz
                        1234567890";
        
        return substr(str_shuffle($alphaNumeric), 0, $length);    
    }

    function strToRomawi($n){
        $hasil = '';
        $iromawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X',20=>'XX',30=>'XXX',40=>'XL',50=>'L',
        60=>'LX',70=>'LXX',80=>'LXXX',90=>'XC',100=>'C',200=>'CC',300=>'CCC',400=>'CD',500=>'D',600=>'DC',700=>'DCC',
        800=>'DCCC',900=>'CM',1000=>'M',2000=>'MM',3000=>'MMM');
        
        if(array_key_exists($n,$iromawi)){
            $hasil = $iromawi[$n];
        }elseif($n >= 11 && $n <= 99){
            $i = $n % 10;
            $hasil = $iromawi[$n-$i] . romawi($n % 10);
        }elseif($n >= 101 && $n <= 999){
            $i = $n % 100;
            $hasil = $iromawi[$n-$i] . romawi($n % 100);
        }else{
            $i = $n % 1000;
            $hasil = $iromawi[$n-$i] . romawi($n % 1000);
        }
        
        return $hasil;
    }
    
    function strTerbilang( $num ,$dec=4){
        $stext = array(
            "Nol",
            "Satu",
            "Dua",
            "Tiga",
            "Empat",
            "Lima",
            "Enam",
            "Tujuh",
            "Delapan",
            "Sembilan",
            "Sepuluh",
            "Sebelas"
        );
        $say  = array(
            "Ribu",
            "Juta",
            "Milyar",
            "Triliun",
            "Biliun"
        );
        $w = "";

        if ($num <0 ) {
            $w  = "Minus ";
            $num *= -1;
        }

        $snum = number_format($num,$dec,",",".");

        $strnum =  explode(".",substr($snum,0,strrpos($snum,",")));

        $koma = substr($snum,strrpos($snum,",")+1);

        $isone = substr($num,0,1)  ==1;
        if (count($strnum)==1) {
            $num = $strnum[0];
            switch (strlen($num)) {
                case 1:
                case 2:
                    if (!isset($stext[$strnum[0]])){
                        if($num<19){
                            $w .=$stext[substr($num,1)]." Belas";
                        }else{
                            $w .= $stext[substr($num,0,1)]." Puluh ".
                                (intval(substr($num,1))==0 ? "" : $stext[substr($num,1)]);
                        }
                    }else{
                        $w .= $stext[$strnum[0]];
                    }
                    break;
                case 3:
                    $w .=  ($isone ? "Seratus" : terbilang(substr($num,0,1)) .
                        " Ratus").
                        " ".(intval(substr($num,1))==0 ? "" : terbilang(substr($num,1)));
                    break;
                case 4:
                    $w .=  ($isone ? "Seribu" : terbilang(substr($num,0,1)) .
                        " Ribu").
                        " ".(intval(substr($num,1))==0 ? "" : terbilang(substr($num,1)));
                    break;
                default:
                    break;
            }
        }else{
            $text = $say[count($strnum)-2];
            $w = ($isone && strlen($strnum[0])==1 && count($strnum) <=3? "Se".strtolower($text) : terbilang($strnum[0]).' '.$text);
            array_shift($strnum);
            $i =count($strnum)-2;
            foreach ($strnum as $k=>$v) {
                if (intval($v)) {
                    $w.= ' '.terbilang($v).' '.($i >=0 ? $say[$i] : "");
                }
                $i--;
            }
        }
        $w = trim($w);
        if ($dec = intval($koma)) {
            $w .= " Koma ". terbilang($koma);
        }
        return trim($w);
    }

    /**
     * Menambahkan format pada bilangan
     * @param float $num
     * @param integer $dec berapa angka dibelakang koma
     * @param boolean $ceknull
     * @return string
     */
    function strNumber($num, $dec = null, $ceknull = false) {
        if ($ceknull and ! isset($num))
            return null;

        list(, $left) = explode('.', strval($num));

        $left = (float) $left;
        if (empty($left))
            $len = 0;
        else
            $len = strlen($left);

        if (!isset($dec))
            $dec = $len;

        return number_format($num, $dec, ',', '.');
    }

    function strCurrency()
    {
        $curr['AUD'] = "Australian Dollar"; 
        $curr['BND'] = "Brunei Darussalam Dolar";  
        $curr['CAD'] = "Canadian Dollar";
        $curr['CHF'] = "Swiss Franc";
        $curr['CNY'] = "China Yuan";
        $curr['CNH'] = "China Renminbi";
        $curr['DKK'] = "Danish Krone";
        $curr['EUR'] = "EURO Spot Rate";
        $curr['GBP'] = "British Pound";   
        $curr['HKD'] = "Hongkong Dollar"; 
        $curr['INR'] = "India Rupee"; 
        $curr['JPY'] = "Japanese Yen";
        $curr['KRW'] = "Korea Selatan Won";
        $curr['KWD'] = "Kuwait Dinar";
        $curr['LAK'] = "Laos Kip";
        $curr['LKR'] = "Sri Lanka Rupee";
        $curr['MYR'] = "Malaysia Ringgit";
        $curr['MMK'] = "Myanmar Kyat";
        $curr['NOK'] = "Norwegian Krone";
        $curr['NZD'] = "New Zealand Dollar";  
        $curr['PGK'] = "Papua Nugini Kina"; 
        $curr['PHP'] = "Filipina Peso"; 
        $curr['PKR'] = "Pakistan Rupee"; 
        $curr['SAR'] = "Saudi Arabian Real";
        $curr['SEK'] = "Swedish Krona";
        $curr['SGD'] = "Singapore Dollar";
        $curr['THB'] = "Thailand Baht";
        $curr['USD'] = "United States Dollar";
        $curr['VND'] = "Vietnam Dong";

        return $curr;
    }

?>