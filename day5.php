<?php

$entry = explode(PHP_EOL, file_get_contents('inputs/day5'), -1);

// Part one
$count = 0;
foreach ($entry as $string) {
    if (containsForbiddenString($string)) {
        continue;
    }
    $letters = str_split($string);
    $vowelsCount = 0;
    $previousLetter = null;
    $contains3Vowels = false;
    $containsDoubleLetter = false;
    foreach ($letters as $letter) {
        if ($letter == $previousLetter) {
            $containsDoubleLetter = true;
        }
        $previousLetter = $letter;
        if (in_array($letter, ['a', 'e', 'i', 'o', 'u'])) {
            $vowelsCount++;
        }
        if ($vowelsCount >= 3) {
            $contains3Vowels = true;
        }
    }
    if ($contains3Vowels && $containsDoubleLetter) {
        $count++;    
    }
}
echo 'Part one: '.$count;
echo '
';

// Part two
$count = 0;
foreach ($entry as $string) {
    $i = 0;
    $oldPos = null;
    $containsTwiceLetterPairs = false;
    $containsDoubleWith1Gap = false;
    while ($i < strlen($string)-1) {
        $positions = strposAll($string, substr($string, $i, 2));
        $mappedResults = array_map(function ($currentPosition) use ($positions) {
            foreach ($positions as $position) {
                if (abs($currentPosition - $position) > 1) {
                    return 1;
                }
            }
            return 0;
        }, $positions);
        $counts = array_count_values($mappedResults);
        if (isset($counts[1])) {
            $containsTwiceLetterPairs = true;
            break;
        }
        $i++;
    }
    $letters = str_split($string);
    foreach ($letters as $pos => $letter) {
        if (isset($letters[$pos+2]) && $letter == $letters[$pos+2]) {
            $containsDoubleWith1Gap = true;
            break;
        }
    }
    if ($containsTwiceLetterPairs && $containsDoubleWith1Gap) {
        $count++;
    }
}
echo 'Part two: '.$count;
echo '
';

function strposAll($string, $match) {
    $positions = [];
    do {
        $pos = strpos(
            $string, 
            $match, 
            !empty($positions) ? max($positions)+1 : 0
        );
        if (false !== $pos) {
            $positions[] = $pos;
        }
    } while (false !== $pos);
    return $positions;
}

function containsForbiddenString($string) {
    foreach (['ab', 'cd', 'pq', 'xy'] as $forbiddenString) {
        if (false !== strpos($string, $forbiddenString)) {
            return true;
        }
    }
    return false;
}
