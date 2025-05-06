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
    } else {
        // Sinon, on initialise les variables
        $id = $pet['id'];
        $name = $pet['name'];
        $species = $pet['species'];
        $nickname = $pet['nickname'];
        $sex = $pet['sex'];
        $age = $pet['age'];
        $color = $pet['color'];
        $personalities = $pet['personalities'];
        $size = $pet['size'];
        $notes = $pet['notes'];
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gère la soumission du formulaire

    // Récupération des données du formulaire
    $id = $_POST["id"];
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];
    $size = $_POST["size"];
    $notes = $_POST["notes"];

    // Par défaut, il n'y a pas d'erreurs
    $errors = [];

    // Validation des données
    if (empty($name)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le nom est obligatoire.");
    }

    if (strlen($name) < 2) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le nom doit contenir au moins 2 caractères.");
    }

    if (empty($species)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "L'espèce est obligatoire.");
    }

    if (empty($sex)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le sexe est obligatoire.");
    }

    if (empty($age)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "L'âge est obligatoire.");
    }

    if (!is_numeric($age) || $age < 0) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "L'âge doit être un nombre entier positif.");
    }

    if (!empty($size) && (!is_numeric($size) || $size < 0)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "La taille doit être un nombre entier positif.");
    }

    // Si le formulaire est valide, on met à jour l'animal
    if (empty($errors)) {
        // On ajoute l'animal à la base de données
        $success = updatePet(
            $id,
            $name,
            $species,
            $nickname,
            $sex,
            $age,
            $color,
            $personalities,
            $size,
            $notes
        );

        // On vérifie si la mise à jour a réussi
        if ($success) {
            // On redirige vers la page de l'animal modifié
            header("Location: view.php?id=$id");
            exit();
        } else {
            // Si la mise à jour a échoué, on affiche un message d'erreur
            $errors[] = "La mise à jour a échoué.";
        }
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
    <title>Modifie un animal de compagnie | Gestionnaire d'animaux de compagnie</title>

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
    <h1>Modifie un animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour modifier un animal de compagnie.</p>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <?php if (empty($errors)) { ?>
            <p style="color: green;">Le formulaire a été soumis avec succès !</p>
        <?php } else { ?>
            <p style="color: red;">Le formulaire contient des erreurs :</p>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>
    <?php } ?>

    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $pet["id"] ?>" />

        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" value="<?php if (isset($name)) echo $name; ?>" required minlength="2">

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" name="species" required>
            <option value="dog" <?php if (isset($species) && $species == "dog") echo "selected"; ?>>Chien</option>
            <option value="cat" <?php if (isset($species) && $species == "cat") echo "selected"; ?>>Chat</option>
            <option value="lizard" <?php if (isset($species) && $species == "lizard") echo "selected"; ?>>Lézard</option>
            <option value="snake" <?php if (isset($species) && $species == "snake") echo "selected"; ?>>Serpent</option>
            <option value="bird" <?php if (isset($species) && $species == "bird") echo "selected"; ?>>Oiseau</option>
            <option value="rabbit" <?php if (isset($species) && $species == "rabbit") echo "selected"; ?>>Lapin</option>
            <option value="other" <?php if (isset($species) && $species == "other") echo "selected"; ?>>Autre</option>
        </select>

        <br>

        <label for="nickname">Surnom :</label><br>
        <input type="text" id="nickname" name="nickname" value="<?php if (isset($nickname)) echo $nickname; ?>" />

        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" name="sex" value="male" <?php echo (isset($sex) && $sex == 'male') ? 'checked' : ''; ?> required />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" name="sex" value="female" <?php echo (isset($sex) && $sex == 'female') ? 'checked' : ''; ?> required />
            <label for="female">Femelle</label>
        </fieldset>

        <br>

        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age" value="<?php if (isset($age)) echo $age; ?>" required min="0" />

        <br>

        <label for="color">Couleur :</label><br>
        <input type="color" id="color" name="color" value="<?php if (isset($color)) echo $color; ?>" />

        <fieldset>
            <legend>Personnalité :</legend>

            <div>
                <input type="checkbox" id="gentil" name="personalities[]" value="gentil" <?php echo (!empty($personalities) && in_array("gentil", $personalities)) ? 'checked' : ''; ?> />
                <label for="gentil">Gentil</label>
            </div>

            <div>
                <input type="checkbox" id="playful" name="personalities[]" value="playful" <?php echo (!empty($personalities) && in_array("playful", $personalities)) ? 'checked' : ''; ?> />
                <label for="playful">Joueur</label>
            </div>

            <div>
                <input type="checkbox" id="curious" name="personalities[]" value="curious" <?php echo (!empty($personalities) && in_array("curious", $personalities)) ? 'checked' : ''; ?> />
                <label for="curious">Curieux</label>
            </div>

            <div>
                <input type="checkbox" id="lazy" name="personalities[]" value="lazy" <?php echo (!empty($personalities) && in_array("lazy", $personalities)) ? 'checked' : ''; ?> />
                <label for="lazy">Paresseux</label>
            </div>

            <div>
                <input type="checkbox" id="scared" name="personalities[]" value="scared" <?php echo (!empty($personalities) && in_array("scared", $personalities)) ? 'checked' : ''; ?> />
                <label for="scared">Peureux</label>
            </div>

            <div>
                <input type="checkbox" id="aggressive" name="personalities[]" value="aggressive" <?php echo (!empty($personalities) && in_array("aggressive", $personalities)) ? 'checked' : ''; ?> />
                <label for="aggressive">Agressif</label>
            </div>
        </fieldset>

        <br>

        <label for="size">Taille :</label><br>
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" min="0" step="0.1" />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"><?php if (isset($notes)) echo $notes; ?></textarea>

        <br>
        <br>

        <button type="submit">Mettre à jour</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>

</head>
