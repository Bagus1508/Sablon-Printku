<?php

namespace App\Helpers;

use Carbon\Carbon;

class TanggalHelper
{
    public static function translateBulan($string, $lang){
        $englishMonths = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $indonesianMonths = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

    if($lang === 'en'){
        foreach ($indonesianMonths as $key => $indonesianMonth) {
            if (strpos($string, $indonesianMonth) !== false) {
                $string = str_replace($indonesianMonth, $englishMonths[$key], $string);
            }
        }
    }
    if($lang === 'id'){
        foreach ($englishMonths as $key => $englishMonth) {
            if (strpos($string, $englishMonth) !== false) {
                $string = str_replace($englishMonth, $indonesianMonths[$key], $string);
            }
        }
    }
    return $string;
    }

    public static function monthID($month)
    {
        switch (strtolower($month)) {
            case 'january':
                return '01';
            case 'february':
                return '02';
            case 'march':
                return '03';
            case 'april':
                return '04';
            case 'may':
                return '05';
            case 'june':
                return '06';
            case 'july':
                return '07';
            case 'august':
                return '08';
            case 'september':
                return '09';
            case 'october':
                return '10';
            case 'november':
                return '11';
            case 'december':
                return '12';
            default:
                return '00';
        }
    }

    public static function exportDate($date){
        if($date){
            $tanggal = explode(" - ",$date);
            $start = Carbon::parse(self::translateBulan($tanggal[0],'en'))->format("Y-m-d");
            if(count($tanggal) == 2){
                $end = Carbon::parse(self::translateBulan($tanggal[1],'en'))->format("Y-m-d");
            }else{
                $end = $start;
            }
        }else{
            $start ='2001-01-01';
            $end   ='3001-01-01';
        }
        $date ? $tanggal = true : $tanggal = false;

        return ['tanggal'=>$tanggal, 'start'=>$start, 'end'=>$end];
    }

    public static function getBulanName(){
        $Months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        for ($i= 1; $i<= 12; $i++){
            $month[$i-1] = ['id' => $i, 'name' => $Months[$i-1]];
        }
        return $month;
    }
}
