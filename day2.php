<?php

$entry = explode(PHP_EOL, file_get_contents('inputs/day2'), -1);

// Part one
echo 'Part one: '.array_sum(array_map(function ($entry) {
    list($l, $h, $w) = explode('x', $entry);
    $sides = [
        $l*$w,
        $w*$h,
        $h*$l,
    ];
    return 2*array_sum($sides) + min($sides);
}, $entry));
echo '
';

// Part two
echo 'Part two: '.array_sum(array_map(function ($entry) {
    list($l, $h, $w) = explode('x', $entry);
    $perimeters = [
        2*($l+$w),
        2*($w+$h),
        2*($h+$l),
    ];
    return min($perimeters) + $l*$w*$h;
}, $entry));
echo '
';
