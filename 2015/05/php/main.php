<?php
declare(strict_types=1);

$data = file("../data/data.txt");

function check3vowels(string $line) {
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    $vowelCount = 0;
    for ($i = 0; $i < strlen($line); $i++) {
        $vowelCount += in_array($line[$i], $vowels);
        if ($vowelCount >= 3) return true;
    }
    return false;
}

function checkDoubleChar(string $line) {
    for ($i = 0; $i < strlen($line) - 1; $i++) {
        if ($line[$i] === $line[$i + 1]) return true;
    }
    return false;
}

function stringDontHaveCertainElements(string $line) {
    $shouldNotHave = ['ab', 'cd', 'pq', 'xy'];
    foreach($shouldNotHave as $el) {
        if (str_contains($line, $el)) return false;
    }
    return true;
}

function noOverlapTwoPair(string $str) {
    $i = 0;
    while($i < strlen($str) - 1) {
        $portion = substr($str, $i, 2);
        $leftSide = substr($str, 0, $i);
        $rightSide = substr($str, $i + 2);
        if (str_contains($leftSide, $portion) || str_contains($rightSide, $portion)) {
            return true;
        }
        $i++;
    }
    return false;
}

function containsTwoLetterOneLetterInBetween(string $str) {
    for ($i = 1; $i < strlen($str) - 1; $i++) {
        if ($str[$i - 1] === $str[$i + 1]) return true;
    }
    return false;
}

function isNiceString(string $str, bool $part2 = false) {
    if ($part2) {
        return (
            noOverlapTwoPair($str) &&
            containsTwoLetterOneLetterInBetween($str)
        );
    }
    return (
        check3vowels($str) && 
        checkDoubleChar($str) && 
        stringDontHaveCertainElements($str)
    );
}


function main(array $data) {
    $niceCount = 0;
    foreach($data as $line) {
        if (isNiceString($line, true)) {
            $niceCount++;
        }
    }
    return $niceCount;
}

echo main($data);
