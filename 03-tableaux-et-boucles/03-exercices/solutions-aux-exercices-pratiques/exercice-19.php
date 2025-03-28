<?php
$string = "Hello, world!";
$words = explode(" ", $string);
$reversedWords = array_reverse($words);
$result = implode(" ", $reversedWords);

echo $result;
