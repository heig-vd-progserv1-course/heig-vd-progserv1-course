# Cours 04 - Formulaires HTML et validation - Mini-projet

Ce mini-projet est conçu pour vous permettre de mettre en pratique les concepts
théoriques vus dans le cours
_[Cours 04 - Formulaires HTML et validation](../01-theorie/README.md)_.

## Ressources

- Théorie : [Support de cours](../01-theorie/README.md) ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/04-formulaires-html-et-validation/01-theorie/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/04-formulaires-html-et-validation/01-theorie/04-formulaires-html-et-validation-presentation.pdf)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Exercices : [Énoncés et solutions](../03-exercices/README.md)

## Table des matières

- [Ressources](#ressources)
- [Table des matières](#table-des-matières)
- [Objectifs de la session](#objectifs-de-la-session)
- [Mise en place du formulaire](#mise-en-place-du-formulaire)
  - [Création du formulaire](#création-du-formulaire)
  - [Ajout du bouton d'envoi](#ajout-du-bouton-denvoi)
  - [Ajout du bouton de réinitialisation](#ajout-du-bouton-de-réinitialisation)
- [Mise en place du champ nom](#mise-en-place-du-champ-nom)
  - [Ajout du champ nom](#ajout-du-champ-nom)
  - [Réception des données côté serveur](#réception-des-données-côté-serveur)
  - [Validation des données côté serveur](#validation-des-données-côté-serveur)
  - [Affichage des erreurs de validation](#affichage-des-erreurs-de-validation)
  - [Conservation des données saisies](#conservation-des-données-saisies)
  - [Validation des données côté client](#validation-des-données-côté-client)
  - [Contourner la validation côté client](#contourner-la-validation-côté-client)
- [Mise en place des autres champs](#mise-en-place-des-autres-champs)
  - [Ajout du champ espèce](#ajout-du-champ-espèce)
  - [Ajout du champ surnom](#ajout-du-champ-surnom)
  - [Ajout du champ sexe](#ajout-du-champ-sexe)
  - [Ajout du champ âge](#ajout-du-champ-âge)
  - [Ajout du champ couleur](#ajout-du-champ-couleur)
  - [Ajout du champ personnalité](#ajout-du-champ-personnalité)
  - [Ajout du champ taille](#ajout-du-champ-taille)
  - [Ajout du champ notes](#ajout-du-champ-notes)
- [Amélioration de l'interface](#amélioration-de-linterface)
- [Solution](#solution)
- [Conclusion](#conclusion)
- [Aller plus loin](#aller-plus-loin)

## Objectifs de la session

Dans cette session, vous allez créer le formulaire permettant de créer un nouvel
animal de compagnie.

Pour rappel, le formulaire sera composé de plusieurs champs :

- Nom (un champ texte)
- Espèce (un champ de sélection contenant, par exemple : chien, chat, lézard,
  serpent, oiseau, lapin, autre)
- Surnom (un champ texte facultatif)
- Sexe (un champ boutons radio)
- Âge (un champ numérique)
- Couleur (un champ de saisie de couleur facultatif)
- Personnalité (un champ cases à cocher facultatif)
- Taille en cm (un champ numérique facultatif)
- Notes (un champ de texte libre facultatif)

De façon plus concise, les personnes qui étudient devraient avoir pu :

- Créer un formulaire HTML permettant de créer un nouvel animal de compagnie
- Valider les données du formulaire côté serveur
- Afficher les erreurs de validation
- Conserver les données saisies en cas d'erreur de validation
- Valider les données du formulaire côté client

## Mise en place du formulaire

Dans cette section, nous allons créer le formulaire permettant de créer un
nouvel animal de compagnie.

### Création du formulaire

Modifiez le fichier `create.php` pour y ajouter le formulaire permettant de
créer un nouvel animal de compagnie :

```php
<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Crée un nouvel animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour créer un nouvel animal de compagnie.</p>

    <form action="create.php" method="POST">
    </form>
</body>

</html>
```

Le formulaire va envoyer ses données à la page `create.php` (sa propre page). en
utilisant la méthode `POST`.

Pour le moment, le formulaire ne contient pas de champs. Nous allons les ajouter
au fur et à mesure.

### Ajout du bouton d'envoi

Ajoutez un bouton d'envoi au formulaire :

```php
<form action="create.php" method="POST">
        <button type="submit">Créer</button><br>
</form>
```

Le bouton d'envoi permet d'envoyer les données du formulaire au serveur. Il est
représenté par un élément `<button>` avec l'attribut `type` défini sur `submit`.
Le texte du bouton est "Créer".

Le bouton d'envoi est placé à l'intérieur du formulaire, ce qui permet de
l'associer au formulaire.

Le bouton d'envoi est un élément important du formulaire, car il permet à
l'utilisateur de soumettre les données saisies dans le formulaire au serveur.

### Ajout du bouton de réinitialisation

Ajoutez un bouton de réinitialisation au formulaire :

```php
<form action="create.php" method="POST">
        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
</form>
```

Le bouton de réinitialisation permet de réinitialiser les données du formulaire
à leurs valeurs par défaut. Il est représenté par un élément `<button>` avec
l'attribut `type` défini sur `reset`. Le texte du bouton est "Réinitialiser".

Le bouton de réinitialisation est placé à l'intérieur du formulaire, ce qui
permet de l'associer au formulaire.

Le bouton de réinitialisation est un élément important du formulaire, car il
permet à l'utilisateur de réinitialiser les données saisies dans le formulaire à
leurs valeurs par défaut.

## Mise en place du champ nom

Dans cette section, nous allons créer le champ "Nom" du formulaire.

Le champ "Nom" est un champ texte qui permet à l'utilisateur de saisir le nom de
l'animal de compagnie.

### Ajout du champ nom

Ajoutez le champ "Nom" au formulaire :

```php
<form action="create.php" method="POST">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name">

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
</form>
```

Le champ "Nom" est représenté par un élément `<input>` avec l'attribut `type`
défini sur `text`.

L'attribut `id` est défini sur `name`, ce qui permet de l'associer à l'élément
`<label>` correspondant. L'attribut `name` est également défini sur `name`, ce
qui permet d'identifier le champ lors de l'envoi des données au serveur.

L'élément `<label>` est utilisé pour associer une étiquette au champ de saisie.
L'attribut `for` de l'élément `<label>` est défini sur `name`, ce qui permet de
l'associer au champ de saisie correspondant. Le texte de l'étiquette est "Nom
:".

L'élément `<br>` est utilisé pour créer un saut de ligne entre l'étiquette et le
champ de saisie.

Votre page `create.php` devrait ressembler à ceci :

```php
<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Crée un nouvel animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour créer un nouvel animal de compagnie.</p>

    <form action="create.php" method="POST">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name">

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

### Réception des données côté serveur

Afin de recevoir les données du formulaire côté serveur, vous devez ajouter le
code suivant au début de votre fichier `create.php` :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
}
?>
```

Le code `$_SERVER["REQUEST_METHOD"]` permet de vérifier la méthode de la requête
HTTP utilisée pour accéder à la page. Si la méthode est `POST`, cela signifie
que le formulaire a été soumis. Dans ce cas, le code affiche le contenu de la
variable `$_POST`, qui contient les données envoyées par le formulaire. Pour
rappel, la fonction
[`var_dump()`](https://www.php.net/manual/fr/function.var-dump.php) permet
d'afficher le contenu d'une variable avec tous ses détails pour mieux comprendre
sa structure.

Pour le moment, le code ne fait que récupérer la valeur du champ "Nom". Nous
allons ajouter la validation des données et l'affichage des erreurs de
validation dans les sections suivantes.

Votre page `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Crée un nouvel animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour créer un nouvel animal de compagnie.</p>

    <form action="create.php" method="POST">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name">

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.
Saisissez un nom dans le champ "Nom" et cliquez sur le bouton "Créer". Vous
devriez voir la valeur du champ "Nom" affichée à l'écran.

### Validation des données côté serveur

Lorsque les données du formulaire sont envoyées au serveur, il est important de
valider ces données pour s'assurer qu'elles sont correctes et conformes aux
attentes. Dans cette section, nous allons ajouter la validation des données côté
serveur pour le champ "Nom".

Comme le champ "Nom" est obligatoire, nous allons vérifier que la valeur saisie
n'est pas vide. Si la valeur est vide, nous allons afficher un message d'erreur.

De plus, nous allons vérifier que la longueur de la valeur saisie est supérieure
ou égale à 2 caractères. Si la longueur est inférieure à 2 caractères, nous
allons également afficher un message d'erreur.

Pour cela, nous allons créer un tableau `$errors` qui contiendra les messages
d'erreur. Si le tableau est vide, cela signifie qu'il n'y a pas d'erreurs. Si le
tableau contient des messages d'erreur, nous allons les afficher à l'écran.

Ajoutez le code suivant à la suite de la récupération de la valeur du champ
"Nom" :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];

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
}
?>
```

Le code ci-dessus vérifie si la valeur du champ "Nom" est vide à l'aide de la
fonction `empty()`. Si la valeur est vide, un message d'erreur est ajouté au
tableau `$errors` à l'aide de la fonction `array_push()`.

Ensuite, le code vérifie si la longueur de la valeur du champ "Nom" est
inférieure à 2 caractères à l'aide de la fonction `strlen()`. Si la longueur est
inférieure à 2 caractères, un message d'erreur est également ajouté au tableau
`$errors`.

Pour le moment, les messages d'erreur sont stockés dans le tableau `$errors`,
mais ils ne sont pas affichés à l'écran. Nous allons ajouter l'affichage des
erreurs de validation dans la section suivante.

Votre page `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Crée un nouvel animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour créer un nouvel animal de compagnie.</p>

    <form action="create.php" method="POST">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name">

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

### Affichage des erreurs de validation

Pour afficher les erreurs de validation à l'écran, nous allons ajouter un bout
de code qui va parcourir le tableau `$errors` et afficher chaque message
d'erreur.

S'il n'y a pas d'erreurs, nous allons afficher un message de succès.

Ces messages seront affichés au-dessus du formulaire. Ajoutez le code suivant
avant le formulaire :

```php
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
```

Votre page `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name">

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

Ce code vérifie si le formulaire a été soumis en utilisant la méthode `POST`.
S'il a été soumis, il vérifie si le tableau `$errors` est vide. Si le tableau
est vide, cela signifie qu'il n'y a pas d'erreurs et un message de succès est
affiché. Si le tableau contient des messages d'erreur, un message d'erreur est
affiché, suivi d'une liste des messages d'erreur.

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Saisissez un nom vide ou un nom de moins de 2 caractères dans le champ "Nom" et
cliquez sur le bouton "Créer". Vous devriez voir les messages d'erreur affichés
à l'écran.

A l'inverse, si vous saisissez un nom valide, vous devriez voir le message de
succès affiché à l'écran.

### Conservation des données saisies

Pour éviter de perdre les données saisies par l'utilisateur en cas d'erreur de
validation, nous allons sauvegarder la valeur du champ "Nom" dans une variable
`$name` et l'afficher dans le champ de saisie.

Modifiez le code du champ de saisie "Nom" pour qu'il ressemble à ceci :

```php
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>">
```

Le code `value="<?php if (isset($name)) { echo $name; } ?>"` permet de afficher
la valeur du champ "Nom" dans le champ de saisie si celle-ci a été définie. Cela
permet de conserver la valeur saisie par l'utilisateur en cas d'erreur de
validation.

Le code `if (isset($name))` vérifie si la variable `$name` est définie. Si c'est
le cas, la valeur de la variable `$name` est affichée dans le champ de saisie.
Sinon, le champ de saisie est vide.

Votre page `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>">

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Saisissez un nom vide ou un nom de moins de 2 caractères dans le champ "Nom" et
cliquez sur le bouton "Créer". Vous devriez voir les messages d'erreur affichés
à l'écran. La valeur saisie dans le champ "Nom" devrait être affichée dans le
champ de saisie.

Si vous saisissez un nom valide, le formulaire sera soumis au serveur et vous
devez voir le message de succès affiché à l'écran.

### Validation des données côté client

Maintenant que la validation des données côté serveur est en place, nous allons
ajouter la validation des données côté client.

Elle permettra d'améliorer l'expérience utilisateur en affichant les erreurs de
validation avant même que le formulaire ne soit soumis au serveur.

> [!CAUTION]
>
> La validation côté client ne remplace pas la validation côté serveur. Elle
> permet simplement d'améliorer l'expérience utilisateur. Il est important de
> toujours valider les données côté serveur pour des raisons de sécurité.
>
> La validation côté client peut être contournée par un utilisateur malveillant.
>
> Il est donc important de toujours valider les données côté serveur avant de
> les traiter.

Pour cela, nous allons utiliser les attributs HTML `required` et `minlength` sur
le champ "Nom".

Ajoutez les attributs `required` et `minlength` au champ "Nom" :

```php
    <form action="create.php" method="POST">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
```

Le champ "Nom" est maintenant un champ obligatoire grâce à l'attribut
`required`. Si l'utilisateur essaie de soumettre le formulaire sans avoir saisi
de nom, un message d'erreur s'affichera automatiquement.

Votre page `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Saisissez un nom vide ou un nom de moins de 2 caractères dans le champ "Nom" et
cliquez sur le bouton "Créer". Vous devriez voir un message d'erreur s'afficher
à l'écran avant même que le formulaire ne soit soumis au serveur.

Si vous saisissez un nom valide, le formulaire sera soumis au serveur et vous
devez voir le message de succès affiché à l'écran.

### Contourner la validation côté client

Afin de prouver que la validation côté client ne remplace pas la validation côté
serveur, vous pouvez contourner la validation côté client grâce aux outils de
développement de votre navigateur.

1. Ouvrez les outils de développement de votre navigateur (clic droit >
   "Inspecter").
2. Utilisez l'outil de sélection d'élément pour sélectionner le champ "Nom".
3. Dans l'onglet "Éléments", supprimez les attributs `required` et `minlength`
   du champ "Nom".
4. Saisissez un nom vide ou un nom de moins de 2 caractères dans le champ "Nom"
   et cliquez sur le bouton "Créer". Vous devriez voir les messages d'erreur
   affichés à l'écran.

## Mise en place des autres champs

Dans cette section, nous allons créer les autres champs du formulaire. Le
processus est similaire à celui du champ "Nom", décomposé en plusieurs étapes :

1. Ajout du champ
2. Réception des données côté serveur
3. Validation des données côté serveur
4. Affichage des erreurs de validation
5. Sauvegarde des données saisies
6. Validation des données côté client

### Ajout du champ espèce

Dans cette section, nous allons créer le champ "Espèce" du formulaire.

#### Ajout du champ

Le champ "Espèce" est un champ de sélection qui permet à l'utilisateur de
sélectionner l'espèce de l'animal de compagnie.

Pour le moment, celui-ci contiendra les espèces suivantes :

- Chien
- Chat
- Lézard
- Serpent
- Oiseau
- Lapin
- Autre

Essayez de rajouter ce champ à l'aide des ressources disponibles sur MDN :
[Champ `<select>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/select).

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="species">Espèce :</label><br>
        <select id="species" name="species">
            <option value="dog">Chien</option>
            <option value="cat">Chat</option>
            <option value="lizard">Lézard</option>
            <option value="snake">Serpent</option>
            <option value="bird">Oiseau</option>
            <option value="rabbit">Lapin</option>
            <option value="other">Autre</option>
        </select>
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" name="species">
            <option value="dog">Chien</option>
            <option value="cat">Chat</option>
            <option value="lizard">Lézard</option>
            <option value="snake">Serpent</option>
            <option value="bird">Oiseau</option>
            <option value="rabbit">Lapin</option>
            <option value="other">Autre</option>
        </select>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Réception des données côté serveur

Essayez de rajouter la réception des données côté serveur pour le champ
"Espèce".

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir la valeur du champ affichée à l'écran.

<details>
<summary>Afficher la réponse</summary>

```php
    $species = $_POST["species"];
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" name="species">
            <option value="dog">Chien</option>
            <option value="cat">Chat</option>
            <option value="lizard">Lézard</option>
            <option value="snake">Serpent</option>
            <option value="bird">Oiseau</option>
            <option value="rabbit">Lapin</option>
            <option value="other">Autre</option>
        </select>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté serveur

Le champ "Espèce" est un champ obligatoire. Vous devez donc vérifier que la
valeur saisie n'est pas vide. Si la valeur est vide, vous devez afficher un
message d'erreur.

Essayez de rajouter la validation des données côté serveur pour le champ
"Espèce".

<details>
<summary>Afficher la réponse</summary>

```php
    if (empty($species)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "L'espèce est obligatoire.");
    }
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" name="species">
            <option value="dog">Chien</option>
            <option value="cat">Chat</option>
            <option value="lizard">Lézard</option>
            <option value="snake">Serpent</option>
            <option value="bird">Oiseau</option>
            <option value="rabbit">Lapin</option>
            <option value="other">Autre</option>
        </select>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Affichage des erreurs de validation

Il n'est pas nécessaire de changer le code d'affichage des erreurs de
validation. Le code est déjà en place pour afficher les erreurs de validation.
Il suffit de rajouter les messages d'erreur au tableau `$errors` et les messages
seront affichés à l'écran.

#### Conservation des données saisies

Essayez de conserver la valeur saisie dans le champ "Espèce" lorsque le
formulaire est soumis et qu'il y a des erreurs de validation.

Pour cela, il faut utiliser l'attribut `selected` sur l'option sélectionnée dans
le champ "Espèce".

Pour ce faire, vous devez vérifier si la valeur de l'option est égale à la
valeur saisie dans le champ "Espèce". Si c'est le cas, vous devez ajouter
l'attribut `selected` à l'option.

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="species">Espèce :</label><br>
        <select id="species" name="species">
            <option value="dog" <?php if (isset($species) && $species == "dog") echo "selected"; ?>>Chien</option>
            <option value="cat" <?php if (isset($species) && $species == "cat") echo "selected"; ?>>Chat</option>
            <option value="lizard" <?php if (isset($species) && $species == "lizard") echo "selected"; ?>>Lézard</option>
            <option value="snake" <?php if (isset($species) && $species == "snake") echo "selected"; ?>>Serpent</option>
            <option value="bird" <?php if (isset($species) && $species == "bird") echo "selected"; ?>>Oiseau</option>
            <option value="rabbit" <?php if (isset($species) && $species == "rabbit") echo "selected"; ?>>Lapin</option>
            <option value="other" <?php if (isset($species) && $species == "other") echo "selected"; ?>>Autre</option>
        </select>
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" name="species">
            <option value="dog" <?php if (isset($species) && $species == "dog") echo "selected"; ?>>Chien</option>
            <option value="cat" <?php if (isset($species) && $species == "cat") echo "selected"; ?>>Chat</option>
            <option value="lizard" <?php if (isset($species) && $species == "lizard") echo "selected"; ?>>Lézard</option>
            <option value="snake" <?php if (isset($species) && $species == "snake") echo "selected"; ?>>Serpent</option>
            <option value="bird" <?php if (isset($species) && $species == "bird") echo "selected"; ?>>Oiseau</option>
            <option value="rabbit" <?php if (isset($species) && $species == "rabbit") echo "selected"; ?>>Lapin</option>
            <option value="other" <?php if (isset($species) && $species == "other") echo "selected"; ?>>Autre</option>
        </select>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté client

Maintenant que la validation des données côté serveur est en place, nous allons
ajouter la validation des données côté client.

Essayez de rajouter la validation des données côté client pour le champ
"Espèce".

Pour cela, il faut ajouter l'attribut `required` au champ "Espèce".

<details>
<summary>Afficher la réponse</summary>

```php
        <select id="species" name="species" required>
```

Ici, l'attribut `required` permet de rendre le champ "Espèce" obligatoire. Même
s'il n'est techniquement pas possible de sélectionner une valeur vide dans le
champ "Espèce", il est intéressant de le rendre obligatoire pour éviter que
l'utilisateur ne soumette le formulaire sans avoir sélectionné d'espèce en
utilisant les outils de développement de son navigateur.

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

### Ajout du champ surnom

Dans cette section, nous allons créer le champ "Surnom" du formulaire.

#### Ajout du champ

Le champ "Surnom" est un champ de saisie qui permet à l'utilisateur de saisir le
surnom de l'animal de compagnie.

Essayez de rajouter ce champ à l'aide des ressources disponibles sur MDN :
[Champ `<input type="text">`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input/text).

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="nickname">Surnom :</label>
        <input type="text" id="nickname" name="nickname" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="text" id="nickname" name="nickname" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Réception des données côté serveur

Essayez de rajouter la réception des données côté serveur pour le champ
"Surnom".

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir la valeur du champ affichée à l'écran.

<details>
<summary>Afficher la réponse</summary>

```php
    $nickname = $_POST["nickname"];
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="text" id="nickname" name="nickname" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté serveur

Le champ "Surnom" est un champ facultatif. Vous n'avez donc pas besoin de
valider les données côté serveur. Vous pouvez laisser le code tel quel.

#### Affichage des erreurs de validation

Il n'est pas nécessaire de changer le code d'affichage des erreurs de
validation. Le code est déjà en place pour afficher les erreurs de validation.
Il suffit de rajouter les messages d'erreur au tableau `$errors` et les messages
seront affichés à l'écran.

#### Conservation des données saisies

Essayez de conserver la valeur saisie dans le champ "Surnom" lorsque le
formulaire est soumis et qu'il y a des erreurs de validation.

Pour cela, il faut utiliser l'attribut `value` sur le champ "Surnom".

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="nickname">Surnom :</label><br>
        <input type="text" id="nickname" name="nickname" value="<?php if (isset($nickname)) echo $nickname; ?>" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté client

Il n'est pas nécessaire de rajouter la validation des données côté client pour
le champ "Surnom". Le champ "Surnom" est un champ facultatif. Vous pouvez
laisser le code tel quel.

### Ajout du champ sexe

Dans cette section, nous allons créer le champ "Sexe" du formulaire.

#### Ajout du champ

Le champ "Sexe" est un champ boutons radio qui permet à l'utilisateur de
sélectionner le sexe de l'animal de compagnie.

Essayez de rajouter ce champ à l'aide des ressources disponibles sur MDN :
[Champ `<input type="radio">`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input/radio).

<details>
<summary>Afficher la réponse</summary>

```php
        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" name="sex" value="male" />
            <label for="male">Mâle</label><br />

            <input type="radio" id="female" name="sex" value="female" />
            <label for="female">Femelle</label><br />
        </fieldset>
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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

            <input type="radio" id="male" name="sex" value="male" />
            <label for="male">Mâle</label><br />

            <input type="radio" id="female" name="sex" value="female" />
            <label for="female">Femelle</label><br />
        </fieldset>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Réception des données côté serveur

Essayez de rajouter la réception des données côté serveur pour le champ "Sexe".

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir la valeur du champ affichée à l'écran.

<details>
<summary>Afficher la réponse</summary>

```php
    $sex = $_POST["sex"];
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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

            <input type="radio" id="male" name="sex" value="male" />
            <label for="male">Mâle</label><br />

            <input type="radio" id="female" name="sex" value="female" />
            <label for="female">Femelle</label><br />
        </fieldset>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté serveur

Le champ "Sexe" est un champ obligatoire. Vous devez donc vérifier que la valeur
saisie n'est pas vide. Si la valeur est vide, vous devez afficher un message
d'erreur.

Essayez de rajouter la validation des données côté serveur pour le champ "Sexe".

<details>
<summary>Afficher la réponse</summary>

```php
    if (empty($sex)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le sexe est obligatoire.");
    }
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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

            <input type="radio" id="male" name="sex" value="male" />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" name="sex" value="female" />
            <label for="female">Femelle</label>
        </fieldset>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Affichage des erreurs de validation

Il n'est pas nécessaire de changer le code d'affichage des erreurs de
validation. Le code est déjà en place pour afficher les erreurs de validation.
Il suffit de rajouter les messages d'erreur au tableau `$errors` et les messages
seront affichés à l'écran.

#### Conservation des données saisies

Essayez de conserver la valeur saisie dans le champ "Sexe" lorsque le formulaire
est soumis et qu'il y a des erreurs de validation.

Pour cela, il faut utiliser l'attribut `checked` sur le champ "Sexe".

Pour ce faire, vous devez vérifier si la valeur du champ bouton radio est égal à
la valeur saisie dans le champ "Sexe". Si c'est le cas, vous devez ajouter
l'attribut `checked` à l'option.

<details>
<summary>Afficher la réponse</summary>

```php
        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" name="sex" value="male" <?php echo (isset($sex) && $sex == 'male') ? 'checked' : ''; ?> />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" name="sex" value="female" <?php echo (isset($sex) && $sex == 'female') ? 'checked' : ''; ?> />
            <label for="female">Femelle</label>
        </fieldset>
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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

            <input type="radio" id="male" name="sex" value="male" <?php echo (isset($sex) && $sex == 'male') ? 'checked' : ''; ?> />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" name="sex" value="female" <?php echo (isset($sex) && $sex == 'female') ? 'checked' : ''; ?> />
            <label for="female">Femelle</label>
        </fieldset>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté client

Maintenant que la validation des données côté serveur est en place, nous allons
ajouter la validation des données côté client.

Essayez de rajouter la validation des données côté client pour le champ "Sexe".

Pour cela, vous devez ajouter l'attribut `required` sur le champ "Sexe".

<details>
<summary>Afficher la réponse</summary>

```php
        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" name="sex" value="male" <?php echo (isset($sex) && $sex == 'male') ? 'checked' : ''; ?> required />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" name="sex" value="female" <?php echo (isset($sex) && $sex == 'female') ? 'checked' : ''; ?> required />
            <label for="female">Femelle</label>
        </fieldset>
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

### Ajout du champ âge

Dans cette section, nous allons créer le champ "Âge" du formulaire.

#### Ajout du champ

Le champ "Âge" est un champ de type nombre qui permet à l'utilisateur de saisir
l'âge de l'animal de compagnie.

Essayez de rajouter ce champ à l'aide des ressources disponibles sur MDN :
[Champ `<input type="number">`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input/number).

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="age" name="age" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Réception des données côté serveur

Essayez de rajouter la réception des données côté serveur pour le champ "Âge".

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir la valeur du champ affichée à l'écran.

<details>
<summary>Afficher la réponse</summary>

```php
    $age = $_POST["age"];
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="age" name="age" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté serveur

Le champ "Âge" est un champ obligatoire. Vous devez donc vérifier que la valeur
saisie n'est pas vide. Si la valeur est vide, vous devez afficher un message
d'erreur.

De plus, nous allons vérifier que la valeur saisie est un nombre entier positif.
Si la valeur saisie n'est pas un nombre entier positif, nous allons également
afficher un message d'erreur.

Vous pouvez utiliser la fonction
[`is_numeric`](https://www.php.net/manual/fr/function.is-numeric.php) pour
vérifier si la valeur saisie est un nombre. Vous pouvez également utiliser
l'opérateur de comparaison `<` pour vérifier que la valeur saisie est supérieure
ou égale à 0.

Essayez de rajouter la validation des données côté serveur pour le champ "Âge".

<details>
<summary>Afficher la réponse</summary>

```php
    if (empty($age)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "L'âge est obligatoire.");
    }

    if (!is_numeric($age) || $age < 0) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "L'âge doit être un nombre entier positif.");
    }
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="age" name="age" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Affichage des erreurs de validation

Il n'est pas nécessaire de changer le code d'affichage des erreurs de
validation. Le code est déjà en place pour afficher les erreurs de validation.
Il suffit de rajouter les messages d'erreur au tableau `$errors` et les messages
seront affichés à l'écran.

#### Conservation des données saisies

Essayez de conserver la valeur saisie dans le champ "Âge" lorsque le formulaire
est soumis et qu'il y a des erreurs de validation.

Pour cela, il faut utiliser l'attribut `value` sur le champ "Âge".

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age" value="<?php if (isset($age)) echo $age; ?>" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="age" name="age" value="<?php if (isset($age)) echo $age; ?>" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté client

Maintenant que la validation des données côté serveur est en place, nous allons
ajouter la validation des données côté client.

Essayez de rajouter la validation des données côté client pour le champ "Âge".

Pour cela, il faut utiliser les attributs `required` et `min` sur le champ
"Âge".

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age" value="<?php if (isset($age)) echo $age; ?>" required min="0" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

### Ajout du champ couleur

Dans cette section, nous allons créer le champ "Couleur" du formulaire.

#### Ajout du champ

Le champ "Couleur" est un champ de type couleur qui permet à l'utilisateur de
saisir la couleur de l'animal de compagnie.

Essayez de rajouter ce champ à l'aide des ressources disponibles sur MDN :
[Champ `<input type="color">`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input/color).

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="color">Couleur :</label><br>
        <input type="color" id="color" name="color" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="color" id="color" name="color" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Réception des données côté serveur

Essayez de rajouter la réception des données côté serveur pour le champ
"Couleur".

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir la valeur du champ affichée à l'écran.

<details>
<summary>Afficher la réponse</summary>

```php
    $color = $_POST["color"];
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="color" id="color" name="color" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté serveur

Le champ "Couleur" est un champ facultatif. Vous n'avez pas besoin de rajouter
de validation côté serveur pour ce champ. Vous pouvez donc laisser le code tel
quel.

#### Affichage des erreurs de validation

Il n'est pas nécessaire de changer le code d'affichage des erreurs de
validation. Le code est déjà en place pour afficher les erreurs de validation.
Il suffit de rajouter les messages d'erreur au tableau `$errors` et les messages
seront affichés à l'écran.

#### Conservation des données saisies

Essayez de conserver la valeur saisie dans le champ "Couleur" lorsque le
formulaire est soumis et qu'il y a des erreurs de validation.

Pour cela, il faut utiliser l'attribut `value` sur le champ "Couleur".

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="color">Couleur :</label><br>
        <input type="color" id="color" name="color" value="<?php if (isset($color)) echo $color; ?>" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté client

Il n'est pas nécessaire de rajouter la validation des données côté client pour
le champ "Couleur". Le champ "Couleur" est un champ facultatif. Vous pouvez
laisser le code tel quel.

### Ajout du champ personnalité

Dans cette section, nous allons créer le champ "Personnalité" du formulaire.

#### Ajout du champ

Le champ "Personnalité" est un champ cases à cocher qui permet à l'utilisateur
de saisir la personnalité de l'animal de compagnie.

Pour le moment, celui-ci contiendra les personnalités suivantes :

- Gentil
- Joueur
- Curieux
- Paresseux
- Peureux
- Agressif

Essayez de rajouter ce champ à l'aide des ressources disponibles sur MDN :
[Champ `<input type="checkbox">`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input/checkbox).

Pour regrouper les cases à cocher, vous pouvez nommer le champ
`personalities[]`. Cela permettra de récupérer les valeurs des cases à cocher
dans un tableau.

<details>
<summary>Afficher la réponse</summary>

```php
        <fieldset>
            <legend>Personnalité :</legend>

            <div>
                <input type="checkbox" id="gentil" name="personalities[]" value="gentil" />
                <label for="gentil">Gentil</label>
            </div>

            <div>
                <input type="checkbox" id="playful" name="personalities[]" value="playful" />
                <label for="playful">Joueur</label>
            </div>

            <div>
                <input type="checkbox" id="curious" name="personalities[]" value="curious" />
                <label for="curious">Curieux</label>
            </div>

            <div>
                <input type="checkbox" id="lazy" name="personalities[]" value="lazy" />
                <label for="lazy">Paresseux</label>
            </div>

            <div>
                <input type="checkbox" id="scared" name="personalities[]" value="scared" />
                <label for="scared">Peureux</label>
            </div>

            <div>
                <input type="checkbox" id="aggressive" name="personalities[]" value="aggressive" />
                <label for="aggressive">Agressif</label>
            </div>
        </fieldset>
```

Votre fichier `create.php` devrait ressembler à ceci :

```php

<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
                <input type="checkbox" id="gentil" name="personalities[]" value="gentil" />
                <label for="gentil">Gentil</label>
            </div>

            <div>
                <input type="checkbox" id="playful" name="personalities[]" value="playful" />
                <label for="playful">Joueur</label>
            </div>

            <div>
                <input type="checkbox" id="curious" name="personalities[]" value="curious" />
                <label for="curious">Curieux</label>
            </div>

            <div>
                <input type="checkbox" id="lazy" name="personalities[]" value="lazy" />
                <label for="lazy">Paresseux</label>
            </div>

            <div>
                <input type="checkbox" id="scared" name="personalities[]" value="scared" />
                <label for="scared">Peureux</label>
            </div>

            <div>
                <input type="checkbox" id="aggressive" name="personalities[]" value="aggressive" />
                <label for="aggressive">Agressif</label>
            </div>
        </fieldset>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Réception des données côté serveur

Essayez de rajouter la réception des données côté serveur pour le champ
"Personnalité".

**Note** : vous devez vérifier si la variable `$_POST["personalities"]` existe
avant de l'utiliser. En effet, si l'utilisateur ne coche aucune case, la
variable `$_POST["personalities"]` n'existera pas et nous aurons une erreur PHP
sinon.

Si la variable `$_POST["personalities"]` n'existe pas, nous initialisons la
variable `$personalities` à un tableau vide.

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir la valeur du champ affichée à l'écran.

Vous devriez remarquer que la valeur du champ "Personnalité" est un tableau.
Cela est possible grâce au nom `personalities[]`. Cela permet de récupérer les
valeurs des cases à cocher dans un tableau.

<details>
<summary>Afficher la réponse</summary>

```php
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
                <input type="checkbox" id="gentil" name="personalities[]" value="gentil" />
                <label for="gentil">Gentil</label>
            </div>

            <div>
                <input type="checkbox" id="playful" name="personalities[]" value="playful" />
                <label for="playful">Joueur</label>
            </div>

            <div>
                <input type="checkbox" id="curious" name="personalities[]" value="curious" />
                <label for="curious">Curieux</label>
            </div>

            <div>
                <input type="checkbox" id="lazy" name="personalities[]" value="lazy" />
                <label for="lazy">Paresseux</label>
            </div>

            <div>
                <input type="checkbox" id="scared" name="personalities[]" value="scared" />
                <label for="scared">Peureux</label>
            </div>

            <div>
                <input type="checkbox" id="aggressive" name="personalities[]" value="aggressive" />
                <label for="aggressive">Agressif</label>
            </div>
        </fieldset>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté serveur

Le champ "Couleur" est un champ facultatif. Vous n'avez donc pas besoin de
valider les données côté serveur. Vous pouvez laisser le code tel quel.

#### Affichage des erreurs de validation

Il n'est pas nécessaire de changer le code d'affichage des erreurs de
validation. Le code est déjà en place pour afficher les erreurs de validation.
Il suffit de rajouter les messages d'erreur au tableau `$errors` et les messages
seront affichés à l'écran.

#### Conservation des données saisies

Essayez de conserver la valeur saisie dans le champ "Personnalité" lorsque le
formulaire est soumis et qu'il y a des erreurs de validation.

Pour cela, il faut utiliser l'attribut `checked` sur le champ "Personnalité".
Comme les personnalités sont saisies dans un tableau, il faut vérifier si la
valeur de la personnalité est présente dans le tableau `$personalities` grâce à
la fonction [`in_array`](https://www.php.net/manual/fr/function.in-array.php).

<details>
<summary>Afficher la réponse</summary>

```php
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
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté client

Il n'est pas nécessaire de rajouter la validation des données côté client pour
le champ "Personnalité". Le champ "Personnalité" est un champ facultatif. Vous
pouvez laisser le code tel quel.

### Ajout du champ taille

Dans cette section, nous allons créer le champ "Taille" du formulaire.

#### Ajout du champ

Le champ "Taille" est un champ de type nombre qui permet à l'utilisateur de
saisir l'âge de l'animal de compagnie.

Essayez de rajouter ce champ à l'aide des ressources disponibles sur MDN :
[Champ `<input type="number">`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input/number).

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="size">Taille :</label><br>
        <input type="number" id="size" name="size" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="size" name="size" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Réception des données côté serveur

Essayez de rajouter la réception des données côté serveur pour le champ
"Taille".

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir la valeur du champ affichée à l'écran.

<details>
<summary>Afficher la réponse</summary>

```php
    $size = $_POST["size"];
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];
    $size = $_POST["size"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="size" name="size" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté serveur

Le champ "Taille" est optionnel mais nous devons tout de même valider les
données côté serveur.

Nous allons vérifier que la valeur saisie est un nombre entier positif seulment
si la valeur est saisie. Si la valeur n'est pas saisie, nous allons laisser le
champ vide.

Vous pouvez utiliser la fonction
[`is_numeric`](https://www.php.net/manual/fr/function.is-numeric.php) pour
vérifier si la valeur saisie est un nombre. Vous pouvez également utiliser
l'opérateur de comparaison `<` pour vérifier que la valeur saisie est supérieure
ou égale à 0.

Essayez de rajouter la validation des données côté serveur pour le champ
"Taille".

<details>
<summary>Afficher la réponse</summary>

```php
    if (!empty($size) && (!is_numeric($size) || $size < 0)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "La taille doit être un nombre entier positif.");
    }
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];
    $size = $_POST["size"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="size" name="size" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Affichage des erreurs de validation

Il n'est pas nécessaire de changer le code d'affichage des erreurs de
validation. Le code est déjà en place pour afficher les erreurs de validation.
Il suffit de rajouter les messages d'erreur au tableau `$errors` et les messages
seront affichés à l'écran.

#### Conservation des données saisies

Essayez de conserver la valeur saisie dans le champ "Taille" lorsque le
formulaire est soumis et qu'il y a des erreurs de validation.

Pour cela, il faut utiliser l'attribut `value` sur le champ "Taille".

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="size">Taille :</label><br>
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];
    $size = $_POST["size"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté client

Nous pouvons améliorer l'expérience utilisateur en ajoutant une validation côté
client pour le champ "Taille".

Pour cela, nous allons ajouter l'attribut `min` sur le champ "Taille" pour
vérifier que la valeur saisie est supérieure ou égale à 0.

De plus, nous pouvons rajouter l'attribut `step="0.1"` pour permettre à
l'utilisateur de saisir des valeurs décimales au dixième près.

Essayez de rajouter la validation des données côté client pour le champ
"Taille".

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="size">Taille :</label><br>
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" min="0" step="0.1" />
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];
    $size = $_POST["size"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" min="0" step="0.1" />

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

### Ajout du champ notes

Dans cette section, nous allons ajouter un champ "Notes" au formulaire de
création d'un nouvel animal de compagnie.

#### Ajout du champ

Le champ "Notes" est un champ de texte libre qui permet à l'utilisateur de
saisir des notes sur l'animal de compagnie.

Essayez de rajouter ce champ à l'aide des ressources disponibles sur MDN :
[Champ `<textarea>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/textarea).

<details>
<summary>Afficher la réponse</summary>

```php
        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"></textarea>
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

    // Récupération des données du formulaire
    $name = $_POST["name"];
    $species = $_POST["species"];
    $nickname = $_POST["nickname"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $color = $_POST["color"];
    $personalities = isset($_POST["personalities"]) ? $_POST["personalities"] : [];
    $size = $_POST["size"];

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" min="0" step="0.1" />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"></textarea>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Réception des données côté serveur

Essayez de rajouter la réception des données côté serveur pour le champ "Notes".

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir la valeur du champ affichée à l'écran.

<details>
<summary>Afficher la réponse</summary>

```php
    $notes = $_POST["notes"];
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" min="0" step="0.1" />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"></textarea>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté serveur

Le champ "Notes" est un champ facultatif. Vous n'avez donc pas besoin de valider
les données côté serveur. Vous pouvez laisser le code tel quel.

#### Affichage des erreurs de validation

Il n'est pas nécessaire de changer le code d'affichage des erreurs de
validation. Le code est déjà en place pour afficher les erreurs de validation.
Il suffit de rajouter les messages d'erreur au tableau `$errors` et les messages
seront affichés à l'écran.

#### Conservation des données saisies

Essayez de conserver la valeur saisie dans le champ "Notes" lorsque le
formulaire est soumis et qu'il y a des erreurs de validation.

Pour cela, il faut mettre la valeur du champ "Notes" dans la balise
`<textarea>`.

<details>
<summary>Afficher la réponse</summary>

```php
        <textarea id="notes" name="notes" rows="4" cols="50"><?php if (isset($notes)) echo $notes; ?></textarea>
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

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
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
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
        <input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" required minlength="2">

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
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" min="0" step="0.1" />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"><?php if (isset($notes)) echo $notes; ?></textarea>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

</details>

#### Validation des données côté client

Il n'est pas nécessaire de rajouter la validation des données côté client pour
le champ "Notes". Le champ "Notes" est un champ facultatif. Vous pouvez laisser
le code tel quel.

## Amélioration de l'interface

Pour le moment, le formulaire est très basique. Vous pouvez améliorer
l'interface en ajoutant des styles CSS.

Pour ce faire, nous allons ajouter les styles CSS dans la balise `<head>` de
notre page HTML :

```php
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
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le contenu de la variable `\$_POST` est : ";
    var_dump($_POST);

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
        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" min="0" step="0.1" />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"><?php if (isset($notes)) echo $notes; ?></textarea>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>
```

Vous pouvez maintenant tester votre formulaire en l'ouvrant dans votre
navigateur à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

Vous devriez voir un formulaire avec des styles CSS appliqués.

## Solution

Vous pouvez trouver la solution du mini-projet PHP à l'adresse suivante :
[`solution`](./solution/).

## Conclusion

Dans cette session, vous avez créé un formulaire HTML permettant de créer un
nouvel animal de compagnie.

Vous avez également validé les données du formulaire côté serveur et côté
client. Vous avez enfin affiché les erreurs de validation.

Vous avez également amélioré l'interface du formulaire en ajoutant des styles
CSS.

Pour le moment, nous ne faisons que valider les données du formulaire. Nous ne
les enregistrons pas dans une base de données. Nous allons le faire dans la
prochaine séance en utilisant les fonctions que nous avions créées dans un
précédent cours.

## Aller plus loin

_Ceci est une section optionnelle pour les personnes qui souhaitent aller plus
loin. Vous pouvez la sauter si vous n'avez pas de temps._

- Êtes-vous capable d'utiliser une boucle pour afficher les champs des espèces ?
- Et pour les des personnalités ?
