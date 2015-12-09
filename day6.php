<?php

$instructions = explode(PHP_EOL, file_get_contents('inputs/day6'), -1);

// Part one
$grid = initGrid();
foreach ($instructions as $instruction) {
    $parsed = parseInstruction($instruction);
    for ($i = $parsed['x']['start']; $i <= $parsed['x']['end']; $i++) {
        for ($j = $parsed['y']['start']; $j <= $parsed['y']['end']; $j++) {
            switch ($parsed['action']) {
                case 'on':
                    $grid[$i][$j] = true;
                    break;
                case 'off':
                    $grid[$i][$j] = false;
                    break;
                case 'toggle':
                    $grid[$i][$j] = !$grid[$i][$j];
                    break;
            }
        }
    }
}
echo 'Part one: '.countGrid($grid);
echo '
';

// Part two
$grid = initGrid2();
foreach ($instructions as $instruction) {
    $parsed = parseInstruction($instruction);
    for ($i = $parsed['x']['start']; $i <= $parsed['x']['end']; $i++) {
        for ($j = $parsed['y']['start']; $j <= $parsed['y']['end']; $j++) {
            switch ($parsed['action']) {
                case 'toggle':
                    $grid[$i][$j]++;
                    // no break!
                case 'on':
                    $grid[$i][$j]++;
                    break;
                case 'off':
                    $grid[$i][$j] > 0 ? $grid[$i][$j]-- : 0;
                    break;
            }
        }
    }
}
echo 'Part two: '.countGrid2($grid);
echo '
';

function initGrid() {
    $grid = [];
    for ($i = 0; $i < 1000; $i++) {
        for ($j = 0; $j < 1000; $j++) {
            $grid[$i][$j] = false;
        }
    }
    return $grid;
}

function initGrid2() {
    $grid = [];
    for ($i = 0; $i < 1000; $i++) {
        for ($j = 0; $j < 1000; $j++) {
            $grid[$i][$j] = 0;
        }
    }
    return $grid;
}

function countGrid($grid) {
    $count = 0;
    for ($i = 0; $i < 1000; $i++) {
        for ($j = 0; $j < 1000; $j++) {
            if ($grid[$i][$j] === true) {
                $count++;
            }
        }
    }
    return $count;
}

function countGrid2($grid) {
    $count = 0;
    for ($i = 0; $i < 1000; $i++) {
        for ($j = 0; $j < 1000; $j++) {
            $count += $grid[$i][$j];
        }
    }
    return $count;
}

function parseInstruction($instruction) {
    $parsed = [];
    $exploded = explode(' ', $instruction);
    if ($exploded[0] == 'turn') {
        $parsed['action'] = $exploded[1];
        $start = explode(',', $exploded[2]);
        $end = explode(',', $exploded[4]);
    } else {
        $parsed['action'] = $exploded[0];
        $start = explode(',', $exploded[1]);
        $end = explode(',', $exploded[3]);
    }
    $parsed['x']['start'] = $start[0];
    $parsed['x']['end'] = $end[0];
    $parsed['y']['start'] = $start[1];
    $parsed['y']['end'] = $end[1];
    return $parsed;
}
