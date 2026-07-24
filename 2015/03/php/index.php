<?php
declare(strict_types=1);


$data = file_get_contents("../data/data.txt");

function main(string $data) {
    $x = 0;
    $y = 0;
    $coordianates = [[$x, $y]];
    $unique_homes = 1;
    for ($i = 0; $i < strlen($data); $i++) {
        $updatedCoors = updateCoordianates($x, $y, $data[$i]);
        $x = $updatedCoors[0];
        $y = $updatedCoors[1];
        if (!in_array([$x, $y], $coordianates, true)) {
            $unique_homes++;
        }
        $coordianates[] = [$x, $y];
    }
    return $unique_homes;
}

function updateCoordianates(int $x, int $y, string $direction) {
    if ($direction === '^') {
        $y++;
    } elseif ($direction === 'v') {
        $y--;
    }
    if ($direction === '>') {
        $x++;
    } elseif ($direction === '<') {
        $x--;
    }
    return [$x, $y];
}

function part2(string $data) {
    $turns = 1;
    $unique_homes = 1;
    $x1 = 0;
    $y1 = 0;
    $x2 = 0;
    $y2 = 0;
    $coordianates = [[$x1, $y1]];
    for ($i = 0; $i < strlen($data); $i++) {
        if ($turns === 1) {
            $updatedCoors = updateCoordianates($x1, $y1, $data[$i]);
            $x1 = $updatedCoors[0];
            $y1 = $updatedCoors[1];
            if (!in_array([$x1, $y1], $coordianates, true)) {
                $unique_homes++;
            }
            $coordianates[] = $updatedCoors;
        } elseif ($turns === -1) {
            $updatedCoors = updateCoordianates($x2, $y2, $data[$i]);
            $x2 = $updatedCoors[0];
            $y2 = $updatedCoors[1];
            if (!in_array([$x2, $y2], $coordianates, true)) {
                $unique_homes++;
            }
            $coordianates[] = [$x2, $y2];
        }
        $turns *= -1;
    }
    return $unique_homes;
}

echo main($data);
// echo part2($data);
// echo part2('^v^v^v^v^v');