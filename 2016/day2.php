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

$keypad = [
/*     0    1    2    3    4     5   6*/
/*0*/[null,null,null,null,null,null,null],
/*1*/[null,null,null,'1',null, null,null],
/*2*/[null,null,'2', '3', '4', null,null],
/*3*/[null,'5', '6', '7', '8',  '9',null],
/*4*/[null,null,'A', 'B', 'C', null,null],
/*5*/[null,null,null,'D',null, null,null],
/*6*/[null,null,null,null,null,null,null],
];
$position = [1, 3];
$digicode = '';
foreach ($digitsInstructions as $digitInstructions) {
    $instructions = str_split($digitInstructions);
    foreach ($instructions as $instruction) {
        switch ($instruction) {
            case 'U':
                if ($keypad[$position[0]-1][$position[1]]) {
                    $position[0]--;
                }
                break;
            case 'R':
                if ($keypad[$position[0]][$position[1]+1]) {
                    $position[1]++;
                }
                break;
            case 'D':
                if ($keypad[$position[0]+1][$position[1]]) {
                    $position[0]++;
                }
                break;
            case 'L':
                if ($keypad[$position[0]][$position[1]-1]) {
                    $position[1]--;
                }
                break;
        }
        //var_dump($position);
    }
    $digicode .= $keypad[$position[0]][$position[1]];
}

echo "Part2: $digicode\n";
