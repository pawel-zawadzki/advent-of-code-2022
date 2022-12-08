<?php
require_once 'vendor/autoload.php';

$txt = file_get_contents('7.txt');
$blocks = explode("$", $txt);

$fs = [];
$path = [];
$sums = [];

foreach ($blocks as $block) {
    $lines = explode("\n", $block);

    $first = trim($lines[0]);
    if (empty($first)) continue;

    if (str_starts_with($first, 'cd')) {
        $dir = substr($first, 3);
        if ($dir == '..') {
            array_pop($path);
        } else {
            $path[] = $dir;
        }
    } elseif (str_starts_with($first, 'ls')) {
        for ($i = 1; $i < count($lines); $i++) {
            $parts = explode(' ', $lines[$i]);
            $p = implode('/', $path);

            if (!isset($fs[$p])) $fs[$p] = 0;
            $size = (int)($parts[0] ?? 0);
            $fs[$p] += $size;

            // add dir sums
            for ($j = 0; $j < count($path); $j++) {
                $pp = implode('/', array_slice($path, 0, $j + 1));
                if (!isset($sums[$pp])) $sums[$pp] = 0;
                $sums[$pp] += $size;
            }
        }
    }
}

// A
// Find all of the directories with a total size of at most 100000.
// What is the sum of the total sizes of those directories?

$below100k = array_filter($sums, fn($v) => $v <= 100_000);
dump(array_sum(array_values($below100k))); // 1325919

// B
// Find the smallest directory that, if deleted, would free up enough space on the filesystem
// to run the update. What is the total size of that directory?

$total = 70000000;
$requiredFree = 30000000;
$currentFree = $total - $sums['/'];

//dump($currentFree); // 27963297
$smallestDir = '';
$smallestSize = 1_000_000_000;

foreach ($sums as $dir => $size) {
    $freeAfterDelete = $currentFree + $size;

    if ($freeAfterDelete >= $requiredFree) {
        // enough to free up space
        if ($size < $smallestSize) {
            $smallestDir = $dir;
            $smallestSize = $size;
        }
    }
}

dd($smallestDir, $smallestSize);