<?php

$input = file_get_contents('inputs/day12');

// Part one
$numbers = [];
preg_match_all('/-?\d+/', $input, $numbers);
echo 'Part one: '.array_sum($numbers[0]).'
';

// Part two
echo 'Part two: '.sumRecurs(json_decode($input, false)).'
';

function sumRecurs($input) {
    if (is_object($input) || is_array($input)) {
        $sum = 0;
        foreach ($input as $value) {
            if ('red' === $value && is_object($input)) {
                return 0;
            }
            $sum += sumRecurs($value);
        }
        return $sum;
    } elseif (is_int($input)) {
        return $input;
    }
    return 0;
}

