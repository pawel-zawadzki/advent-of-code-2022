<?php

require_once 'vendor/autoload.php';

$txt = file_get_contents('3.txt');
$rows = explode("\n", $txt);

function priority(string $item): int
{
    $small = array_flip(range('a', 'z'));
    $capital = array_flip(range('A', 'Z'));

    return ($small[$item] ?? ($capital[$item] + 26)) + 1;
}

function intersect(...$items): string
{
    $intersect= array_unique(array_intersect(...$items));
    return array_shift($intersect);
}

// A
$sum = 0;
foreach ($rows as $row) {
    [$r1, $r2] = str_split($row, strlen($row) / 2);
    $item = intersect(str_split ($r1), str_split ($r2));
    $sum += priority($item);
}
dump($sum); // 7826

// B
$sum = 0;
for ($i = 0; $i < count($rows); $i += 3) {
    $item = intersect(str_split($rows[$i]), str_split($rows[$i+1]), str_split($rows[$i+2]));
    $sum += priority($item);
}
dump($sum); // 2577