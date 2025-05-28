# Cours 06 - Sécurité et nettoyage des saisies utilisateurs - Exercices

Cette série d'exercices est conçue pour vous permettre de valider les concepts
théoriques et pratiques vus dans le cours
_[Cours 06 - Sécurité et nettoyage des saisies utilisateurs](../01-theorie/README.md)_.

## Ressources

- Théorie : [Support de cours](../01-theorie/README.md) ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/06-securite-et-nettoyage-des-saisies-utilisateurs/01-theorie/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/06-securite-et-nettoyage-des-saisies-utilisateurs/01-theorie/06-securite-et-nettoyage-des-saisies-utilisateurs-presentation.pdf)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Exercices : [Énoncés et solutions](../03-exercices/README.md)

## Table des matières

- [Ressources](#ressources)
- [Table des matières](#table-des-matières)
- [Exercice 1](#exercice-1)
- [Exercice 2](#exercice-2)
- [Exercice 3](#exercice-3)
- [Exercice 4](#exercice-4)

## Exercice 1

Quels sont les principaux problèmes de sécurité que l'on peut rencontrer lorsque
l'on utilise des formulaires HTML ?

Quelles sont les solutions pour les éviter ?

<details>
<summary>Afficher la réponse</summary>

Il existe deux types de problèmes de sécurité principaux :

1. **Injection SQL** : cela se produit lorsque des données non filtrées sont
   insérées directement dans une requête SQL. Cela peut permettre à un attaquant
   d'exécuter des commandes SQL arbitraires sur la base de données.

   **Solution** : utiliser des requêtes préparées pour éviter l'injection SQL.

2. **Cross-Site Scripting (XSS)** : cela se produit lorsque des données non
   filtrées sont affichées sur une page web. Cela peut permettre à un attaquant
   d'injecter du code JavaScript malveillant dans la page, qui sera exécuté par
   le navigateur de l'utilisateur.

   **Solution** : échapper les données avant de les afficher sur la page web.

</details>

## Exercice 2

En quoi consiste le fait d'utiliser des requêtes préparées ? Pourquoi est-ce
important ? Donnez un exemple de code PHP qui illustre la différence entre une
requête préparée et une requête non préparée et expliquez son fonctionnement.

<details>
<summary>Afficher la réponse</summary>

Les requêtes préparées est une technique utilisée pour éviter les injections
SQL.

Elles permettent de séparer la logique SQL de la donnée.

Voici un exemple de code PHP qui illustre la différence entre une requête
préparée et une requête non préparée :

```php
// Requête non préparée
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

$result = $pdo->query($sql);
$result = $result->fetch();

// Requête préparée
$sql = "SELECT * FROM users WHERE username = :username AND password = :password";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':username', $username);
$stmt->bindValue(':password', $password);

$stmt->execute();
$result = $stmt->fetch();
```

Dans le premier cas, la requête SQL est construite en concaténant les variables
`$username` et `$password` directement dans la chaîne de requête. Cela permet à
un attaquant d'injecter du code SQL malveillant.

Dans le second cas, la requête SQL utilise des paramètres nommés (`:username` et
`:password`) qui sont liés aux variables `$username` et `$password` avec la
méthode `bindValue()`. Cela permet de s'assurer que les données saisies par
l'utilisateur sont traitées comme des valeurs et non comme du code SQL. Cela
empêche les injections SQL.

</details>

## Exercice 3

En quoi consiste le fait d'échapper les données affichées à l'écran ? Pourquoi
est-ce important ? Donnez un exemple de code PHP qui illustre la différence
entre un affichage échappé et un affichage non échappé.

<details>
<summary>Afficher la réponse</summary>

L'échappement des données affichées à l'écran consiste à transformer les
caractères spéciaux en entités HTML avant de les afficher sur une page web.

Cela permet d'éviter les attaques XSS en empêchant l'exécution de code
JavaScript malveillant.

Voici un exemple de code PHP qui illustre la différence entre un affichage
échappé et un affichage non échappé et expliquez son fonctionnement :

```php
// Données saisies par l'utilisateur
$userInput = "<script>alert('I can execute JavaScript code')</script>";

// Affichage non échappé
echo $userInput;

// Affichage échappé
echo htmlspecialchars($userInput);
```

Dans le premier cas, si `$userInput` contient du code JavaScript malveillant, il
sera exécuté par le navigateur de l'utilisateur, ce qui peut entraîner des
problèmes de sécurité.

Dans le second cas, la fonction `htmlspecialchars()` transforme les caractères
spéciaux en entités HTML. Par exemple, `<` devient `&lt;`, `>` devient `&gt;`,
et `&` devient `&amp;`. Cela empêche l'exécution de code JavaScript malveillant,
car le navigateur affichera le code tel quel au lieu de l'exécuter.

Ainsi, le code JavaScript sera affiché comme du texte brut et ne sera pas
exécuté. Cela protège l'application contre les attaques XSS.

</details>

## Exercice 4

Une connaissance passionnée de musique a écrit une petite application PHP qui
lui permet de sauver ses artistes favori.tes.

Elle a remarqué que l'application fonctionne très bien, mais que l'application a
un comportement inattendu pour certain.es artistes.

Elle vous a partagé une liste d'artistes qu'elle a essayé d'ajouter à sa liste
d'artistes favori.tes, mais dont certain.es n'ont pas fonctionné comme prévu :

- **`2Pac`**
- **`The Notorious B.I.G.`**
- **`Eminem`**
- **`Missy Elliott`**
- **`<script>alert('I <3 JavaScript')</script>`**
- **`'); DROP TABLE favorite_artists; --`**

Elle vous a demandé de l'aide pour corriger le problème.

Que pouvez-vous dire de son code ? Proposez une version corrigée du code PHP
qu'elle vous a partagé :

```php
<?php
// Fichier favorite-artists.php

// Constante pour le fichier de base de données SQLite
const DATABASE_FILE = "./favorite-artists.db";

// Connexion à la base de données
$pdo = new PDO("sqlite:" . DATABASE_FILE);

// On définit la requête SQL pour créer une table `favorite_artists`
$sql = "CREATE TABLE IF NOT EXISTS favorite_artists (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    band_name TEXT NOT NULL
)";

// On exécute la requête SQL pour créer la table
$pdo->exec($sql);

// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // On récupère les données du formulaire
    $bandName = $_POST["band-name"];

    // On définit la requête SQL pour ajouter un.e artiste favori.te
    $sql = "INSERT INTO favorite_artists (band_name) VALUES ('$bandName')";

    // On exécute la requête SQL pour ajouter l'artiste favori.te
    $pdo->exec($sql);
}

// On définit la requête SQL pour récupérer tous les artistes favori.tes
$sql = "SELECT * FROM favorite_artists";

// On exécute la requête SQL pour récupérer les artistes favori.tes
$favoriteArtists = $pdo->query($sql);

// On transforme le résultat en tableau
$favoriteArtists = $favoriteArtists->fetchAll();
?>

<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Mes artistes favori.tes</title>
</head>

<body>
    <h1>Mes artistes favori.tes</h1>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <p>L'artiste favori.te a été rajouté.</p>
    <?php } ?>

    <ul>
        <?php foreach ($favoriteArtists as $favoriteArtist) : ?>
            <li><?= $favoriteArtist["band_name"] ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Ajouter un.e artiste favori.te</h2>

    <form action="favorite-artists.php" method="POST">
        <label for="band-name">Artiste</label><br>
        <input
            type="text"
            id="band-name"
            name="band-name" />

        <br>

        <button type="submit">Envoyer</button>
    </form>
</body>

</html>
```

<details>
<summary>Afficher la réponse</summary>

Le code présente plusieurs problèmes de sécurité :

1. **Injection SQL** : la requête SQL pour ajouter un.e artiste favori.te
   utilise directement la variable `$bandName` sans la filtrer ou la préparer.
   Cela permet à un attaquant d'injecter du code SQL malveillant.
2. **Cross-Site Scripting (XSS)** : les données affichées sur la page ne sont
   pas échappées, ce qui permet à un attaquant d'injecter du code JavaScript
   malveillant dans la page.
3. **Aucune validation des données** : le code ne valide pas les données saisies
   par l'utilisateur, ce qui peut entraîner des erreurs ou des comportements
   inattendus.

**Code corrigé**

```php
<?php
// Constante pour le fichier de base de données SQLite
const DATABASE_FILE = "./favorite-artists.db";

// Connexion à la base de données
$pdo = new PDO("sqlite:" . DATABASE_FILE);

// Création d'une table `favorite_artists`
$sql = "CREATE TABLE IF NOT EXISTS favorite_artists (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    band_name TEXT NOT NULL
)";

// On exécute la requête SQL pour créer la table
$pdo->exec($sql);

// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // On récupère les données du formulaire
    $bandName = $_POST["band-name"];

    // On prépare la requête SQL pour ajouter un.e artiste favori.te
    $sql = "INSERT INTO favorite_artists (band_name) VALUES (:bandName)";

    // On prépare la requête
    $stmt = $pdo->prepare($sql);

    // On lie les paramètres
    $stmt->bindValue(':bandName', $bandName);

    // On exécute la requête SQL pour ajouter l'artiste favori.te
    $stmt->execute();
}

// On prépare la requête SQL pour récupérer tous les artistes favori.tes
$sql = "SELECT * FROM favorite_artists";

// On exécute la requête SQL pour récupérer les artistes favori.tes
$favoriteArtists = $pdo->query($sql);

// On transforme le résultat en tableau
$favoriteArtists = $favoriteArtists->fetchAll();
?>

<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Mes artistes favori.tes</title>
</head>

<body>
    <h1>Mes artistes favori.tes</h1>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <p>L'artiste favori.te a été rajouté.</p>
    <?php } ?>

    <ul>
        <?php foreach ($favoriteArtists as $favoriteArtist) : ?>
            <li><?= htmlspecialchars($favoriteArtist["band_name"]) ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Ajouter un.e artiste favori.te</h2>

    <form action="favorite-artists.php" method="POST">
        <label for="band-name">Artiste</label><br>
        <input
            type="text"
            id="band-name"
            name="band-name" />

        <br>

        <button type="submit">Envoyer</button>
    </form>
</body>

</html>
```

</details>
