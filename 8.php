<?php
require_once 'vendor/autoload.php';

function display(array $rows): void
{
    foreach ($rows as $row) {
        foreach ($row as $pixel) {
            echo $pixel;
        }
        echo PHP_EOL;
    }
}

$txt = file_get_contents('8.txt');
$rows = explode("\n", $txt);
$rows = array_map(fn($row) => str_split($row), $rows);
$width = count($rows[0]);
$height = count($rows);

display($rows);
// A
// how many trees are visible from outside the grid?

$visible = [
//    "0,0",
//    "0," . ($width-1),
//    ($height-1) . ",0",
//    ($height-1) . "," . ($width-1),
]; // x,y

// $rows[$row][$col]

// top to bottom
for ($col = 1; $col < $width - 1; $col++) {
    $visible[] = "0,$col";

    for ($row = 1; $row < $height - 1; $row++) {
        $value = $rows[$row][$col];
        $prev = $rows[$row - 1][$col];

        if ($prev >= $value) {
//            $visible[] = ($row - 1) . ",$col";
            break;
        }
    }
}

// right to left
    for ($row = 1; $row < $height - 1; $row++) {
    $visible[] = "0,$col";

for ($col = $width - 1; $col > 0; $col--) {
        $value = $rows[$row][$col];
        $prev = $rows[$row - 1][$col];

        if ($prev >= $value) {
            $visible[] = ($row - 1) . ",$col";
            break;
        }
    }
}

// bottom to top

// left to right

$visible = array_unique($visible);
dd($visible);