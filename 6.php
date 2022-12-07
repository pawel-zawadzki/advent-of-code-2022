<?php
require_once 'vendor/autoload.php';

$txt = file_get_contents('6.txt');
$chars = str_split($txt);

function getWindow(array $chars, int $i, int $length): array
{
    $window = [];
    for ($j = 0; $j < $length; $j++) {
        $window[] = $chars[$i - $j];
    }
    return $window;
}

function isDiff(array $window): bool
{
    return count(array_unique($window)) === count($window);
}

// A
for ($i = 3; $i < count($chars); $i++) {
    $window = getWindow($chars, $i, 4);

    if (isDiff($window)) {
        dump($i); // 1355 + 1 = 1356 (because of 0 index)
        break;
    }
}

// B
for ($i = 13; $i < count($chars); $i++) {
    $window = getWindow($chars, $i, 14);

    if (isDiff($window)) {
        dump($i); // 2563 + 1 = 2564 (because of 0 index)
        break;
    }
}