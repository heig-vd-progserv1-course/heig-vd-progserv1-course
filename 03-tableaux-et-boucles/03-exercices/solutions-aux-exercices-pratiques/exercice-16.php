<?php
$people = [
    [
        "name" => "John Doe",
        "age" => 30,
        "city" => "New York"
    ],
    [
        "name" => "Jane Doe",
        "age" => 25,
        "city" => "Los Angeles"
    ],
    [
        "name" => "Alice Smith",
        "age" => 35,
        "city" => "Chicago"
    ]
];

function compareAge($a, $b) {
    if ($a["age"] > $b["age"]) {
        return 1;
    } else if ($a["age"] < $b["age"]) {
        return -1;
    } else {
        return 0;
    }
}

usort($people, "compareAge");

print_r($people);
