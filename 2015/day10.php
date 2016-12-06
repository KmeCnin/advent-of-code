<?php

$input = str_split('1113122113');

echo 'Part one: '.count(transform(40, $input)).'
';

echo 'Part two: '.count(transform(50, $input)).'
';

function transform($times, $input) {
    for ($i = 0; $i < $times; $i++) {
        $lastNumber = null;
        $currentCount = 0;
        $newInput = [];
        foreach ($input as $number) {
            if (null !== $lastNumber && $number != $lastNumber) {
                $newInput[] = $currentCount;
                $newInput[] = $lastNumber;
                $currentCount = 0;
            }
            $currentCount++;
            $lastNumber = $number;
        }
        $newInput[] = $currentCount;
        $newInput[] = $lastNumber;
        $input = $newInput;
    }
    return $input;
}

