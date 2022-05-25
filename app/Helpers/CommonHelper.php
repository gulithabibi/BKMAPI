<?php

function currentDatetime(){
    $date = new DateTime('now');
    $date->setTimezone(new DateTimeZone('Asia/Bangkok'));
    $myDateTime = $date->format('Y-m-d H:i:s');

    return $myDateTime;
}

function numberTowords($num){
    $words = array(); 
    $list1 = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas' ); 
    $list2 = array('', 'Sepuluh', 'Dua Puluh', 'Tiga Puluh', 'Empat Puluh', 'Lima Puluh', 'Enam Puluh', 'Tujuh Puluh', 'Delapan Puluh', 'Sembilan Puluh', 'Seratus'); 
    $list3 = array('', 'Ribu', 'Juta', 'Miliar', 'Triliun', 'Kuadriliun', 'Kuantiliun', 'Sekstiliun', 'Septiliun', 'Oktiliun', 'Noniliun', 'Desiliun', 'Undesiliun', 'Duodesiliun', 'Tredesiliun', 'Kuatuordesiliin', 'Kuindesiliun', 'Seksidesiliun', 'Septendesiliun', 'Oktodesiliun', 'Novemdesiliun', 'Vigintiliun' ); 
    $num_length = strlen($num); 
    $levels = (int) (($num_length + 2) / 3); 
    $max_length = $levels * 3; 
    $num = substr('00' . $num, -$max_length); 
    $num_levels = str_split($num, 3); 
    for ($i = 0; $i < count($num_levels); $i++) { 
           $levels--; 
           $hundreds = (int) ($num_levels[$i] / 100); 
           //hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Ratus' . ' ' : ''); 
           
           //Begin gulit@29/01/2019
           if($hundreds==1){
               $hundreds=$list2[10];
           }else{
                $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Ratus' . ' ' : ''); 
           }
           //end
           
           $tens = (int) ($num_levels[$i] % 100); 
           $singles = ''; 
           if ( $tens < 20 ) { 
                   $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' ); 
           } 
           else { 
                   $tens = (int)($tens / 10); $tens = ' ' . $list2[$tens] . ' '; 
                   $singles = (int) ($num_levels[$i] % 10); 
                   $singles = ' ' . $list1[$singles] . ' '; 
           } 
           $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' ); 
    } 
    $commas = count($words); 
    if ($commas > 1) { $commas = $commas - 1; } 
    $totalStr = implode(' ', $words);

    return $totalStr." rupiah";
}