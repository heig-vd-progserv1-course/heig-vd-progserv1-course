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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <main class="container">
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
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="<?php if (isset($name)) echo htmlspecialchars($name); ?>" required minlength="2">

            <label for="species">Espèce :</label>
            <select id="species" name="species" required>
                <?php foreach (Pet::SPECIES as $key => $value) { ?>
                    <option value="<?= $key ?>" <?php if (isset($species) && $species == $key) echo "selected"; ?>><?= $value ?></option>
                <?php } ?>
            </select>

            <label for="nickname">Surnom :</label>
            <input type="text" id="nickname" name="nickname" value="<?php if (isset($nickname)) echo htmlspecialchars($nickname); ?>" />

            <fieldset>
                <legend>Sexe :</legend>

                <?php foreach (Pet::SEXES as $key => $value) { ?>
                    <input type="radio" id="<?= $key ?>" name="sex" value="<?= $key ?>" <?php echo (isset($sex) && $sex == $key) ? 'checked' : ''; ?> required />
                    <label for="<?= $key ?>"><?= $value ?></label>
                <?php } ?>
            </fieldset>

            <label for="age">Âge :</label>
            <input type="number" id="age" name="age" value="<?php if (isset($age)) echo htmlspecialchars($age); ?>" required min="0" />

            <label for="color">Couleur :</label>
            <input type="color" id="color" name="color" value="<?php if (isset($color)) echo htmlspecialchars($color); ?>" />

            <fieldset>
                <legend>Personnalité :</legend>

                <?php foreach (Pet::PERSONALITIES as $key => $value) { ?>
                    <div>
                        <input type="checkbox" id="<?= $key ?>" name="personalities[]" value="<?= $key ?>" <?= (!empty($personalities) && in_array($key, $personalities)) ? 'checked' : ''; ?> />
                        <label for="<?= $key ?>"><?= $value ?></label>
                    </div>
                <?php } ?>
            </fieldset>

            <label for="size">Taille :</label>
            <input type="number" id="size" name="size" value="<?php if (isset($size)) echo htmlspecialchars($size); ?>" min="0" step="0.1" />

            <label for="notes">Notes :</label>
            <textarea id="notes" name="notes" rows="4" cols="50"><?php if (isset($notes)) echo htmlspecialchars($notes); ?></textarea>

            <button type="submit">Créer</button>
            <button type="reset">Réinitialiser</button>
        </form>
    </main>
</body>

</html>
