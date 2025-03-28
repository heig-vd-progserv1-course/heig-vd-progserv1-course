<?php
require 'functions.php';

// Crée Godzilla, un lézard de 4 ans
addPet("Godzilla", 4);

// Récupère l'animal nommé Godzilla
$godzilla = getPet("Godzilla");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Visualise et modifie un animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Visualise et modifie un animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour visualiser et modifier un animal de compagnie.</p>

    <h2>Détails de l'animal <?= $godzilla['name']; ?></h2>
    <ul>
        <li>Nom : <?= $godzilla['name']; ?></li>
        <li>Âge : <?= $godzilla['age']; ?> an(s)</li>
    </ul>
</body>

</html>
