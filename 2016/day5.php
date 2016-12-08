<?php

$input = 'reyedfim';
$input = 'ffykfhsq';
$input = 'abc';

$index = 0;
$password = '';
while (strlen($password)<8) {
	$md5 = md5($input.$index);
	if (substr($md5, 0, 5) === '00000') {
		$password .= substr($md5, 5, 1);
	}
	$index++;
}

echo "Part1: $password\n";

$index = 0;
$password = array_fill(0, 8, '_');
while (count(array_filter($password, function ($l) {return $l !== '_';}))<8) {
    displayLikeAH4k3RZ($password);
    $md5 = md5($input.$index);
    if (substr($md5, 0, 5) === '00000' && 
    	isset($password[substr($md5, 5, 1)]) && 
    	$password[substr($md5, 5, 1)] === '_'
	) {
        $password[substr($md5, 5, 1)] = substr($md5, 6, 1);
    }
    $index++;
}

displayLikeAH4k3RZ($password, true);
echo "\n";

echo "Part2: ".implode($password)."\n";

function displayLikeAH4k3RZ($password, $force = false)
{
	if (substr(microtime(), 4) == 0 || $force) {
		echo "\r";
		foreach ($password as $letter) {
			if ($letter === '_') {
				echo substr(md5(microtime()), rand(0,26), 1);
			} else {
				echo "\033[31m".$letter."\033[0m";
			}
		}
	}
}
