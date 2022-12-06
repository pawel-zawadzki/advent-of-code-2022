<?php
require_once 'vendor/autoload.php';

$txt = file_get_contents('5.txt');
$rows = explode("\n", $txt);

$stacks = [];
$starting = array_slice($rows, 0, 8);

function buildStack($starting) {
    // build stack
    for ($i = count($starting) - 1; $i >= 0; $i--) {
        for ($j = 1; $j <= strlen($starting[$i]); $j += 4) {
            $crate = trim($starting[$i][$j]);
            if (!empty($crate)) {
                $stacks[$j][] = $crate;
            }
        }
    }
    return array_values($stacks);
}

$stacks = buildStack($starting);

// get moves
$moves = array_slice($rows, 10);
foreach ($moves as $move) {
    $temp = explode(' ', $move);
    $count = $temp[1];
    $from = $temp[3];
    $to = $temp[5];

    for ($i = 0; $i < $count; $i++) {
        $stacks[$to - 1][] = array_pop($stacks[$from - 1]);
    }
}

// A
// After the rearrangement procedure completes, what crate ends up on top of each stack?
$top = '';
foreach ($stacks as $stack) {
    $top .= end($stack);
}

dump($top); // WSFTMRHPP

// B
$stacks = buildStack($starting);
foreach ($moves as $move) {
    $temp = explode(' ', $move);
    $count = $temp[1];
    $from = $temp[3];
    $to = $temp[5];

    $moving = [];
    for ($i = 0; $i < $count; $i++) {
        $moving[] = array_pop($stacks[$from - 1]);
    }
    $stacks[$to - 1] = array_merge($stacks[$to - 1], array_reverse($moving));
}

$top = '';
foreach ($stacks as $stack) {
    $top .= end($stack);
}
dump($top); // GSLCMFBRP
