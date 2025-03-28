<?php
$start = 15;
$end = 30;

function sumRange($start, $end) {
    $range = range($start, $end);
    return array_sum($range);
}

echo sumRange($start, $end);
