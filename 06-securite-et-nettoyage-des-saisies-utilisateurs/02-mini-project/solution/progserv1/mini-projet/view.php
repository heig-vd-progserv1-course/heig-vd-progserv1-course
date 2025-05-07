<?php
require 'functions.php';

// On vérifie si l'ID de l'animal est passé dans l'URL
if (isset($_GET["id"])) {
    // On récupère l'ID de l'animal de la superglobale `$_GET`
    $petId = $_GET["id"];

    // On récupère l'animal correspondant à l'ID
    $pet = getPet($petId);

    // Si l'animal n'existe pas, on redirige vers la page d'accueil
    if (!$pet) {
        header("Location: index.php");
        exit();
    }
} else {
    // Si l'ID n'est pas passé dans l'URL, on redirige vers la page d'accueil
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Visualise et modifie un animal de compagnie | Gestionnaire d'animaux de compagnie</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        p {
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="color"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="radio"]+label,
        input[type="checkbox"]+label {
            display: inline-block;
            margin-right: 15px;
        }

        fieldset div {
            display: inline-block;
            margin-right: 10px;
        }

        fieldset {
            margin-top: 5px;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        legend {
            font-weight: bold;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        a {
            color: #5cb85c;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Visualise un animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour visualiser un animal de compagnie.</p>

    <form>
        <label for="name">Nom :</label><br>
        <input type="text" id="name" value="<?= $pet["name"] ?>" disabled />

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" disabled>
            <option value="dog" <?= $pet["species"] == "dog" ? "selected" : "" ?>>Chien</option>
            <option value="cat" <?= $pet["species"] == "cat" ? "selected" : "" ?>>Chat</option>
            <option value="lizard" <?= $pet["species"] == "lizard" ? "selected" : "" ?>>Lézard</option>
            <option value="snake" <?= $pet["species"] == "snake" ? "selected" : "" ?>>Serpent</option>
            <option value="bird" <?= $pet["species"] == "bird" ? "selected" : "" ?>>Oiseau</option>
            <option value="rabbit" <?= $pet["species"] == "rabbit" ? "selected" : "" ?>>Lapin</option>
            <option value="other" <?= $pet["species"] == "other" ? "selected" : "" ?>>Autre</option>
        </select>

        <br>

        <label for="nickname">Surnom :</label><br>
        <input type="text" id="nickname" value="<?= $pet["nickname"] ?>" disabled />

        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" <?= $pet["sex"] == "male" ? "checked" : "" ?> disabled />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" <?= $pet["sex"] == "female" ? "checked" : "" ?> disabled />
            <label for="female">Femelle</label>
        </fieldset>

        <br>

        <label for="age">Âge :</label><br>
        <input type="number" id="age" value="<?= $pet["age"] ?>" disabled />

        <br>

        <label for="color">Couleur :</label><br>
        <input type="color" id="color" value="<?= $pet["color"] ?>" disabled />

        <fieldset>
            <legend>Personnalité :</legend>

            <div>
                <input type="checkbox" id="gentil" <?= !empty($pet["personalities"]) && in_array("gentil", $pet["personalities"]) ? "checked" : "" ?> disabled />
                <label for="gentil">Gentil</label>
            </div>

            <div>
                <input type="checkbox" id="playful" <?= !empty($pet["personalities"]) && in_array("playful", $pet["personalities"]) ? "checked" : "" ?> disabled />
                <label for="playful">Joueur</label>
            </div>

            <div>
                <input type="checkbox" id="curious" <?= !empty($pet["personalities"]) && in_array("curious", $pet["personalities"]) ? "checked" : "" ?> disabled />
                <label for="curious">Curieux</label>
            </div>

            <div>
                <input type="checkbox" id="lazy" <?= !empty($pet["personalities"]) && in_array("lazy", $pet["personalities"]) ? "checked" : "" ?> disabled />
                <label for="lazy">Paresseux</label>
            </div>

            <div>
                <input type="checkbox" id="scared" <?= !empty($pet["personalities"]) && in_array("scared", $pet["personalities"]) ? "checked" : "" ?> disabled />
                <label for="scared">Peureux</label>
            </div>

            <div>
                <input type="checkbox" id="aggressive" <?= !empty($pet["personalities"]) && in_array("aggressive", $pet["personalities"]) ? "checked" : "" ?> disabled />
                <label for="aggressive">Agressif</label>
            </div>
        </fieldset>

        <br>

        <label for="size">Taille :</label><br>
        <input type="number" id="size" value="<?= $pet["size"] ?>" disabled />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" rows="4" cols="50" disabled><?= $pet["notes"] ?></textarea>

        <br>
        <br>

        <a href="delete.php?id=<?= $pet["id"] ?>">
            <button type="button">Supprimer</button>
        </a>
    </form>
</body>

</html>
