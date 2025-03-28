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

function compareName($a, $b) {
    return strcmp($a["name"], $b["name"]);
}

usort($people, "compareName");

print_r($people);
