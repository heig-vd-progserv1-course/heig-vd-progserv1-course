<?php
require 'functions.php';

// Crée Caramel, un chat de 3 ans
addPet("Caramel", 3);

// Crée Rex, un chien de 8 ans
addPet("Rex", 8);

// Crée Tweety, un oiseau de 1 an
addPet("Tweety", 1);

// Crée Godzilla, un lézard de 4 ans
addPet("Godzilla", 4);

// Récupère l'animal nommé Rex
$rex = getPet("Rex");

// Affiche les propriétés de Rex
print_r($rex);
echo "<br>";

// Met à jour l'âge de Rex à 9 ans
$rex = updatePet("Rex", 9);

// Affiche les propriétés de Rex
print_r($rex);
echo "<br>";

// Supprime Tweety... :(
$success = removePet("Tweety");

// Affiche si la suppression a réussi
var_dump($success);
echo "<br>";

// On essaie de récupérer Tweety
$tweety = getPet("Tweety");

// Affiche si Tweety a été trouvé
var_dump($tweety);
echo "<br>";

// Récupère tous les animaux
$pets = getPets();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page d'accueil | Gestionnaire d'animaux de compagnie</title>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>

</head>

<body>
    <h1>Page d'accueil du gestionnaire d' animaux de compagnie</h1>
    <p>Bienvenue sur la page d'accueil du gestionnaire d' animaux de compagnie !</p>
    <p>Utilise cette page pour visualiser et gérer tous les animaux de compagnie.</p>

    <h2>Liste des animaux</h2>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Âge</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pets as $pet) { ?>
                <tr>
                    <td><?= $pet['name'] ?></td>
                    <td><?= $pet['age'] ?> an(s)</td>
                    <td>A venir...</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
