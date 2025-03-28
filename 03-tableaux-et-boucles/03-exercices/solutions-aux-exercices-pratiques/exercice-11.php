<?php
$fruits = ["Pomme", "Poire", "Banane", "Cerise", "Fraise"];

for ($i = 0; $i < count($fruits); $i++) {
    echo "$fruits[$i]<br>";
}

echo "<br>";

$i = 0;
while ($i < count($fruits)) {
    echo "$fruits[$i]<br>";
    $i++;
}

echo "<br>";

$i = 0;
do {
    echo "$fruits[$i]<br>";
    $i++;
} while ($i < count($fruits));

echo "<br>";

foreach ($fruits as $fruit) {
    echo "$fruit<br>";
}
