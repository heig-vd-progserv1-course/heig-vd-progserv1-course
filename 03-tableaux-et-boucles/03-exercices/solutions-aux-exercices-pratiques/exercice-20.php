<?php
$string = "Hello, world!";
$words = explode(" ", $string);
$reversedWords = array_map('strrev', $words);

$result = implode(" ", $reversedWords);

echo $result;
