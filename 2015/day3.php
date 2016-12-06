<?php

$entry = str_split(file_get_contents('inputs/day3'));

// Part one
$houses = [];
$currentX = $currentY = 0;
$houses[$currentX.','.$currentY] = true;
foreach ($entry as $move) {
    switch ($move) {
        case '^':
            $currentY++;
            break;
        case 'v':
            $currentY--;
            break;
        case '>':
            $currentX++;
            break;
        case '<':
            $currentX--;
            break;
    }
    $houses[$currentX.','.$currentY] = true;
}
echo 'Part one: '.count($houses);
echo '
';

// Part two
$houses = $currentX = $currentY = [];
$currentX['santa'] = $currentY['santa'] = 0;
$currentX['robot'] = $currentY['robot'] = 0;
$turnTo = 'santa';
$houses[$currentX[$turnTo].','.$currentY[$turnTo]] = true;
foreach ($entry as $move) {
    switch ($move) {
        case '^':
            $currentY[$turnTo]++;
            break;
        case 'v':
            $currentY[$turnTo]--;
            break;
        case '>':
            $currentX[$turnTo]++;
            break;
        case '<':
            $currentX[$turnTo]--;
            break;
    }
    $houses[$currentX[$turnTo].','.$currentY[$turnTo]] = true;
    $turnTo = $turnTo == 'santa' ? 'robot' : 'santa';
}
echo 'Part two: '.count($houses);
echo '
';
