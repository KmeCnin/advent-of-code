<?php

$password = 'hepxcrrq';
$password++;

while (!isValid($password)) {
    $password++;
}

// Part one
echo 'Part one: '.$password.'
';

$password++;
while (!isValid($password)) {
    $password++;
}

// Part two
echo 'Part two: '.$password.'
';

function isValid($password) {
    $letters = str_split($password);
    if (!empty(array_intersect($letters, ['i', 'o', 'l']))) {
        return false;
    }
    $has3Letters = false;
    $hasPairs = false;
    $lastPair = null;
    $count = count($letters);
    for ($i = 0; $i < $count-2; $i++) {
        $firstPlus2 = $letters[$i];
        $firstPlus2++;
        $firstPlus2++;
        $secondPlusOne = $letters[$i+1];
        $secondPlusOne++;
        if (
            $firstPlus2 == $secondPlusOne && 
            $secondPlusOne == $letters[$i+2]
        ) {
            $has3Letters = true;
            break;
        }
    }
    for ($i = 0; $i < $count-1; $i++) {
        if (null === $lastPair && $letters[$i] == $letters[$i+1]) {
            $lastPair = $letters[$i];
        } elseif (null !== $lastPair && $letters[$i] == $letters[$i+1] && $lastPair != $letters[$i]) {
            $hasPairs = true;
            break;
        }
    }
    if ($has3Letters && $hasPairs) {
        return true;
    }
    return false;
}

