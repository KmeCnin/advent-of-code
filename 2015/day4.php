<?php

$secretKey = 'iwrupvqb';

// Part one
$i = 0;
while (substr(md5($secretKey.$i), 0, 5) !== '00000') {
    $i++;
}
echo 'Part one: '.$i;
echo '
';

// Part two
$i = 0;
while (substr(md5($secretKey.$i), 0, 6) !== '000000') {
    $i++;
}
echo 'Part two: '.$i;
echo '
';
