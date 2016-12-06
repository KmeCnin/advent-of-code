<?php

$input = explode(PHP_EOL, file_get_contents('inputs/day13'), -1);

// Part one
$entries = buildEntries($input);
$paths = [];
findPaths(array_keys($entries), $entries, $paths);
echo 'Part one: '.max($paths).'
';

// Part two
$input[] = 'You would gain 0 happiness units by sitting next to Alice.';
$input[] = 'You would gain 0 happiness units by sitting next to Bob.';
$input[] = 'You would gain 0 happiness units by sitting next to Carol.';
$input[] = 'You would gain 0 happiness units by sitting next to David.';
$input[] = 'You would gain 0 happiness units by sitting next to Eric.';
$input[] = 'You would gain 0 happiness units by sitting next to Frank.';
$input[] = 'You would gain 0 happiness units by sitting next to George.';
$input[] = 'You would gain 0 happiness units by sitting next to Mallory.';
$entries = buildEntries($input);
$paths = [];
findPaths(array_keys($entries), $entries, $paths);
echo 'Part two: '.max($paths).'
';

function buildEntries($input) {
    $entries = [];
    foreach ($input as $entry) {
        $exploded = explode(' ', $entry);
        $add = $exploded[3];
        $add = 'gain' === $exploded[2] ?  $add : $add * -1;
        if (isset($entries[$exploded[0]][substr($exploded[10], 0, -1)])) {
            $entries[$exploded[0]][substr($exploded[10], 0, -1)] += (int) $add;
            $entries[substr($exploded[10], 0, -1)][$exploded[0]] += (int) $add;
        } else {
            $entries[$exploded[0]][substr($exploded[10], 0, -1)] = (int) $add;
            $entries[substr($exploded[10], 0, -1)][$exploded[0]] = (int) $add;
        }
    }
    return $entries;
}

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
            } else {
                $next = $perms[0];
            }
            $dist += $map[$perm][$next];
        }
        $paths[] = $dist;
    }
}

