<?php

$input = explode(PHP_EOL, file_get_contents('inputs/day14'), -1);

// Part one
echo 'Part one: '.max(buildDistances($input)).'
';

// Part two
echo 'Part two: '.max(buildPoints($input)).'
';

function buildDistances($input, $duration = 2503) {
    $distances = [];
    foreach ($input as $entry) {
        $exploded = explode(' ', $entry);
        $speed = (int) $exploded[3];
        $endurance = (int) $exploded[6];
        $rest = (int) $exploded[13];
        $fullCicles = floor($duration / ($endurance + $rest));
        $modulo = $duration % ($endurance + $rest);
        $distance = $speed * $endurance * $fullCicles;
        $distance += $endurance > $modulo 
        ? $speed * $modulo 
        : $speed * $endurance;
        $distances[$exploded[0]] = $distance;
    }
    return $distances;
}

function buildPoints($input) {
    $leaderboard = [];
    for ($i = 1; $i <= 2503; $i++) {
        $distances = buildDistances($input, $i);
        $winners = array_keys($distances, max($distances));
        foreach ($winners as $winner) {
            $leaderboard[$winner] = isset($leaderboard[$winner])
            ? $leaderboard[$winner]+1 : 1;
        }   
    }
    return $leaderboard;
}

