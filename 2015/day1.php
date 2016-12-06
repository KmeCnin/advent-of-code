<?php

$entry = str_split(file_get_contents('inputs/day1'));

// Part one
$floor = 0;
foreach ($entry as $symbole) {
    $floor = $symbole == '(' ? $floor+1 : $floor-1;
}
echo 'Part one: '.$floor;
echo '
';

// Part two
$floor = 0;
foreach ($entry as $key => $symbole) {
    $floor = $symbole == '(' ? $floor+1 : $floor-1;
    if ($floor === -1) {
        echo 'Part two: '.($key+1);
        break;
    }
}
echo '
';
