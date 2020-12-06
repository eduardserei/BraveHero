<?php

function sansa_procentaj($procentaj){
    if($procentaj || $procentaj === 0){

        // verificare argument introdus < 0 sau > 100 
        if($procentaj > 100) {
            $procentaj = 100;
        } elseif ($procentaj < 1) {
            $procentaj = 0;
        } else {
            $result = rand(1, 101 - $procentaj);
            return $result === 1; 
        }
        
    } else {

    // error handling
    return 'ERROR! Va rog inserati valoarea procentajului';
    }
}

function areNoroc($lowestNumber = 1, $highestNumber = 100){
    $valoareNoroc = rand($lowestNumber, $highestNumber);
    $areNoroc = sansa_procentaj($valoareNoroc);
    $result = [ 'areNoroc' => $areNoroc, 'valoareNoroc' => $valoareNoroc ];

    return $result;
}

?>