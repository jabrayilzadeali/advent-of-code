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
    // var_dump('str_contains: ', str_contains('xy', 'absdxy'));
    foreach($shouldNotHave as $el) {
        if (str_contains($line, $el)) return false;
    }
    return true;
}

// var_dump(check3vowels('aaba'));
// var_dump(checkDoubleChar('ab'));
// var_dump(stringDontHaveCertainElements('akcdefg'));

function isNiceString(string $str) {
    return (
        check3vowels($str) && 
        checkDoubleChar($str) && 
        stringDontHaveCertainElements($str)
    );
}

var_dump(isNiceString('haegwjzuvuyypxyu'));

function main(array $data) {
    $niceCount = 0;
    foreach($data as $line) {
        echo $line;
        var_dump('check3vowels', check3vowels($line));
        var_dump('checkDoubleChar', checkDoubleChar($line));
        var_dump('stringDontHaveCertainElements', stringDontHaveCertainElements($line));
        echo '----------------';
        if (
            isNiceString($line)
        ) {
            $niceCount++;
        }
    }
    return $niceCount;
}

$strTest = '';

echo main($data);
