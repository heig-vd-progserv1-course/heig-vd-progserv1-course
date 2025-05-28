<?php
require '../src/PetsManager.php';

$petsManager = new PetsManager();

// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];
    $size = $_POST["size"];
    $notes = $_POST["notes"];

    // On crée un nouvel objet `Pet`
    $pet = new Pet(
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

    // On valide les données
    $errors = $pet->validate();

    // S'il n'y a pas d'erreurs, on ajoute l'animal
    if (empty($errors)) {

        // On ajoute l'animal à la base de données
        $petId = $petsManager->addPet($pet);

        // On redirige vers la page d'accueil avec tous les animaux
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>

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
    <h1>Crée un nouvel animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour créer un nouvel animal de compagnie.</p>

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

    <form action="create.php" method="POST">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" value="<?php if (isset($name)) echo htmlspecialchars($name); ?>" required minlength="2">

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
        <input type="text" id="nickname" name="nickname" value="<?php if (isset($nickname)) echo htmlspecialchars($nickname); ?>" />

        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" name="sex" value="male" <?php echo (isset($sex) && $sex == 'male') ? 'checked' : ''; ?> required />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" name="sex" value="female" <?php echo (isset($sex) && $sex == 'female') ? 'checked' : ''; ?> required />
            <label for="female">Femelle</label>
        </fieldset>

        <br>

        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age" value="<?php if (isset($age)) echo htmlspecialchars($age); ?>" required min="0" />

        <br>

        <label for="color">Couleur :</label><br>
        <input type="color" id="color" name="color" value="<?php if (isset($color)) echo htmlspecialchars($color); ?>" />

        <fieldset>
            <legend>Personnalité :</legend>

            <div>
                <input type="checkbox" id="gentil" name="personalities[]" value="gentil" <?php echo (isset($personalities) && in_array("gentil", $personalities)) ? 'checked' : ''; ?> />
                <label for="gentil">Gentil</label>
            </div>

            <div>
                <input type="checkbox" id="playful" name="personalities[]" value="playful" <?php echo (isset($personalities) && in_array("playful", $personalities)) ? 'checked' : ''; ?> />
                <label for="playful">Joueur</label>
            </div>

            <div>
                <input type="checkbox" id="curious" name="personalities[]" value="curious" <?php echo (isset($personalities) && in_array("curious", $personalities)) ? 'checked' : ''; ?> />
                <label for="curious">Curieux</label>
            </div>

            <div>
                <input type="checkbox" id="lazy" name="personalities[]" value="lazy" <?php echo (isset($personalities) && in_array("lazy", $personalities)) ? 'checked' : ''; ?> />
                <label for="lazy">Paresseux</label>
            </div>

            <div>
                <input type="checkbox" id="scared" name="personalities[]" value="scared" <?php echo (isset($personalities) && in_array("scared", $personalities)) ? 'checked' : ''; ?> />
                <label for="scared">Peureux</label>
            </div>

            <div>
                <input type="checkbox" id="aggressive" name="personalities[]" value="aggressive" <?php echo (isset($personalities) && in_array("aggressive", $personalities)) ? 'checked' : ''; ?> />
                <label for="aggressive">Agressif</label>
            </div>
        </fieldset>

        <br>

        <label for="size">Taille :</label><br>
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo htmlspecialchars($size); ?>" min="0" step="0.1" />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"><?php if (isset($notes)) echo htmlspecialchars($notes); ?></textarea>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
