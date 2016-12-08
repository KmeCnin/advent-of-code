<?php

$input = file_get_contents('inputs/day6');

$letters = [];
foreach (explode("\n", $input) as $line) {
	foreach (str_split($line) as $index => $letter) {
		$letters[$index][] = $letter;
	}
}

$message = [];
foreach ($letters as $index => $set) {
	$occurrencies = array_count_values($set);
	$message[] = array_keys($occurrencies, max($occurrencies))[0];
}

echo "Part1: ".implode($message)."\n";


$message = [];
foreach ($letters as $index => $set) {
	$occurrencies = array_count_values($set);
	$message[] = array_keys($occurrencies, min($occurrencies))[0];
}

echo "Part2: ".implode($message)."\n";
