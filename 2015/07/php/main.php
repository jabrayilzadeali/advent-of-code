<?php

declare(strict_types=1);

$data = file("../data/data.txt");

function clearData($data) {
    $variables = [];
    $operations = [];
    foreach ($data as $line) {
        if (count(explode(' ', $line)) === 3) {
            $variables[] = $line;
            continue;
        }
        $operations[] = $line;
    }
    return [$variables, $operations];
}

$operations = [
    "123 -> x",
    "456 -> y",
    "x AND y -> bn\r",   // note: two spaces before AND
];

$result = [];

function getValue(string $el) {
    global $result;
    return is_numeric($el) ? (int)$el : $result[$el] ?? null;
}

function lineParser(string $str) {
    global $result;
    $arr = explode(' ', $str);
    
    if (count($arr) === 3) {
        $el = getValue($arr[0]);
        if ($el === null) {
            return false;
        }
        $result[$arr[array_key_last($arr)]] = $el;
    } elseif (count($arr) === 4) {
        $el = getValue($arr[1]);
        if ($el === null) {
            return false;
        }
        $result[$arr[array_key_last($arr)]] = ~ $el & 0xFFFF;
    } else {
        $el1 = getValue($arr[0]);
        $el2 = getValue($arr[2]);
        if ($el1 === null || $el2 === null) {
            // echo "+++++++++++++++++++++++++++++++ el1 $el1 | el2: $el2";
            return false;
        }
        $operator = $arr[1];
        // echo '------------------------++++++++++: ', $el1, " $operator ", $el2, PHP_EOL;
        if ($operator === 'AND') {
            // echo 'anddfklasjfkljdasklfjdaslk;jflk', $el1,' ', $el2, ' ', $el1 & $el2, PHP_EOL;
            $result[$arr[array_key_last($arr)]] = $el1 & $el2;
        } elseif ($operator === 'OR') {
            $result[$arr[array_key_last($arr)]] = $el1 | $el2;
        } elseif ($operator === 'LSHIFT') {
            $result[$arr[array_key_last($arr)]] = $el1 << $el2 ;
        } elseif ($operator === 'RSHIFT') {
            $result[$arr[array_key_last($arr)]] = $el1 >> $el2;
        }
    }
    var_dump($result);
    return true;
}

// echo lineParser("x AND y -> d");

// [$vars, $opers] = clearData($data);
// unset($data[4]);
// print_r($data);

function main($data) {
    // print_r($data);
    $i = 0;
    while (true) {
        $line = $data[$i] ?? null;
        if ($line) {
            $val = lineParser($line);
            if ($val) {
                unset($data[$i]);
                $data = array_values($data);
                echo count($data), PHP_EOL;
            }
        }
        $i++;
        // echo $i, PHP_EOL;
        if ($i >= count($data)) $i = 0;
        // echo 'count: ', count($data), ' $i: ', $i, ' line: ', $line, PHP_EOL;
        // echo 'Data: ';
        if (count($data) === 0) break;
    }
}

main($data);
var_dump($result);

// $x = '123';
// $y = '456';

// // echo  ~ $x & 0xFFFF, PHP_EOL;
// echo $x & $y, PHP_EOL;