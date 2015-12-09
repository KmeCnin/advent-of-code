<?php

$instructions = explode(PHP_EOL, file_get_contents('inputs/day7'), -1);

// Part one
$circuit = [];
execRequired('a', $circuit, $instructions);
var_dump($circuit);
echo 'Part one: '.$circuit['a'];
echo '
';

// Part two
echo '
';

function execRequired($required, &$circuit, &$instructions) {
    $instruction = findWireInstruction($required, $instructions);
    if ($instruction) {
        foreach (getRequired($instruction) as $required) {
            if (!isset($circuit[$required])) {
                execRequired($required, $circuit, $instructions);
            }
        }
        execInstruction($instruction, $circuit);
    }
}

function getRequired($instruction) {
    $exploded = explode(' ', $instruction);
    $required = [];
    switch (count($exploded)) {
        case 3:
            if (!ctype_digit($exploded[0])) {
                $required[] = $exploded[0];
            }
            break;
        case 4: // NOT
            if (!ctype_digit($exploded[1])) {
                $required[] = $exploded[1];
            }
            break;
        case 5:
            if (!ctype_digit($exploded[0])) {
                $required[] = $exploded[0];
            }
            if (!ctype_digit($exploded[2])) {
                $required[] = $exploded[2];
            }
            break;
    }
    return $required;
}

function findWireInstruction($required, &$instructions) {
    foreach ($instructions as $instruction) {
        $exploded = explode(' ', $instruction);
        $wire = end($exploded);
        if ($wire == $required) {
            return $instruction;
        }
    }
    return false;
}

function execInstruction($instruction, &$circuit) {
    $exploded = explode(' ', $instruction);
    $wire = end($exploded);
    switch (count($exploded)) {
        case 3:
            $signal = getSignal($exploded[0], $circuit);
            break;
        case 4: // NOT
            $signal = getSignal($exploded[1], $circuit);
            $signal = $signal ? ((~ $signal) & 65535) : false;
            break;
        case 5:
            $signal1 = getSignal($exploded[0], $circuit);
            $signal2 = getSignal($exploded[2], $circuit);
            switch ($exploded[1]) {
                case 'AND':
                    $signal = ($signal1 && $signal2) ? ($signal1 & $signal2) : false;
                    break;
                case 'OR':
                    $signal = ($signal1 && $signal2) ? ($signal1 | $signal2) : false;
                    break;
                case 'LSHIFT':
                    $signal = ($signal1 && $signal2) ? ($signal1 << $signal2) : false;
                    break;
                case 'RSHIFT':
                    $signal = ($signal1 && $signal2) ? ($signal1 >> $signal2) : false;
                    break;
            }
            break;
        default:
            $signal = false;
            break;
    }
    if ($signal) {
        $circuit[$wire] = $signal;
    }
}

function getSignal($input, &$circuit) {
    if (ctype_digit($input)) {
        return (int) $input;
    } elseif (isset($circuit[$input])) {
        return $circuit[$input];
    }
    return false;
}
