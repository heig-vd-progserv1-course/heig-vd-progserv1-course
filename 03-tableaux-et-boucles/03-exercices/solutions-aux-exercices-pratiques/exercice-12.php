
<?php
$ticTacToe = [
    ["X", "O", "X"],
    ["O", "X", "O"],
    ["X", "O", "X"]
];

// On itère sur les lignes
for ($i = 0; $i < count($ticTacToe); $i++) {
    // On itère sur les colonnes
    for ($j = 0; $j < count($ticTacToe[$i]); $j++) {
        // On affiche le contenu de la case - ici, nous sommes obligés de passer
        // par une concaténation à l'aide du point (.) pour afficher le contenu
        // de la case, car PHP ne permet pas d'afficher directement le contenu
        // d'une case d'un tableau à deux dimensions à l'aide de l'interpolation
        echo "Ligne $i, colonne $j : " . $ticTacToe[$i][$j] . "<br>";
    }
}

echo "<br>";

$i = 0;
while ($i < count($ticTacToe)) {
    $j = 0;
    while ($j < count($ticTacToe[$i])) {
        // On affiche le contenu de la case - ici, nous sommes obligés de passer
        // par une concaténation à l'aide du point (.) pour afficher le contenu
        // de la case, car PHP ne permet pas d'afficher directement le contenu
        // d'une case d'un tableau à deux dimensions à l'aide de l'interpolation
        echo "Ligne $i, colonne $j : " . $ticTacToe[$i][$j] . "<br>";
        $j++;
    }
    $i++;
}

echo "<br>";

$i = 0;
do {
    $j = 0;
    do {

        // On affiche le contenu de la case - ici, nous sommes obligés de passer
        // par une concaténation à l'aide du point (.) pour afficher le contenu
        // de la case, car PHP ne permet pas d'afficher directement le contenu
        // d'une case d'un tableau à deux dimensions à l'aide de l'interpolation
        echo "Ligne $i, colonne $j : " . $ticTacToe[$i][$j] . "<br>";
        $j++;
    } while ($j < count($ticTacToe[$i]));
    $i++;
} while ($i < count($ticTacToe));

echo "<br>";

foreach ($ticTacToe as $i => $line) {
    foreach ($line as $j => $value) {
        // Ici, nous pouvons afficher directement le contenu de la case, car la
        // conversion du tableau à l'aide du `foreach` permet de récupérer
        // directement la valeur de la case
        echo "Ligne $i, colonne $j : $value<br>";
    }
}
