<?php
declare(strict_types=1);


$data = file_get_contents("../data/data.txt");

function main($str, $zeroCountAtStart) {
    $checkAgainst = '';
    for ($i = 0; $i < $zeroCountAtStart; $i++) {
       $checkAgainst .= '0';
    }
    $i = 0;
    while (true) {
        $md5 = md5($str . $i);
        if (substr($md5, 0, $zeroCountAtStart) === $checkAgainst) return $i;
        $i++;
    }
}

echo main($data, 6);