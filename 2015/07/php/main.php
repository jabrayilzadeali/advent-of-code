<?php

declare(strict_types=1);

$data = file("../data/data.txt");

$operations = [
    "123 -> x",
    "x -> y",
    // "x AND y -> d",
    // "x OR y -> e",
    // "x LSHIFT 2 -> f",
    // "y RSHIFT 2 -> g",
    // "NOT x -> h",
    // "NOT y -> i",
];

$result = [];

function lineParser(string $str) {
    global $result;
    $arr = explode(' ', $str);
    
    print_r($arr);
    
    if (count($arr) === 3) {
        $result[$arr[array_key_last($arr)]] = is_numeric($arr[0]) ? $arr[0] : $result[$arr[0]];
    } elseif (count($arr) === 4) {
        $result[$arr[array_key_last($arr)]] = ~ $arr[1];
    } else {
        $el1 = $arr[0];
        $el2 = $arr[2];
        $operator = $arr[1];
        if ($operator === 'AND') {
            return $el1 & $el2;
        } elseif ($operator === 'OR') {
            return $el1 | $el2;
        } elseif ($operator === 'LSHIFT') {
            return $el1 << $el2;
        } elseif ($operator === 'RSHIFT') {
            return $el1 >> $el2;
        }
    }
    return $result;
}
print_r(lineParser("123 -> x"));
print_r(lineParser("456 -> y", $result));

// echo lineParser("x AND y -> d");

// foreach ($data as $line) {
    
// }

// $a = 123;
// $b = 456;

// echo $a << 2;