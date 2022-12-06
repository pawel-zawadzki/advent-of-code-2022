<?php

require_once 'vendor/autoload.php';

$txt = file_get_contents('1.txt');
$parts = explode("\n\n", $txt);

// A
$summed = array_map(fn($p) => array_sum(explode("\n", $p)), $parts);
rsort($summed, SORT_NUMERIC);
dump($summed[0]); // 74198

// B
dump(array_sum(array_slice($summed, 0, 3))); // 209914
