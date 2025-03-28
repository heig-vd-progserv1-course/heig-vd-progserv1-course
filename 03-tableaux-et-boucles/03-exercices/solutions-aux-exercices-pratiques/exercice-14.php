<?php
$start = 1;
$end = 10;

function shuffleRange($start, $end) {
    $range = range($start, $end);
    shuffle($range);
    return $range;
}

print_r(shuffleRange($start, $end));
