<?php

$day1 = file_get_contents('inputs/day1');
$input = explode(', ', $day1);

//            X  Y
$position = [0, 0];
$facing = 0;
foreach ($input as $instruction) {
	$turn = substr($instruction, 0, 1);
	$step = substr($instruction, 1);
	switch ($turn) {
		case 'L':
			$facing !== 0 ? $facing-- : $facing = 3;
			break;
		case 'R':
			$facing !== 3 ? $facing++ : $facing = 0;
			break;
	}
	switch ($facing) {
		case 0:
			$position[0] += $step;
			break;
		case 1:
			$position[1] += $step;
			break;
		case 2:
			$position[0] -= $step;
			break;
		case 3:
			$position[1] -= $step;
			break;
	}
}

echo "Part1: ";
echo array_sum(array_map('abs', $position));

echo "\n";
