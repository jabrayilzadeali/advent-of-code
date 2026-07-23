<?php

$data = file("data/data.txt");


function main($data, $secondStar = false) {
    $i = 0;
    $total = 0;
    if(!empty($data)){
        // If having data
        foreach($data as $line){
            // Skipping the empty line and Comment line
            if((empty(trim($line))) || (preg_match('/^#/', $line) > 0))
                continue;
            $i++;
            // Output Line Content
            // echo "[Line #{$i}]: {$line}";
            
            // get length, width and heigth
            $sides = explode("x", $line);
            $l = $sides[0];
            $w = $sides[1];
            $h = $sides[2];
            
            if ($secondStar) {
                $allSides = [$l, $w, $h];
                sort($allSides);
                $total += $allSides[0] * 2 + $allSides[1] * 2 + $l * $w * $h;
                
                continue;
            }
            
            $side1 = $l * $w;
            $side2 = $w * $h;
            $side3 = $h * $l;
            
            $smallest = min([$side1, $side2, $side3]);
            

            $total += 2 * ($side1 + $side2 + $side3) + $smallest;

        }
    }
    return $total;
}

echo main($data, true);