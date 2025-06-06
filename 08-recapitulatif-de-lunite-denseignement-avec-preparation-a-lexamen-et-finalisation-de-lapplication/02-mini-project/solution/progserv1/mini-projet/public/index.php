<?php
require '../src/PetsManager.php';

// On crée une instance de PetsManager
$petsManager = new PetsManager();

// On récupère tous les animaux de compagnie
$pets = $petsManager->getPets();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <title>Page d'accueil | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <main class="container">

        <div class="logo">
            <img src="images/logo.svg" alt="Logo du gestionnaire d'animaux de compagnie">
        </div>

        <h1>Page d'accueil du gestionnaire d'animaux de compagnie</h1>

        <p>Bienvenue sur la page d'accueil du gestionnaire d'animaux de compagnie !</p>
        <p>Utilise cette page pour visualiser et gérer tous les animaux de compagnie.</p>

        <h2>Liste des animaux</h2>

        <p><a href="create.php"><button>Créer un nouvel animal de compagnie</button></a></p>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Espèce</th>
                    <th>Sexe</th>
                    <th>Âge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pets as $pet) { ?>
                    <tr>
                        <td><?= htmlspecialchars($pet['name']) ?></td>
                        <td><?= Pet::SPECIES[htmlspecialchars($pet['species'])] ?></td>
                        <td><?= Pet::SEXES[htmlspecialchars($pet['sex'])] ?></td>
                        <td><?= htmlspecialchars($pet['age']) ?></td>
                        <td>
                            <a href="delete.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Supprimer</button></a>
                            <a href="edit.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Éditer</button></a>
                            <a href="view.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Visualiser</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>
