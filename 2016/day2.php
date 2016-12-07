<?php

$input = file_get_contents('inputs/day2');
$digitsInstructions = explode("\n", $input);

$keypad = [
/*    0  1  2 */
/*0*/[1, 2, 3],
/*1*/[4, 5, 6],
/*2*/[7, 8, 9],
];
$position = [1, 1];
$digicode = '';
foreach ($digitsInstructions as $digitInstructions) {
    $instructions = str_split($digitInstructions);
    foreach ($instructions as $instruction) {
        switch ($instruction) {
            case 'U':
                $position[0] = max($position[0]-1, 0);
                break;
            case 'R':
                $position[1] = min($position[1]+1, 2);
                break;
            case 'D':
                $position[0] = min($position[0]+1, 2);
                break;
            case 'L':
                $position[1] = max($position[1]-1, 0);
                break;
        }
    }
    $digicode .= (string) $keypad[$position[0]][$position[1]];
}

echo "Part1: $digicode\n";
echo "Part2: \n";
