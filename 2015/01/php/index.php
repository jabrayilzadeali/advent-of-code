<?php

$data = file_get_contents("../data/data.txt");

// function firstStar($data) {
//     $floor = 0;
//     for ($i = 0; $i < strlen($data); $i++) {
//         if ($data[$i] === '(') {
//             $floor++;
//         } elseif ($data[$i] === ')') {
//             $floor--;
//         }
//     }
//     return $floor;

// }

function main($data, $secondStart = false) {
    $floor = 0;
    for ($i = 0; $i < strlen($data); $i++) {
        if ($data[$i] === '(') {
            $floor++;
        } elseif ($data[$i] === ')') {
            $floor--;
        }
        if ($floor === -1 && $secondStart) return $i + 1;
    }
    return $floor;

}

echo main($data);