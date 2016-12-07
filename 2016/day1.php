<?php

$day1 = file_get_contents('inputs/day1');
$input = explode(', ', $day1);

//           X  Y
$position = [0, 0];
$facing = 0;
$visited = [];
$twice = null;
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
    for($i=0; $i<$step; $i++) {
        $position[$facing%2===0] += $facing<=1 ? 1 : -1;
        if (isset($visited[$position[0].'-'.$position[1]]) &&
            null === $twice
        ) {
            $twice = $visited[$position[0].'-'.$position[1]];
        } elseif (null === $twice) {
            $visited[$position[0].'-'.$position[1]] = array_sum(array_map('abs', $position));
        }
    }
}

echo "Part1: ".array_sum(array_map('abs', $position))."\n";
echo "Part2: ".$twice."\n";
