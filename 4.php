<?php

require_once 'vendor/autoload.php';

$txt = file_get_contents('4.txt');
$rows = explode("\n", $txt);

function contains(array $a, array $b): bool
{
    return count(array_diff($a, $b)) === 0 || count(array_diff($b, $a)) === 0;
}

function overlap(array $a, array $b): bool
{
    return count(array_intersect($a, $b)) > 0;
}

// A
// In how many assignment pairs does one range fully contain the other?

$count = 0;
foreach ($rows as $row) {
    [$a, $b] = explode(',', $row);
    [$a1, $a2] = explode('-', $a);
    [$b1, $b2] = explode('-', $b);
    $rangeA = range($a1, $a2);
    $rangeB = range($b1, $b2);

    if (contains($rangeA, $rangeB)) $count++;
}
dump($count); // 441

// B
// In how many assignment pairs do the ranges overlap?

$count = 0;
foreach ($rows as $row) {
    [$a, $b] = explode(',', $row);
    [$a1, $a2] = explode('-', $a);
    [$b1, $b2] = explode('-', $b);
    $rangeA = range($a1, $a2);
    $rangeB = range($b1, $b2);

    if (overlap($rangeA, $rangeB)) $count++;
}
dump($count); // 861