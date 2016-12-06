<?php

$input = explode(PHP_EOL, file_get_contents('inputs/day8'), -1);

// Part one
$count = 0;
foreach ($input as $entry) {
    $characters = str_split($entry);
    $count += count($characters);
    unset($characters[count($characters)-1]);
    unset($characters[0]);
    while (count($characters) > 0) {
        $backslashPos = array_search('\\', $characters);
        if (false !== $backslashPos) {
            $backslashFollower = $characters[$backslashPos+1];
            switch ($backslashFollower) {
                case 'x':
                    unset($characters[$backslashPos]);
                    unset($characters[$backslashPos+1]);
                    unset($characters[$backslashPos+2]);
                    unset($characters[$backslashPos+3]);
                    $count--;
                    break;
                case '\\':
                case '"':
                    unset($characters[$backslashPos]);
                    unset($characters[$backslashPos+1]);
                    $count--;
                    break;
            }
            $characters = array_values($characters);
            continue;
        }
        $count -= count($characters);
        $characters = [];
    }
}
echo 'Part one: '.$count;
echo '
';

// Part two
$count = 0;
foreach ($input as $entry) {
    $count += 4;
    $characters = str_split($entry);
    unset($characters[count($characters)-1]);
    unset($characters[0]);
    foreach ($characters as $c) {
        if ('\\' == $c || '"' == $c) {
            $count++;
        }
    }
}
echo 'Part two: '.$count;
echo '
';

