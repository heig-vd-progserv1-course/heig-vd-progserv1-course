# Cours 05 - Base de données et PDO - Mini-projet

Ce mini-projet est conçu pour vous permettre de mettre en pratique les concepts
théoriques vus dans le cours
_[Cours 05 - Base de données et PDO](../01-theorie/README.md)_.

## Ressources

- Théorie : [Support de cours](../01-theorie/README.md) ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/05-base-de-donnees-et-pdo/01-theorie/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/05-base-de-donnees-et-pdo/01-theorie/05-base-de-donnees-et-pdo-presentation.pdf)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Exercices : [Énoncés et solutions](../03-exercices/README.md)

## Table des matières

- [Ressources](#ressources)
- [Table des matières](#table-des-matières)
- [Objectifs de la session](#objectifs-de-la-session)
- [Intégration de PDO](#intégration-de-pdo)
  - [Création du fichier `database.php`](#création-du-fichier-databasephp)
  - [Création de la base de données pour les animaux de compagnie](#création-de-la-base-de-données-pour-les-animaux-de-compagnie)
  - [Installation de l'extension SQLite dans Visual Studio Code](#installation-de-lextension-sqlite-dans-visual-studio-code)
  - [Visualisation du continu de la base de données](#visualisation-du-continu-de-la-base-de-données)
  - [Création de la table pour les animaux de compagnie](#création-de-la-table-pour-les-animaux-de-compagnie)
- [Gestion des animaux de compagnie](#gestion-des-animaux-de-compagnie)
  - [Création d'un animal de compagnie](#création-dun-animal-de-compagnie)
  - [Récupération de tous les animaux de compagnie](#récupération-de-tous-les-animaux-de-compagnie)
  - [Récupération d'un animal de compagnie](#récupération-dun-animal-de-compagnie)
  - [Suppression d'un animal de compagnie](#suppression-dun-animal-de-compagnie)
  - [Mise à jour d'un animal de compagnie](#mise-à-jour-dun-animal-de-compagnie)
- [Dernières étapes et validation](#dernières-étapes-et-validation)
  - [Nettoyage du code](#nettoyage-du-code)
  - [Valider que tout est fonctionnel](#valider-que-tout-est-fonctionnel)
- [Solution](#solution)
- [Conclusion](#conclusion)
- [Aller plus loin](#aller-plus-loin)

## Objectifs de la session

Jusqu'à présent, vous avez créé une application PHP qui permet de gérer des
animaux de compagnie qui sont stockés dans un tableau.

A chaque fois que vous rechargez la page, le tableau est réinitialisé et les
animaux de compagnie sont recréés en dur dans le code. Cela signifie que les
données ne sont pas persistées (= conservées) et que vous perdez toutes les
données lorsque vous rechargez la page.

Dans cette session, vous allez apprendre à persister (= conserver) les données
des animaux de compagnie dans une base de données SQLite à l'aide de PDO (PHP
Data Objects).

Cela permettra de stocker les données des animaux de compagnie et de les
récupérer à chaque fois que vous rechargez la page, sans avoir à les recréer en
dur dans le code.

Pour cela, il sera nécessaire de créer une base de données SQLite et d'y créer
une table pour stocker les données des animaux de compagnie. Ensuite, vous
pourrez insérer, récupérer et supprimer des données de cette table.

Vous allez également apprendre à utiliser PDO pour interagir avec la base de
données.

À l'issue de cette session, les personnes qui étudient devraient avoir pu :

- Intégrer PDO dans un projet PHP
- Créer une base de données SQLite à l'aide de PDO
- Créer une table pour stocker des données
- Insérer des données dans la table
- Récupérer des données de la table
- Supprimer des données de la table

## Intégration de PDO

Dans cette section, vous allez apprendre à intégrer PDO dans un projet PHP et à
créer une base de données SQLite pour stocker les données des animaux de
compagnie.

### Création du fichier `database.php`

Afin de ne pas mélanger le code de la base de données avec le code de
l'application, nous allons créer un nouveau fichier qui contiendra la connexion
à la base de données. Ce fichier sera inclus dans le fichier `functions.php`
pour que les fonctions puissent y accéder.

Créez un nouveau fichier `database.php` dans le dossier de votre projet.

Votre structure de projet devrait ressembler à ceci :

```text
progserv1/
├── exercices/
│   └── index.php
├── mini-projet/
│   ├── create.php
│   ├── database.php
│   ├── functions.php
│   ├── index.php
│   └── view.php
├── index.php
└── phpinfo.php
```

Ce fichier contiendra la connexion à la base de données SQLite. Il permettra de
se connecter à la base de données et de créer la table pour stocker les données
des animaux de compagnie.

### Création de la base de données pour les animaux de compagnie

Maintenant que vous avez créé le fichier `database.php`, vous allez créer la
base de données SQLite et la table pour stocker les données des animaux de
compagnie.

Pour cela, vous allez utiliser la classe `PDO` pour créer la base de données et
la table.

Complétez le fichier `database.php` avec le code suivant :

```php
<?php
// Chemin vers le fichier de base de données SQLite
const DATABASE_FILE = './petsmanager.db';

// Création d'une instance de PDO pour se connecter à la base de données
$pdo = new PDO("sqlite:" . DATABASE_FILE);
```

La constante `DATABASE_FILE` contient le chemin vers le fichier de base de
données SQLite. Si le fichier n'existe pas, il sera créé automatiquement. La
notation `./` permet de créer le fichier dans le même dossier que le fichier
`database.php`.

Ensuite, nous utilisons la classe `PDO` pour créer une instance de PDO qui se
connecte à la base de données SQLite. La chaîne de connexion `sqlite:` indique
que nous voulons utiliser SQLite comme moteur de base de données.

Nous n'avons pas encore étudié en détail la programmation orientée objet (POO)
en PHP. Pour le moment, il est juste nécessaire de retenir que PDO est une
classe qui permet de se connecter à une base de données et d'exécuter des
requêtes SQL sur celle-ci. Nous étudierons la POO en détail dans un prochain
cours.

Incluez le fichier `database.php` dans le fichier `functions.php` pour que les
fonctions puissent y accéder.

Votre fichier `functions.php` devrait ressembler à ceci :

```php
<?php
// Inclusion du fichier de connexion à la base de données
require 'database.php';

// Le reste du code de `functions.php`
// ...
```

Ouvrez votre navigateur et accédez à l'adresse
<http://localhost/progserv1/mini-projet/index.php>.

Vous devriez voir la page d'accueil de votre application. Pour le moment, le
comportement de l'application n'a pas changé mais vous devriez remarquer qu'un
nouveau fichier `petsmanager.db` a été créé dans le dossier de votre projet.

Votre structure de projet devrait ressembler à ceci :

```text
progserv1/
├── exercices/
│   └── index.php
├── mini-projet/
│   ├── create.php
│   ├── database.php
│   ├── functions.php
│   ├── index.php
│   ├── petsmanager.db
│   └── view.php
├── index.php
└── phpinfo.php
```

Notre base de données SQLite a été créée avec succès !

### Installation de l'extension SQLite dans Visual Studio Code

SQLite est une base de données légère qui est intégrée dans PHP. Cependant, pour
visualiser le contenu de la base de données, vous aurez besoin d'une extension
SQLite pour Visual Studio Code.

Pour cela, installez l'extension
[SQLite Viewer](https://marketplace.visualstudio.com/items?itemName=qwtel.sqlite-viewer)
dans Visual Studio Code.

Si vous ne vous souvenez plus comment installer une extension dans Visual
Studio, vous pouvez vous référer au premier mini-projet
_[Cours 01 - Modalités de l'unité d'enseignement et introduction à PHP](../../01-modalites-de-lunite-denseignement-et-introduction-a-php/02-mini-project/README.md)_
pour vous rappeler comment faire.

### Visualisation du continu de la base de données

Maintenant que l'extension SQLite Viewer est installée, vous pouvez visualiser
le contenu de la base de données.

Pour cela, ouvrez le fichier `petsmanager.db` dans Visual Studio Code. La base
de données devrait s'ouvrir dans un nouvel onglet.

Vous devriez voir une vue de la base de données avec les tables et les données
qu'elle contient.

Actuellement, la base de données est vide. Nous allons maintenant créer la table
pour stocker les données des animaux de compagnie.

### Création de la table pour les animaux de compagnie

Afin de stocker les données des animaux de compagnie, nous allons créer une
table dans la base de données SQLite.

Pour cela, nous allons créer une table `pets` qui contiendra les colonnes
suivantes :

- `id` : identifiant unique de l'animal (clé primaire, auto-incrémentée)
- `name` : nom de l'animal (obligatoire, de type texte)
- `species` : espèce de l'animal (obligatoire, de type texte)
- `nickname` : surnom de l'animal (facultatif, de type texte)
- `sex` : sexe de l'animal (obligatoire, de type texte)
- `age` : âge de l'animal (obligatoire, de type entier)
- `color` : couleur de l'animal (facultatif, de type texte)
- `personalities` : personnalités de l'animal (facultatif, de type texte)
- `size` : taille de l'animal (facultatif, de type réel)
- `notes` : notes sur l'animal (facultatif, de type texte)

Pour créer la table, nous allons exécuter une requête SQL dans le fichier
`database.php`. Mettez à jour le fichier `database.php` avec le code suivant :

```php
<?php
// Chemin vers le fichier de base de données SQLite
const DATABASE_FILE = './petsmanager.db';

// Création d'une instance de PDO pour se connecter à la base de données
$pdo = new PDO("sqlite:" . DATABASE_FILE);

// On définit la requête SQL pour créer la table `pets` si elle n'existe pas déjà
$sql = "CREATE TABLE IF NOT EXISTS pets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    species TEXT NOT NULL,
    nickname TEXT,
    sex TEXT NOT NULL,
    age INTEGER NOT NULL,
    color TEXT,
    personalities TEXT,
    size FLOAT,
    notes TEXT
);";

// On exécute la requête SQL pour créer la table
$pdo->exec($sql);
```

La requête SQL `CREATE TABLE IF NOT EXISTS` permet de créer la table `pets` si
elle n'existe pas déjà. Les colonnes de la table sont définies avec leurs types
et contraintes.

La colonne `id` est définie comme clé primaire et sera incrémentée
automatiquement lorsqu'un nouvel enregistrement sera inséré dans la table.

Afin d'exécuter la requête SQL, nous utilisons la méthode `exec()` de l'objet
`$pdo`. Cette méthode exécute une requête SQL sans retourner de résultats.

Ouvrez votre navigateur et accédez à l'adresse
<http://localhost/progserv1/mini-projet/index.php>.

Vous devriez voir la page d'accueil de votre application. Pour le moment, le
comportement de l'application n'a pas changé mais vous devriez remarquer que la
table `pets` a été créée dans la base de données grâce à l'extension SQLite
Viewer.

La table `pets` devrait maintenant apparaître dans la vue de la base de données.
Vous pouvez cliquer sur la table pour voir sa structure et ses données.

Si à un moment donné vous souhaitez réinitialiser la base de données, vous
pouvez supprimer le fichier `petsmanager.db` et recharger la page
<http://localhost/progserv1/mini-projet/index.php>. Cela recréera la base de
données et la table.

La base de données est maintenant prête à être utilisée. Vous allez maintenant
mettre à jour les fonctions pour gérer les animaux de compagnie dans la base de
données.

## Gestion des animaux de compagnie

Dans cette section, vous allez mettre à jour les fonctions pour gérer les
animaux de compagnie dans la base de données. Vous allez mettre à jour les
fonctions pour créer un nouvel animal de compagnie, récupérer tous les animaux
de compagnie, mettre à jour un animal de compagnie et supprimer un animal de
compagnie de la base de données.

### Création d'un animal de compagnie

Suite au travail effectué dans le cours précédent
([Cours 04 - Formulaires HTML et validation](../../04-formulaires-html-et-validation/02-mini-project/README.md)),
vous avez déjà un formulaire pour créer un nouvel animal de compagnie. Vous
allez maintenant mettre à jour la fonction `createPet()` dans le fichier
`functions.php` pour insérer un nouvel animal de compagnie dans la base de
données.

Pour cela, vous allez utiliser une requête SQL `INSERT INTO` pour insérer les
données de l'animal de compagnie dans la table `pets`.

#### Mise à jour du fichier `functions.php`

Mettez à jour la fonction `createPet()` dans le fichier `functions.php` avec le
code suivant :

```php
function addPet(
    $name,
    $species,
    $nickname,
    $sex,
    $age,
    $color,
    $personalities,
    $size,
    $notes
) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
    // Même si c'est une mauvaise pratique, c'est nécessaire ici.
    global $pdo;

    // On définit la requête SQL pour ajouter un animal
    $sql = "INSERT INTO pets (
        name,
        species,
        nickname,
        sex,
        age,
        color,
        personalities,
        size,
        notes
    ) VALUES (
        '$name',
        '$species',
        '$nickname',
        '$sex',
        $age,
        '$color',
        '$personalities',
        $size,
        '$notes'
    )";

    // On exécute la requête SQL pour ajouter un animal
    $pdo->exec($sql);

    // On récupère l'identifiant de l'animal ajouté
    $petId = $pdo->lastInsertId();

    // On retourne l'identifiant de l'animal ajouté.
    return $petId;
}
```

La fonction `addPet()` permet d'ajouter un nouvel animal de compagnie dans la
base de données. Elle prend en paramètres tous les champs du formulaire d'ajout
d'un animal de compagnie.

Tout comme précédemment, le mot-clé `global` est utilisé pour accéder à la
variable `$pdo` qui contient la connexion à la base de données. Ce mot-clé est
nécessaire car la variable `$pdo` est définie dans le fichier `database.php` et
n'est pas accessible directement dans la fonction.

La variable `$sql` contient la requête SQL `INSERT INTO` pour insérer un nouvel
animal de compagnie dans la table `pets` avec les valeurs des colonnes. Les
valeurs sont liées aux paramètres de la fonction.

La méthode `exec()` de l'objet `$pdo` est utilisée pour exécuter la requête SQL
et insérer l'animal de compagnie dans la base de données.

La méthode `lastInsertId()` permet de récupérer l'identifiant de l'animal de
compagnie qui vient d'être ajouté. Cet identifiant est retourné par la fonction
`addPet()`.

Cela permet de récupérer l'identifiant automatiquement généré par la base de
données lors de l'insertion de l'animal de compagnie. Cet identifiant peut
ensuite être utilisé pour afficher l'animal de compagnie ou pour effectuer
d'autres opérations sur cet animal.

#### Mise à jour de l'interface utilisateur

Afin de tester la fonction `addPet()`, vous allez mettre à jour le fichier
`create.php` (qui contient le formulaire d'ajout d'un animal de compagnie) afin
d'appeler la fonction `addPet()` lorsque le formulaire est soumis.

Mettez à jour le fichier `create.php` avec le code suivant :

```php
<?php
require 'functions.php';

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

    // Si le formulaire est valide, on ajoute l'animal
    if (empty($errors)) {
        // On ajoute l'animal à la base de données
        $petId = addPet(
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
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>

<!-- La suite du code HTML pour le formulaire d'ajout d'un animal de compagnie -->
<!-- ... -->
```

Dans ce code, nous avons inclus le fichier `functions.php` pour pouvoir utiliser
la fonction `addPet()`. Ensuite, nous avons géré la soumission du formulaire en
récupérant les données du formulaire et en les validant comme cela a déjà été
fait dans le cours précédent.

La seule différence réside dans le fait que si le formulaire est valide -
c'est-à-dire que toutes les données sont valides et que le tableau `$errors` est
vide - nous appelons la fonction `addPet()` pour ajouter l'animal de compagnie
dans la base de données. Nous passons les données du formulaire en tant que
paramètres à la fonction `addPet()` qui va insérer l'animal de compagnie dans la
base de données.

#### Tests et corrections de la fonction `addPet()`

Ouvrez votre navigateur et accédez à l'adresse
<http://localhost/progserv1/mini-projet/create.php>. Vous devriez voir le
formulaire d'ajout d'un animal de compagnie.

Remplissez le formulaire avec les données d'un animal de compagnie et
soumettez-le :

- Nom : _"Mew"_
- Espèce : _"Chat"_
- Surnom : _"Minou"_
- Sexe : _"Mâle"_
- Âge : _"3"_
- Couleur : _"Noir"_
- Personnalités : _"Agressif, Paresseux"_
- Taille : _"23"_
- Notes : _"Aime dormir sur le canapé"_

Vous remarquerez alors qu'une erreur s'affiche :

```text
Warning: Array to string conversion
```

> [!NOTE]
>
> Le message d'erreur ne s'affiche pas ? Une simple page blanche s'affiche à la
> place ?
>
> Vérifiez que l'affichage des erreurs est activé dans le fichier `php.ini` de
> votre serveur local. Vous pouvez suivre les instructions suivantes pour
> activer les messages d'erreurs dans le navigateur :
> [Activation des messages d'erreurs de PHP dans le navigateur](../../01-modalites-de-lunite-denseignement-et-introduction-a-php/02-mini-project/README.md#activation-des-messages-derreurs-de-php-dans-le-navigateur).

En effet, notre table `pets` contient un champ `personalities` qui est un champ
texte.

Par contre, dans le formulaire, ce champ est un tableau.

Malheureusement, SQLite ne supporte pas les champs de type tableau et nous
devons donc le convertir en chaîne de caractères avant de l'insérer dans la base
de données.

Cela signifie que nous devons convertir le tableau en chaîne de caractères avant
de l'insérer dans la base de données grâce à la fonction
[`implode()`](<[https://](https://www.php.net/manual/fr/function.implode.php)>)
de PHP.

La fonction `implode()` permet de convertir un tableau en chaîne de caractères
en utilisant un séparateur. Par exemple, si nous avons un tableau
`$personalities` contenant les valeurs `['gentil', 'joueur']`, nous pouvons le
convertir en chaîne de caractères avec la fonction `implode()` comme ceci :

```php
$personalities = ['gentil', 'playful'];
$personalitiesAsString = implode(',', $personalities);
```

La variable `$personalitiesAsString` contiendra alors la chaîne de caractères
`'gentil,playful'`.

Ensuite, nous pourrons insérer cette chaîne de caractères dans la base de
données. Nous allons donc mettre à jour la fonction `addPet()` pour convertir le
tableau `$personalities` en chaîne de caractères avant de l'insérer dans la base
de données :

```php
function addPet(
    $name,
    $species,
    $nickname,
    $sex,
    $age,
    $color,
    $personalities,
    $size,
    $notes
) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
    // Même si c'est une mauvaise pratique, c'est nécessaire ici.
    global $pdo;

    // On transforme le tableau `$personalities` en chaîne de caractères avec `implode`
    $personalitiesAsString = implode(',', $personalities);

    // On définit la requête SQL pour ajouter un animal
    $sql = "INSERT INTO pets (
        name,
        species,
        nickname,
        sex,
        age,
        color,
        personalities,
        size,
        notes
    ) VALUES (
        '$name',
        '$species',
        '$nickname',
        '$sex',
        $age,
        '$color',
        '$personalitiesAsString',
        $size,
        '$notes'
    )";

    // On exécute la requête SQL pour ajouter un animal
    $pdo->exec($sql);

    // On récupère l'identifiant de l'animal ajouté
    $petId = $pdo->lastInsertId();

    // On retourne l'identifiant de l'animal ajouté.
    return $petId;
}
```

Vous pouvez maintenant tester à nouveau la fonction `addPet()` en remplissant le
formulaire d'ajout d'un animal de compagnie et en le soumettant.

Cette fois-ci, l'animal de compagnie devrait être ajouté à la base de données
sans erreur.

Vous pouvez vérifier que l'animal de compagnie a bien été ajouté à la base de
données en ouvrant le fichier `petsmanager.db` dans Visual Studio Code et en
vérifiant que la table `pets` contient bien l'animal de compagnie que vous venez
d'ajouter.

Notez que la chaîne de caractères contenant les personnalités de l'animal de
compagnie est séparée par des virgules et que les valeurs des colonnes `species`
et `sex` contiennent les valeurs liées au formulaire (les valeurs `value` des
différents champs du formulaire) et non pas les valeurs affichées dans le
formulaire. Par exemple, si vous avez sélectionné l'espèce _"Chat"_ dans le
formulaire, la valeur de la colonne `species` sera `cat` et non pas _"Chat"_.

Vous pouvez faire des essais avec d'autres animaux de compagnie en remplissant
le formulaire et en le soumettant.

> [!WARNING]
>
> Vous remarquerez peut-être que si l'un des champs du formulaire contient un
> guillemet simple (par exemple, _"Il aime s'étirer après avoir fait une
> sieste"_), une erreur de syntaxe SQL s'affiche.
>
> Nous corrigerons ce problème dans le prochain cours.

#### Redirection vers la page d'accueil

Actuellement, une fois que l'animal de compagnie a été ajouté à la base de
données, le formulaire affiche un message de succès mais reste sur la même page.
Pour améliorer l'expérience utilisateur, vous pouvez rediriger l'utilisateur
vers la page d'accueil une fois que l'animal de compagnie a été ajouté avec
succès.

Pour cela, vous pouvez utiliser les fonctions
[`header()`](https://www.php.net/manual/fr/function.header.php) et
[`exit()`](https://www.php.net/manual/fr/function.exit.php) de PHP.

La fonction `header()` permet d'envoyer un en-tête HTTP au navigateur pour
rediriger l'utilisateur vers une autre page. Vous pouvez l'utiliser pour
rediriger l'utilisateur vers la page d'accueil après avoir ajouté l'animal de
compagnie.

Ajoutez le code suivant à la fin du fichier `create.php` après l'appel à la
fonction `addPet()` :

```php
        // On redirige vers la page d'accueil avec tous les animaux
        header("Location: index.php");
        exit();
```

Votre fichier `create.php` devrait ressembler à ceci :

```php
<?php
require 'functions.php';

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

    // Si le formulaire est valide, on ajoute l'animal
    if (empty($errors)) {
        // On ajoute l'animal à la base de données
        $petId = addPet(
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

<!-- La suite du code HTML pour le formulaire d'ajout d'un animal de compagnie -->
<!-- ... -->
```

Cela enverra un en-tête HTTP au navigateur pour rediriger l'utilisateur vers la
page `index.php` après avoir ajouté l'animal de compagnie.

N'oubliez pas d'ajouter la fonction `exit()` après l'appel à la fonction
`header()` pour arrêter l'exécution du script PHP. Cela évitera que le code PHP
suivant soit exécuté après la redirection.

Vous pouvez maintenant tester la redirection en ajoutant un nouvel animal de
compagnie. Une fois que l'animal de compagnie a été ajouté, vous devriez être
redirigé vers la page d'accueil qui affiche tous les animaux de compagnie.

Pour le moment, la page d'accueil affiche une erreur car nous n'avons pas encore
mis à jour le code pour récupérer les animaux de compagnie de la base de
données. Nous allons le faire dans la section suivante.

### Récupération de tous les animaux de compagnie

Maintenant que nous avons une base de données pour stocker les animaux de
compagnie, nous allons supprimer le code qui crée les animaux de compagnie en
dur dans le fichier `index.php`.

En effet, celui-ci contient encore le code qui crée les animaux de compagnie en
dur qui a été utilisé dans les cours précédents. Nous allons le remplacer par du
code qui récupère les animaux de compagnie de la base de données.

#### Suppression des animaux de compagnie créés en dur

Ouvrez le fichier `index.php` et supprimez le code qui crée les animaux de
compagnie en dur.

Votre fichier `index.php` devrait ressembler à ceci :

```php
<?php
require 'functions.php';

// Récupère tous les animaux
$pets = getPets();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page d'accueil | Gestionnaire d'animaux de compagnie</title>

<!-- La suite du code HTML pour la page d'accueil -->
<!-- ... -->
```

Si vous accédez à la page d'accueil de votre application, l'erreur précédente
devrait avoir disparu. Cependant, la page d'accueil n'affiche toujours pas
d'animaux de compagnie car nous n'avons pas encore mis à jour le code pour
récupérer les animaux de compagnie de la base de données.

#### Mise à jour du fichier `functions.php`

Pour récupérer tous les animaux de compagnie, vous allez mettre à jour la
fonction `getPets()` dans le fichier `functions.php`. Cette fonction va exécuter
une requête SQL pour récupérer tous les animaux de compagnie dans la table
`pets`.

Mettez à jour la fonction `getPets()` dans le fichier `functions.php` avec le
code suivant :

```php

function getPets() {
    // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
    // Même si c'est une mauvaise pratique, c'est nécessaire ici.
    global $pdo;

    // On définit la requête SQL pour récupérer tous les animaux
    $sql = "SELECT * FROM pets";

    // On récupère tous les animaux
    $pets = $pdo->query($sql);

    // On transforme le résultat en tableau associatif
    $pets = $pets->fetchAll();

    // On transforme la chaîne `personalities` en tableau pour chaque animal
    foreach ($pets as &$pet) {
        if (!empty($pet['personalities'])) {
            $pet['personalities'] = explode(',', $pet['personalities']);
        }
    }

    // On retourne tous les animaux
    return $pets;
}
```

La fonction `getPets()` exécute une requête SQL `SELECT * FROM pets` pour
récupérer tous les animaux de compagnie dans la table `pets`. La méthode
`query()` de l'objet `$pdo` est utilisée pour exécuter la requête SQL et
récupérer le résultat, à l'inverse de la méthode `exec()` qui est utilisée pour
exécuter des requêtes SQL sans retourner de résultats.

La méthode `fetchAll()` permet de récupérer tous les résultats de la requête
sous forme de tableau associatif. Cela signifie que chaque ligne de la table
`pets` sera un tableau associatif avec les noms des colonnes comme clés.

Ensuite, nous transformons la chaîne `personalities` en tableau pour chaque
animal de compagnie en utilisant la fonction
[`explode()`](https://www.php.net/manual/fr/function.explode.php) de PHP.

Cela permet de convertir la chaîne de caractères contenant les personnalités
séparées par des virgules en un tableau de personnalités afin de rester cohérent
avec le formulaire d'ajout d'un animal de compagnie.

Ce processus de conversion entre un objet PHP et une chaîne de caractères est
appelé "sérialisation"/"désérialisation"
([Page Wikipédia](https://fr.wikipedia.org/wiki/S%C3%A9rialisation)).

La sérialisation est le processus de conversion d'un objet PHP en une chaîne de
caractères afin de pouvoir le stocker dans une base de données ou de le
transmettre sur le réseau. Ici, le passage du tableau associatif à la chaîne de
caractères est effectué par la fonction `implode()`.

La désérialisation est le processus inverse, qui consiste à convertir une chaîne
de caractères en un objet PHP. Ici, le passage de la chaîne de caractères au
tableau associatif est effectué par la fonction `explode()`.

Le processus de sérialisation/désérialisation est effectué pour chaque animal de
compagnie dans la boucle `foreach`.

La fonction `getPets()` retourne ensuite le tableau associatif contenant tous
les animaux de compagnie.

Si vous accédez à la page d'accueil de votre application, vous devriez
maintenant voir la liste des animaux de compagnie qui ont été ajoutés à la base
de données avec, pour le moment, leur nom et leur âge.

Si vous n'avez pas encore ajouté d'animaux de compagnie, la liste sera vide.
Vous pouvez ajouter un nouvel animal de compagnie en accédant à la page
<http://localhost/progserv1/mini-projet/create.php>.

#### Mise à jour de l'interface utilisateur

Maintenant que vous avez mis à jour la fonction `getPets()` pour récupérer les
animaux de compagnie de la base de données, vous devez mettre à jour le code
HTML de la page d'accueil pour afficher les animaux de compagnie.

Mettez à jour le fichier `index.php` avec le code suivant :

```php
<!-- ... -->

<body>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pets as $pet) { ?>
                <tr>
                    <td><?= $pet['name'] ?></td>
                    <td><?= $pet['species'] ?></td>
                    <td><?= $pet['sex'] ?></td>
                    <td><?= $pet['age'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

<!-- ... -->
```

Dans ce code, nous avons ajouté un bouton pour créer un nouvel animal de
compagnie qui redirige vers la page `create.php`.

Nous avons également mis à jour le tableau pour afficher la liste des animaux de
compagnie. Le tableau contient les colonnes `Nom`, `Espèce`, `Sexe` et `Âge` qui
sont les seules valeurs obligatoires pour chaque animal de compagnie.

Le tableau est rempli avec les valeurs correspondantes pour chaque animal de
compagnie.

La boucle `foreach` parcourt le tableau `$pets` contenant tous les animaux de
compagnie et affiche les valeurs de chaque animal dans une nouvelle ligne du
tableau.

Pour le moment, les valeurs des colonnes _"Espèce"_ et _"Sexe"_ conviennent les
valeurs des colonnes de la base de données. Dans la suite, nous allons mettre à
jour le code pour afficher les valeurs affichées issues du formulaire d'ajout
d'un animal de compagnie. Cela permettra d'afficher les valeurs _"Chat"_ à la
place de `cat` selon l'exemple précédent.

Grâce au bouton, vous pouvez maintenant créer un nouvel animal de compagnie et
le voir apparaître dans la liste des animaux de compagnie sur la page d'accueil.

### Récupération d'un animal de compagnie

Jusqu'à présent dans le mini-projet, nous avions créé un formulaire pour ajouter
un nouvel animal de compagnie et nous avions mis à jour la page d'accueil pour
afficher la liste des animaux de compagnie. Nous allons maintenant mettre à jour
le code pour afficher les détails d'un animal de compagnie.

#### Mise à jour du fichier `functions.php`

Mettez à jour la fonction `getPet()` dans le fichier `functions.php` avec le
code suivant :

```php
function getPet($id) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
    // Même si c'est une mauvaise pratique, c'est nécessaire ici.
    global $pdo;

    // On définit la requête SQL pour récupérer un animal
    $sql = "SELECT * FROM pets WHERE id = '$id'";

    // On récupère l'animal spécifique
    $pet = $pdo->query($sql);

    // On transforme le résultat en tableau associatif
    $pet = $pet->fetch();

    // On transforme la chaîne `personalities` en tableau si elle existe
    if ($pet && !empty($pet['personalities'])) {
        $pet['personalities'] = explode(',', $pet['personalities']);
    }

    // On retourne l'animal
    return $pet;
}
```

A l'inverse de ce qui était fait précédemment, la fonction `getPet()` s'attend
maintenant à recevoir un identifiant d'animal de compagnie en paramètre plutôt
qu'un nom. Cet identifiant est utilisé pour récupérer un animal de compagnie
spécifique dans la base de données.

La fonction exécute une requête SQL `SELECT * FROM pets WHERE id = '$id'` pour
récupérer un animal de compagnie dans la table `pets` en fonction de son
identifiant. La méthode `query()` de l'objet `$pdo` est utilisée pour exécuter
la requête SQL et récupérer le résultat.

La méthode `fetch()` permet de transformer le résultat de la requête SQL en un
tableau associatif.

La différence avec la méthode `fetchAll()` est que cette dernière est utilisée
lorsque plusieurs résultats sont attendus, tandis que la méthode `fetch()` est
utilisée lorsque vous vous attendez à un seul résultat. La méthode `fetchAll()`
est donc utilisée pour récupérer tous les résultats d'une requête SQL, tandis
que la méthode `fetch()` est utilisée pour récupérer un seul résultat.

#### Mise à jour de l'interface utilisateur

Le tableau de la page d'accueil affiche actuellement la liste des animaux de
compagnie. Nous allons maintenant mettre à jour le code pour afficher une
colonne d'actions permettant de visualiser les détails d'un animal de compagnie.

Mettez à jour le fichier `index.php` avec le code suivant :

```php
<!-- ... -->

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
                    <td><?= $pet['name'] ?></td>
                    <td><?= $pet['species'] ?></td>
                    <td><?= $pet['sex'] ?></td>
                    <td><?= $pet['age'] ?></td>
                    <td>
                        <a href="view.php?id=<?= $pet['id'] ?>"><button>Visualiser</button></a>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<!-- ... -->
```

Dans ce code, nous avons ajouté une nouvelle colonne _"Actions"_ au tableau qui
contient un bouton _"Visualiser"_ pour chaque animal de compagnie. Ce bouton
redirige vers la page `view.php` avec l'identifiant de l'animal de compagnie en
paramètre. Cela permettra d'afficher les détails de l'animal de compagnie
lorsque l'utilisateur cliquera sur le bouton _"Visualiser"_.

L'identifiant de l'animal de compagnie est passé dans l'URL en tant que
paramètre `id`. Cela signifie que lorsque l'utilisateur cliquera sur le bouton
_"Visualiser"_, l'URL de la page `view.php` sera `view.php?id=1` si
l'identifiant de l'animal de compagnie est `1`.

Mettons maintenant à jour le fichier `view.php` pour afficher les détails de
l'animal de compagnie. Ouvrez le fichier `view.php` et mettez-le à jour avec le
code suivant :

```php
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
    </form>
</body>

</html>
```

Ce code est quasi identique à celui du formulaire d'ajout d'un animal de
compagnie. La seule différence est que tous les champs du formulaire sont
désactivés (`disabled`) pour empêcher l'utilisateur de modifier les informations
de l'animal de compagnie et que toute la logique de création d'un animal de
compagnie a été supprimée (comme nous ne souhaitons que visualiser les
informations de l'animal de compagnie, nous n'avons pas besoin de la validation
des erreurs, les données du formulaire, etc.).

La seule chose que nous avons ajoutée est la vérification de l'identifiant de
l'animal de compagnie passé dans l'URL.

Grâce à la superglobale `$_GET`, nous pouvons récupérer l'identifiant de
l'animal de compagnie passé dans l'URL.

La superglobale `$_GET` est, comme la superglobale `$_POST`, un tableau
associatif contenant les données envoyées par le navigateur au serveur. La
différence est que la superglobale `$_GET` contient les données envoyées par le
navigateur dans l'URL, tandis que la superglobale `$_POST` contient les données
envoyées par le navigateur dans le corps de la requête HTTP.

Si une personne accède à la page `view.php` avec l'URL
`http://localhost/progserv1/mini-projet/view.php?id=1`, la superglobale `$_GET`
contiendra un tableau associatif avec la clé `id` et la valeur `1`.

Grâce à cela, nous vérifions donc si l'identifiant de l'animal de compagnie est
passé dans l'URL en utilisant la superglobale `$_GET`. Si l'identifiant est
passé dans

Nous vérifions ensuite si l'identifiant a bien été passé dans l'URL. Si c'est le
cas, nous appelons la fonction `getPet()` pour récupérer l'animal de compagnie
correspondant à cet identifiant.

Si l'animal de compagnie n'existe pas, nous redirigeons l'utilisateur vers la
page d'accueil. Cela peut arriver si l'utilisateur essaie d'accéder à un animal
de compagnie qui n'existe pas dans la base de données.

Si l'identifiant n'est pas passé dans l'URL, nous redirigeons également
l'utilisateur vers la page d'accueil. Cela peut arriver si l'utilisateur essaie
d'accéder à la page `view.php` sans passer d'identifiant dans l'URL.

Si l'identifiant est passé dans l'URL, nous appelons la fonction `getPet()` pour
récupérer l'animal de compagnie correspondant à cet identifiant. Nous récupérons
ensuite les informations de l'animal de compagnie et les affichons dans le
formulaire.

### Suppression d'un animal de compagnie

Nous allons maintenant mettre à jour le code pour supprimer un animal de
compagnie.

#### Mise à jour du fichier `functions.php`

Mettez à jour la fonction `removePet()` dans le fichier `functions.php` avec le
code suivant :

```php

function removePet($id) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
    // Même si c'est une mauvaise pratique, c'est nécessaire ici.
    global $pdo;

    // On définit la requête SQL pour supprimer un animal
    $sql = "DELETE FROM pets WHERE id = '$id'";

    // On exécute la requête SQL pour supprimer un animal
    return $pdo->exec($sql);
}
```

Tout comme pour la fonction `getPet()`, la fonction `removePet()` s'attend à
recevoir un identifiant d'animal de compagnie en paramètre. Cet identifiant est
utilisé pour supprimer un animal de compagnie spécifique dans la base de
données.

La fonction exécute une requête SQL `DELETE FROM pets WHERE id = '$id'` pour
supprimer un animal de compagnie dans la table `pets` en fonction de son
identifiant. La méthode `exec()` de l'objet `$pdo` est utilisée pour exécuter la
requête SQL.

La méthode `exec()` retourne le nombre de lignes affectées par la requête SQL.
Dans le cas d'une requête `DELETE`, cela correspond au nombre d'animaux de
compagnie supprimés de la base de données.

Cela peut être utile pour vérifier si l'animal de compagnie a bien été supprimé
de la base de données.

#### Mise à jour de l'interface utilisateur

Nous allons maintenant créer une nouvelle page `delete.php` qui va supprimer un
animal de compagnie de la base de données.

Créez un nouveau fichier `delete.php`.

Votre structure de projet devrait ressembler à ceci :

```text
progserv1/
├── exercices/
│   └── index.php
├── mini-projet/
│   ├── create.php
│   ├── database.php
│   ├── delete.php
│   ├── functions.php
│   ├── index.php
│   ├── petsmanager.db
│   └── view.php
├── index.php
└── phpinfo.php
```

Ouvrez le fichier `delete.php` et ajoutez le code suivant :

```php
<?php
require 'functions.php';

// On vérifie si l'ID de l'animal est passé dans l'URL
if (isset($_GET["id"])) {
    // On récupère l'ID de l'animal de la superglobale `$_GET`
    $petId = $_GET["id"];

    // On supprime l'animal correspondant à l'ID
    removePet($petId);

    header("Location: index.php");
    exit();
} else {
    // Si l'ID n'est pas passé dans l'URL, on redirige vers la page d'accueil
    header("Location: index.php");
    exit();
}
```

Dans ce code, très similaire à celui de la page `view.php`, nous vérifions si
l'identifiant de l'animal de compagnie est passé dans l'URL. Si c'est le cas,
nous appelons la fonction `removePet()` pour supprimer l'animal de compagnie
correspondant à cet identifiant.

Si l'animal de compagnie a bien été supprimé, nous redirigeons l'utilisateur
vers la page d'accueil. Cela permettra de mettre à jour la liste des animaux de
compagnie affichée sur la page d'accueil.

Si l'identifiant n'est pas passé dans l'URL, nous redirigeons également
l'utilisateur vers la page d'accueil. Cela peut arriver si l'utilisateur essaie
d'accéder à la page `delete.php` sans passer d'identifiant dans l'URL.

Mettons maintenant à jour le fichier `index.php` pour rajouter un bouton
_"Supprimer"_ qui permettra de supprimer l'animal de compagnie dans la colonne
des actions.

Mettez à jour le fichier `index.php` avec le code suivant :

```php
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
                    <td><?= $pet['name'] ?></td>
                    <td><?= $pet['species'] ?></td>
                    <td><?= $pet['sex'] ?></td>
                    <td><?= $pet['age'] ?></td>
                    <td>
                        <a href="delete.php?id=<?= $pet['id'] ?>"><button>Supprimer</button></a>
                        <a href="view.php?id=<?= $pet['id'] ?>"><button>Visualiser</button></a>
                </tr>
            <?php } ?>
        </tbody>
    </table>
```

Lorsque l'utilisateur cliquera sur le bouton _"Supprimer"_, il sera redirigé
vers la page `delete.php` avec l'identifiant de l'animal de compagnie en
paramètre. La page `delete.php` supprimera l'animal de compagnie de la base de
données et redirigera l'utilisateur vers la page d'accueil.

Nous allons maintenant mettre à jour le fichier `view.php` pour ajouter un
bouton _"Supprimer"_ qui permettra de supprimer l'animal de compagnie. Mettez à
jour le fichier `view.php` avec le code suivant :

```php
<!-- ... -->

        <a href="delete.php?id=<?= $pet["id"] ?>">
            <button type="button">Supprimer</button>
        </a>
    </form>
</body>

</html>
```

Dans ce code, nous avons ajouté un bouton _"Supprimer"_ qui redirige vers la
page `delete.php` avec l'identifiant de l'animal de compagnie en paramètre,
comme pour la page `view.php`.

Cela permettra de supprimer l'animal de compagnie lorsque l'utilisateur cliquera
sur le bouton _"Supprimer"_.

### Mise à jour d'un animal de compagnie

La mise à jour d'un animal de compagnie sera réalisée dans le prochain cours,
ayant des particularités différentes de la création et de la visualisation d'un
animal de compagnie.

## Dernières étapes et validation

Nous avons maintenant terminé la mise à jour de l'application pour utiliser une
base de données pour stocker les animaux de compagnie.

Nous allons maintenant effectuer les dernières étapes pour valider que tout
fonctionne correctement.

### Nettoyage du code

Nous allons maintenant nettoyer le code pour supprimer les parties de code
inutiles.

Dans le fichier`functions.php`, supprimez la variable `$pets` qui contenait les
les animaux de compagnie créés en dur. Cette variable n'est plus nécessaire car
nous utilisons maintenant une base de données pour stocker les animaux de
compagnie.

Votre fichier `functions.php` devrait ressembler à ceci :

```php
<?php
// Inclusion du fichier de connexion à la base de données
require 'database.php';

function getPets() {
  // Le corps de la fonction `getPets()`
  // ...
}

// Le reste du code de `functions.php`
// ...
```

### Valider que tout est fonctionnel

Votre application devrait maintenant être fonctionnelle. Vous devriez être
capable d'ajouter un nouvel animal de compagnie, de visualiser la liste de tous
les animaux de compagnie, de visualiser les détails d'un animal de compagnie et
de supprimer un animal de compagnie.

Si vous avez suivi toutes les étapes du mini-projet, vous devriez avoir une
application fonctionnelle qui utilise une base de données SQLite pour stocker
les animaux de compagnie et permettre de persister les données entre les
rafraîchissements de la page.

## Solution

Vous pouvez trouver la solution du mini-projet PHP à l'adresse suivante :
[`solution`](./solution/).

## Conclusion

Dans ce cours, nous avons mis à jour le mini-projet PHP pour utiliser une base
de données pour stocker les animaux de compagnie.

Nous avons créé une base de données SQLite et une table `pets` pour stocker les
animaux de compagnie.

Nous avons également mis à jour le code pour ajouter, récupérer, supprimer et
visualiser les animaux de compagnie dans la base de données.

Nous arrivons gentiment à la fin de ce mini-projet. Dans le prochain cours, nous
allons mettre à jour le code pour permettre de modifier un animal de compagnie
et sécuriser les saisies utilisateur pour éviter les injections SQL.

## Aller plus loin

_Ceci est une section optionnelle pour les personnes qui souhaitent aller plus
loin. Vous pouvez la sauter si vous n'avez pas de temps._

- Arrivez-vous à rediriger l'utilisateur vers la page des détails de l'animal de
  compagnie après l'avoir ajouté ?
- Arrivez-vous à afficher un message de succès lorsque l'animal de compagnie a
  été ajouté avec succès ?
  - **Astuce** : vous pourriez passer un paramètre dans l'URL pour indiquer que
    l'animal de compagnie a été ajouté avec succès. Il ne s'agit pas de la
    solution la plus élégante, mais elle fonctionne.
- Arrivez-vous à rendre la page d'accueil plus jolie en ajoutant des styles CSS
  ?
