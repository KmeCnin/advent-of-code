<?php

$input = explode(PHP_EOL, file_get_contents('inputs/day9'), -1);

$map = [];
foreach ($input as $data) {
    $exploded = explode(' ', $data);
    $map[$exploded[0]][$exploded[2]] = $exploded[4];
    $map[$exploded[2]][$exploded[0]] = $exploded[4];
}
$towns = array_keys($map);

findPaths($towns, $map, $paths);

echo 'Part one: '.min($paths);
echo '
';

echo 'Part two: '.max($paths);
echo '
';

function findPaths($items, $map, &$paths, $perms = []) {
    if (!empty($items)) {
        $count = count($items); 
        for ($i = $count - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             findPaths($newitems, $map, $paths, $newperms);
         }
    } else {
        $dist = 0;
        foreach ($perms as $key => $perm) {
            if (isset($perms[$key+1])) {
                $next = $perms[$key+1];
                $dist += $map[$perm][$next];
            }
        }
        $paths[] = $dist;
    }
}

