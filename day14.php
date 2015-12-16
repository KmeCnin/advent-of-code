<?php

$input = file_get_contents('inputs/day14');

// Part one
$numbers = [];
preg_match_all('/-?\d+/', $input, $numbers);
echo 'Part one: '.array_sum($numbers[0]).'
';

