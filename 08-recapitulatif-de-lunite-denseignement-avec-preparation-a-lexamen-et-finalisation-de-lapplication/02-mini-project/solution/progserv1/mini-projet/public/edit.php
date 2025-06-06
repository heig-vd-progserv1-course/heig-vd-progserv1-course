<?php
require '../src/PetsManager.php';

$petsManager = new PetsManager();

// On vérifie si l'ID de l'animal est passé dans l'URL
if (isset($_GET["id"])) {
    // On récupère l'ID de l'animal de la superglobale `$_GET`
    $petId = $_GET["id"];

    // On récupère l'animal correspondant à l'ID
    $pet = $petsManager->getPet($petId);

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

    // S'il n'y a pas d'erreurs, on met à jour l'animal
    if (empty($errors)) {
        // On met à jour l'animal dans la base de données
        $success = $petsManager->updatePet($id, $pet);

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <title>Modifie un animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <main class="container">
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
                        <li><?= $error; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>

        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlentities($pet["id"]) ?>" />

            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="<?= isset($name) ? htmlspecialchars($name) : "" ?>" required minlength="2">

            <label for="species">Espèce :</label>
            <select id="species" name="species" required>
                <?php foreach (Pet::SPECIES as $key => $value) { ?>
                    <option value="<?= $key ?>" <?php if (isset($species) && $species == $key) echo "selected"; ?>><?= $value ?></option>
                <?php } ?>
            </select>

            <label for="nickname">Surnom :</label>
            <input type="text" id="nickname" name="nickname" value="<?= isset($nickname) ? htmlspecialchars($nickname) : "" ?>" />

            <fieldset>
                <legend>Sexe :</legend>

                <?php foreach (Pet::SEXES as $key => $value) { ?>
                    <input type="radio" id="<?= $key ?>" name="sex" value="<?= $key ?>" <?php echo (isset($sex) && $sex == $key) ? 'checked' : ''; ?> required />
                    <label for="<?= $key ?>"><?= $value ?></label>
                <?php } ?>
            </fieldset>

            <label for="age">Âge :</label>
            <input type="number" id="age" name="age" value="<?= isset($age) ? htmlspecialchars($age) : "" ?>" required min="0" />

            <label for="color">Couleur :</label>
            <input type="color" id="color" name="color" value="<?= isset($color) ? htmlspecialchars($color) : "" ?>" />

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
            <input type="number" id="size" name="size" value="<?= isset($size) ? htmlspecialchars($size) : "" ?>" min="0" step="0.1" />

            <label for="notes">Notes :</label>
            <textarea id="notes" name="notes" rows="4" cols="50"><?= isset($notes) ? htmlspecialchars($notes) : "" ?></textarea>

            <a href="delete.php?id=<?= htmlspecialchars($pet["id"]) ?>">
                <button type="button">Supprimer</button>
            </a>
            <button type="submit">Mettre à jour</button>
            <button type="reset">Réinitialiser</button>
        </form>
    </main>
</body>

</html>

</head>
