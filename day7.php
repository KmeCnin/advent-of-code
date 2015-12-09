<?php

$instructions = explode(PHP_EOL, file_get_contents('inputs/day7'), -1);

// Part one
$circuit = [];
execRequired('a', $circuit, $instructions);
echo 'Part one: '.$circuit['a'];
echo '
';

// Part two
echo '
';

function execRequired($required, &$circuit, &$instructions) {
    $result = findWireInstruction($required, $instructions);
    if (!empty($result)) {
        $instruction = $result['instruction'];
        foreach (getRequired($instruction, $circuit) as $required) {
            if (!isset($circuit[$required])) {
                execRequired($required, $circuit, $instructions);
            }
        }
        execInstruction($instruction, $circuit);
        echo $instruction.'
';
        unset($instructions[$result['key']]);
    }
}

function getRequired($instruction, &$circuit) {
    $exploded = explode(' ', $instruction);
    $required = [];
    switch (count($exploded)) {
        case 3:
            if (!ctype_digit($exploded[0]) && !isset($circuit[$exploded[0]])) {
                $required[] = $exploded[0];
            }
            break;
        case 4: // NOT
            if (!ctype_digit($exploded[1]) && !isset($circuit[$exploded[1]])) {
                $required[] = $exploded[1];
            }
            break;
        case 5:
            if (!ctype_digit($exploded[0]) && !isset($circuit[$exploded[0]])) {
                $required[] = $exploded[0];
            }
            if (!ctype_digit($exploded[2]) && !isset($circuit[$exploded[2]])) {
                $required[] = $exploded[2];
            }
            break;
    }
    return $required;
}

function findWireInstruction($required, &$instructions) {
    $return = [];
    foreach ($instructions as $key => $instruction) {
        $exploded = explode(' ', $instruction);
        $wire = end($exploded);
        if ($wire == $required) {
            $return['instruction'] = $instruction;
            $return['key'] = $key;
            break;
        }
    }
    return $return;
}

function execInstruction($instruction, &$circuit) {
    $exploded = explode(' ', $instruction);
    $wire = end($exploded);
    switch (count($exploded)) {
        case 3:
            $signal = getSignal($exploded[0], $circuit);
            break;
        case 4: // NOT
            $signal = ((~ getSignal($exploded[1], $circuit)) & 65535);
            break;
        case 5:
            $signal1 = getSignal($exploded[0], $circuit);
            $signal2 = getSignal($exploded[2], $circuit);
            switch ($exploded[1]) {
                case 'AND':
                    $signal = $signal1 & $signal2;
                    break;
                case 'OR':
                    $signal = $signal1 | $signal2;
                    break;
                case 'LSHIFT':
                    $signal = $signal1 << $signal2;
                    break;
                case 'RSHIFT':
                    $signal = $signal1 >> $signal2;
                    break;
            }
            break;
    }
    $circuit[$wire] = $signal;
}

function getSignal($input, &$circuit) {
    if (ctype_digit($input)) {
        return (int) $input;
    } else {
        return $circuit[$input];
    }
}
