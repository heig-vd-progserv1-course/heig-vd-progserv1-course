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

foreach ($people as $person) {
    echo "Nom : " . $person["name"] . "<br>";
    echo "Âge : " . $person["age"] . "<br>";
    echo "Ville : " . $person["city"] . "<br>";
    echo "<br>";
}

echo "<br>";

for ($i = 0; $i < count($people); $i++) {
    echo "Nom : " . $people[$i]["name"] . "<br>";
    echo "Âge : " . $people[$i]["age"] . "<br>";
    echo "Ville : " . $people[$i]["city"] . "<br>";
    echo "<br>";
}

echo "<br>";

$i = 0;
while ($i < count($people)) {
    echo "Nom : " . $people[$i]["name"] . "<br>";
    echo "Âge : " . $people[$i]["age"] . "<br>";
    echo "Ville : " . $people[$i]["city"] . "<br>";
    echo "<br>";
    $i++;
}

echo "<br>";

$i = 0;
do {
    echo "Nom : " . $people[$i]["name"] . "<br>";
    echo "Âge : " . $people[$i]["age"] . "<br>";
    echo "Ville : " . $people[$i]["city"] . "<br>";
    echo "<br>";
    $i++;
} while ($i < count($people));
