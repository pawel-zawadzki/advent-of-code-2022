<?php

require_once 'vendor/autoload.php';

$txt = file_get_contents('2.txt');
$parts = explode("\n", $txt);

// A for Rock, B for Paper, and C for Scissors
// X for Rock, Y for Paper, and Z for Scissors
// Rock defeats Scissors, Scissors defeats Paper, and Paper defeats Rock

/*
 * Your total score is the sum of your scores for each round.
 * The score for a single round is the score for the shape you selected (1 for Rock, 2 for Paper, and 3 for Scissors)
 * plus the score for the outcome of the round (0 if you lost, 3 if the round was a draw, and 6 if you won).
 */

// A

function points(string $a, string $b): int {
    $points = 0;

    // 0 1 2
    // A B C
    // X Y Z
    switch ($a) {
        case 'A':
            if ($b == 'Y') $points += 6; // 0 + 1 = 1
            if ($b == 'X') $points += 3;
            break;
        case 'B':
            if ($b == 'Z') $points += 6; // 1 + 2 = 3
            if ($b == 'Y') $points += 3;
            break;
        case 'C':
            if ($b == 'X') $points += 6; // 2 + 0 = 2
            if ($b == 'Z') $points += 3;
            break;
    }

    switch ($b) {
        case 'X': $points += 1; break;
        case 'Y': $points += 2; break;
        case 'Z': $points += 3; break;
    }

    return $points;
}

$summed = array_map(function($p) {
    [$a, $b] = explode(' ', $p);
    return points($a, $b);
}, $parts);

dump(array_sum($summed)); // 12772

// B

/*
 * Anyway, the second column says how the round needs to end:
 * X means you need to lose,
 * Y means you need to end the round in a draw, and
 * Z means you need to win
 */

$summed = array_map(function($p) {
    [$a, $b] = explode(' ', $p);

    switch ($b) {
        // lose
        case 'X': if ($a == 'A') $b = 'Z'; elseif ($a == 'B') $b = 'X'; else $b = 'Y'; break;
        // draw
        case 'Y': if ($a == 'A') $b = 'X'; elseif ($a == 'B') $b = 'Y'; else $b = 'Z'; break;
        // win
        case 'Z': if ($a == 'A') $b = 'Y'; elseif ($a == 'B') $b = 'Z'; else $b = 'X'; break;
    }

    return points($a, $b);
}, $parts);

dump(array_sum($summed)); // 11618
