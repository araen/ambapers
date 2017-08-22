<?php

    function dateIndo($date=0, $day=false, $time=false, $format=0){ // 0=01 Januari 1970,1 = 01/01/1970
        $bulan = getBulan();
        $hari = getHari();
        
        $d = date('d',strtotime($date));
        $m = date('m',strtotime($date));
        $y = date('Y',strtotime($date));
        $n = date('N',strtotime($date));
        $t = date('H:i',strtotime($date));
        
        if($day){
            switch($format){
                case 0 : $date = $hari[$n].", ".$d." ".$bulan[$m]." ".$y." ";
                break;
                case 1 : $date = "$hari[$n], $d/$m/$y ";
            }
        }else{
            $date = $d." ".$bulan[$m]." ".$y." ";
        }    
        if($time)
            $date .= $t;
            
        return $date;
    }
    
    function dateToIndo($date){
        $BulanIndo = array("Januari", "Februari", "Maret",
                           "April", "Mei", "Juni",
                           "Juli", "Agustus", "September",
                           "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);
        $jam   = substr($date, 11, 8);
        
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun." ".$jam;        
        return($result);
    }

    function diffTime($time1, $time2, $type='d'){
        $diff = $time1 - $time2;
        $arrDiff['d'] = floor($diff/86400);
        $sisa = $diff % 86400;
        $arrDiff['h'] = floor($sisa/3600);
        $sisa = $sisa % 3600;
        $arrDiff['m'] = floor($sisa/60);
        
        return $arrDiff[$type]; 
    }
    
    function getBulan($full=true){
        if($full){
            $bulan=array(
                '01'=>'Januari',
                '02'=>'Pebruari',
                '03'=>'Maret',
                '04'=>'April',
                '05'=>'Mei',
                '06'=>'Juni',
                '07'=>'Juli',
                '08'=>'Agustus',
                '09'=>'September',
                '10'=>'Oktober',
                '11'=>'November',
                '12'=>'Desember'
            );
        } else {
            $bulan=array(
                '01'=>'Jam',
                '02'=>'Peb',
                '03'=>'Mar',
                '04'=>'Apr',
                '05'=>'Mei',
                '06'=>'Jun',
                '07'=>'Jul',
                '08'=>'Agus',
                '09'=>'Sept',
                '10'=>'Okt',
                '11'=>'Nov',
                '12'=>'Des'
            );
        }
        
        return $bulan;
    }

    function getHari($full = true){
        if ($full) {
            return array(
                '1'=>'Senin',
                '2'=>'Selasa',
                '3'=>'Rabu',
                '4'=>'Kamis',
                '5'=>"Jum'at",
                '6'=>'Sabtu',
                '7'=>'Minggu'
                );
        } else {
            return array(
                '1'=>'Sen',
                '2'=>'Sel',
                '3'=>'Rab',
                '4'=>'Kam',
                '5'=>"Jum",
                '6'=>'Sab',
                '7'=>'Ming'
                );    
        }
    }

    /**
     * Mengubah format tanggal dari YYYY-MM-DD ke DD-MM-YYYY dan sebaliknya (bisa diselip HH:MI:SS)
     * @param string $ymd
     * @param string $outdelim delimiter output
     * @param string $indelim delimiter input
     * @return string
     */
    function formatDate($ymd, $outdelim = '-', $indelim = '-') {
        if (empty($ymd) or $ymd == 'null')
            return $ymd;

        list($y, $m, $d) = explode($indelim, substr($ymd, 0, 10));

        return $d . $outdelim . $m . $outdelim . $y . substr($ymd, 10, 9);
    }
    
    /**
     * Mengubah format tanggal dari YYYY-MM-DD ke format indonesia
     * @param string $ymd
     * @param boolean $full nama hari/bulan lengkap atau singkatan
     * @param boolean $hari apakah mencantumkan nama hari
     * @param string $indelim delimiter input
     * @return string
     */
    function formatDateInd($ymd, $full = true, $hari = false, $indelim = '-') {
        if (empty($ymd))
            return $ymd;

        $month = getBulan();
        list($y, $m, $d) = explode($indelim, substr($ymd, 0, 10));
        $time = substr($ymd, 11, 8);

        $return = (int) $d . ' ' . $month[$m] . ' ' . $y . (empty($time) ? '' : ', ' . $time);
        if ($hari)
            $return = dateToIndo(date('N', mktime(0, 0, 0, $m, $d, $y)), $full) . ', ' . $return;

        return $return;
    }