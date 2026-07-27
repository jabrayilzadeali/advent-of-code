<?php

declare(strict_types=1);

$data = file("../data/data.txt");


function createCoors(int $start = 0, int $end = 999, $value = -1)
{
    $coordinates = new SplFixedArray($end + 1);
    for ($i = $start; $i <= $end; $i++) {
        $coordinates[$i] = new SplFixedArray($end + 1);
        for ($j = $start; $j <= $end; $j++) {
            $coordinates[$i][$j] = $value;
        }
    }
    return $coordinates;
}

function createCoors2(int $start = 0, int $end = 999)
{
    $coordinates = [];
    for ($i = $start; $i <= $end; $i++) {
        $coordinates[] = [];
        for ($j = $start; $j <= $end; $j++) {
            $coordinates[$i][] = -1;
        }
    }
    return $coordinates;
}




function lineParser(string $str)
{
    $insturactions = [];
    $result = explode(' ', $str);
    $i = 2;
    $j = 4;

    $insturactions['action'] = "$result[0] $result[1]";
    if ($result[0] === 'toggle') {
        $insturactions['action'] = 'toggle';
        $i = 1;
        $j = 3;
    }
    $x1y1Coors = explode(',', $result[$i]);
    $x2y2Coors = explode(',', $result[$j]);
    $insturactions['x1'] = $x1y1Coors[0];
    $insturactions['y1'] = $x1y1Coors[1];
    $insturactions['x2'] = $x2y2Coors[0];
    $insturactions['y2'] = $x2y2Coors[1];
    return $insturactions;
}

function take_action($insturactions, $coors, $part2 = false)
{
    for ($i = $insturactions['x1']; $i <= $insturactions['x2']; $i++) {
        for ($j = $insturactions['y1']; $j <= $insturactions['y2']; $j++) {
            if ($part2) {
                if ($insturactions['action'] === 'toggle') {
                    $coors[$i][$j] += 2;
                } else if ($insturactions['action'] === 'turn on') {
                    $coors[$i][$j] += 1;
                } else if ($insturactions['action'] === 'turn off') {
                    if ($coors[$i][$j] > 0) {
                        $coors[$i][$j] -= 1;
                    }
                }
                continue;
            }
            if ($insturactions['action'] === 'toggle') {
                $coors[$i][$j] *= -1;
            } else if ($insturactions['action'] === 'turn on') {
                $coors[$i][$j] = 1;
            } else if ($insturactions['action'] === 'turn off') {
                $coors[$i][$j] = -1;
            }
        }
    }
}


function calculate($x1, $y1, $x2, $y2, $coors, $part2 = false)
{
    $sum = 0;
    for ($i = $x1; $i <= $x2; $i++) {
        for ($j = $y1; $j <= $y2; $j++) {
            if ($coors[$i][$j] > 0 && $part2) {
                $sum += $coors[$i][$j];
            } else if ($coors[$i][$j] === 1) {
                $sum++;
            }
        }
    }
    return $sum;
}

function main($data, $part2 = false)
{
    $coors = createCoors(0, 999, $part2 ? 0 : -1);

    $x1 = 0;
    $y1 = 0;
    $x2 = 999;
    $y2 = 999;

    $actionList = [
        // "turn on 0,0 through 3,0",
        // "turn on 0,0 through 0,0",
        "toggle 0,0 through 999,999",
    ];
    
    foreach ($data as $action) {
        $insturactions = lineParser($action);
        take_action($insturactions, $coors, $part2);
    }

    echo calculate($x1, $y1, $x2, $y2, $coors, $part2);
}

main($data, true);