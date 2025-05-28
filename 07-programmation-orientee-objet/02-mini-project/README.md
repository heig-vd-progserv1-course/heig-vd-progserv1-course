# Cours 07 - Programmation orientée objet - Mini-projet

Ce mini-projet est conçu pour vous permettre de mettre en pratique les concepts
théoriques vus dans le cours
_[Cours 07 - Programmation orientée objet](../01-theorie/README.md)_.

## Ressources

- Théorie : [Support de cours](../01-theorie/README.md) ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/07-programmation-orientee-objet/01-theorie/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/07-programmation-orientee-objet/01-theorie/07-programmation-orientee-objet-presentation.pdf)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Exercices : [Énoncés et solutions](../03-exercices/README.md)

## Table des matières

- [Ressources](#ressources)
- [Table des matières](#table-des-matières)
- [Objectifs de la session](#objectifs-de-la-session)
- [Identification des problèmes de conception](#identification-des-problèmes-de-conception)
- [Correction des problèmes de conception](#correction-des-problèmes-de-conception)
  - [Séparation des pages publiques et la logique métier](#séparation-des-pages-publiques-et-la-logique-métier)
  - [Création de la classe `Pet`](#création-de-la-classe-pet)
  - [Création de la classe `Database`](#création-de-la-classe-database)
  - [Création de la classe `PetManager`](#création-de-la-classe-petmanager)
  - [Utilisation des classes dans les pages publiques](#utilisation-des-classes-dans-les-pages-publiques)
  - [Centralisation des espèces et du sexe d'un animal](#centralisation-des-espèces-et-du-sexe-dun-animal)
  - [Centralisation de la logique de validation](#centralisation-de-la-logique-de-validation)
- [Solution](#solution)
- [Conclusion](#conclusion)
- [Aller plus loin](#aller-plus-loin)

## Objectifs de la session

Vous avez maintenant une petite application PHP qui vous permet de gérer des
animaux de compagnie. Vous pouvez ajouter, modifier et supprimer des animaux,
ainsi que les afficher dans une liste. Le tout, sécurisé contre les injections
SQL et les attaques XSS.

Cependant, le code de l'application n'est pas encore très bien structuré. Il est
temps de le refactoriser pour le rendre plus lisible et maintenable grâce à la
programmation orientée objet (POO).

De façon plus concise, les personnes qui étudient devraient avoir pu :

- Appliquer les concepts de la programmation orientée objet (POO) en PHP pour
  structurer une application simple.
- Créer des classes et des objets pour représenter les entités de l'application.
- Instancier des objets et utiliser leurs méthodes pour interagir avec
  l'application.
- Améliorer la lisibilité et la maintenabilité du code en utilisant les
  principes de la POO.

## Identification des problèmes de conception

Avant de commencer à refactoriser le code, il est important d'identifier les
problèmes de conception qui existent dans l'application actuelle. Voici quelques
problèmes que vous pourriez rencontrer :

- Les script PHP mélangent les pages publiques (`create.php`, `edit.php`,
  `delete.php`, `view.php` et `index.php`) et la logique métier (`functions.php`
  et `database.php`) dans un même dossier. Ceci rend la séparation des
  responsabilité plus complexe (qui a accès à quoi ? quelles sont les pages
  accessibles que par nos utilisateurs finaux ?).
- Les fonctions de gestion des animaux (`functions.php`) utilisent des variables
  globales pour accéder à la base de données (à l'aide du mot-clé `global`).
  Ceci rend la séparation des responsabilité difficile. N'importe quelle
  fonction peut modifier la base de données au travers de la variable globale,
  ce qui peut entraîner des bugs difficiles à détecter.
- Il n'est pas facile de savoir ce que représente un animal de compagnie sans
  analyser les fonctions définies dans `functions.php` et la table des animaux
  dans la base de données (`database.php`).
- Les espèces et le sexe des animaux sont définis en dur dans le code, ce qui
  rend difficile la modification de ces valeurs. Par exemple, si vous souhaitez
  ajouter une nouvelle espèce ou un nouveau sexe, vous devez modifier le code
  directement partout où ces valeurs sont utilisées.
- La logique de validation des données est dispersée dans plusieurs fichiers (la
  validation est faite dans `create.php` et `update.php` par exemple, là où ces
  vérifications pourraient être réunies au même endroit), ce qui rend la
  maintenance et l'évolution du code plus difficile.

Pas tous les problèmes seront résolus dans ce mini-projet, mais nous allons nous
concentrer sur les plus importants pour vous permettre de comprendre les
concepts de la POO.

> [!NOTE]
>
> Votre application pourrait ne plus fonctionner avant que vous ayez terminé la
> refactorisation. C'est normal, car nous allons modifier la structure du projet
> et le code.
>
> Il reste important de bien comprendre les problèmes de conception avant de
> commencer à les corriger. Vous pouvez toujours vous référer à la solution du
> mini-projet si besoin.

## Correction des problèmes de conception

Dans les prochaines sections, nous allons maintenant refactoriser le code du
mini-projet pour le rendre plus lisible et maintenable en utilisant les concepts
de la programmation orientée objet (POO).

### Séparation des pages publiques et la logique métier

Nous allons commencer par séparer les pages publiques de la logique métier. Pour
ce faire, nous allons créer un dossier `public` qui contiendra les pages
publiques de l'application. Les fichiers `create.php`, `edit.php`, `delete.php`,
`view.php` et `index.php` seront déplacés dans ce dossier.

Les fichiers `functions.php` et `database.php` seront déplacés dans un dossier
`src` qui contiendra la logique métier de l'application.

Une fois les fichiers déplacés, votre structure de projet devrait ressembler à
ceci :

```text
progserv1/
├── exercices/
│   └── index.php
├── mini-projet/
│   ├── public/
│   │   ├── create.php
│   │   ├── delete.php
│   │   ├── edit.php
│   │   ├── index.php
│   │   └── view.php
│   ├── src/
│   │   ├── database.php
│   │   └── functions.php
│   └── petsmanager.db
├── index.php
└── phpinfo.php
```

### Création de la classe `Pet`

Nous allons maintenant créer une classe `Pet` qui représentera un animal de
compagnie. Cette classe contiendra les propriétés et les méthodes nécessaires
pour gérer les animaux de compagnie.

Créez un fichier `Pet.php` dans le dossier `src`. Par convention, un fichier
contenant une classe en PHP doit être nommé en Pascal case (c'est-à-dire que
chaque mot commence par une majuscule) et doit être suivi de `.php`.

Ajoutez-y le code suivant :

```php
<?php

class Pet {
    private $name;
    private $species;
    private $nickname;
    private $sex;
    private $age;
    private $color;
    private $personalities;
    private $size;
    private $notes;

    public function __construct(
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
        $this->name = $name;
        $this->species = $species;
        $this->nickname = $nickname;
        $this->sex = $sex;
        $this->age = $age;
        $this->color = $color;
        $this->personalities = $personalities;
        $this->size = $size;
        $this->notes = $notes;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSpecies() {
        return $this->species;
    }

    public function setSpecies($species) {
        $this->species = $species;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function getSex() {
        return $this->sex;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getPersonalities() {
        return $this->personalities;
    }

    public function setPersonalities($personalities) {
        $this->personalities = $personalities;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }
    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }
}
```

Cette classe `Pet` contient les propriétés d'un animal de compagnie ainsi que
des méthodes pour accéder et modifier ces propriétés.

Le constructeur de la classe prend en paramètre les différentes propriétés d'un
animal de compagnie et les initialise. Les méthodes `get` et `set` permettent
d'accéder et de modifier les propriétés de l'animal.

Grâce à cette classe, nous pouvons maintenant créer des objets `Pet` qui
représentent des animaux de compagnie. Cela nous permet de garder au même
endroit toutes les informations relatives à un animal.

Nous ajouterons d'autres méthodes dans les prochaines sections.

### Création de la classe `Database`

Nous allons maintenant créer une classe `Database` qui gérera la connexion à la
base de données et la création des différentes tables qui la composent.

Renommez le fichier `database.php` en `Database.php`. Par convention, un fichier
contenant une classe en PHP doit être nommé en Pascal case (c'est-à-dire que
chaque mot commence par une majuscule) et doit être suivi de `.php`.

Modifiez son contenu comme suit :

```php
<?php

class Database {
    const DATABASE_FILE = '../petsmanager.db';

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("sqlite:" . self::DATABASE_FILE);

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

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }

    public function getPdo() {
        return $this->pdo;
    }
}
```

Cette classe `Database` permet de se connecter à la base de données SQLite et
créer la table `pets` si elle n'existe pas encore. Ces deux opérations sont
effectuées dans le constructeur de la classe, ce qui signifie que la connexion à
la base de données et la création de la table seront effectuées automatiquement
lorsque vous instanciez un objet de la classe `Database`.

La méthode `getPdo()` permet d'accéder à l'instance de PDO pour effectuer des
requêtes sur la base de données.

Vous remarquerez peut-être que nous avons utilisé une constante `DATABASE_FILE`
pour stocker le nom du fichier de la base de données. Cela permet de centraliser
la configuration de la base de données et de faciliter les modifications
ultérieures si nécessaire.

Cette base de données sera créé un niveau supérieur du dossier `src`,
c'est-à-dire dans le dossier `mini-projet` grâce au chemin `../petsmanager.db`.
Cela permet de ne pas mélanger les fichiers de l'application avec la base de
données.

### Création de la classe `PetManager`

Nous allons maintenant créer une classe `PetManager` qui gérera les opérations
de création, de modification, de suppression et de récupération des animaux de
compagnie dans la base de données en utilisant les classes `Pet` et `Database`
créées précédemment.

Renommez le fichier `functions.php` en `PetManager.php`. Par convention, un
fichier contenant une classe en PHP doit être nommé en Pascal case (c'est-à-dire
que chaque mot commence par une majuscule) et doit être suivi de `.php`.

Modifiez son contenu comme suit :

```php
<?php
require 'Database.php';
require 'Pet.php';

class PetsManager {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getPets() {
        // On définit la requête SQL pour récupérer tous les animaux
        $sql = "SELECT * FROM pets";

        // On prépare la requête SQL
        $stmt = $this->database->getPdo()->prepare($sql);

        // On exécute la requête SQL
        $stmt->execute();

        // On récupère tous les animaux
        $pets = $stmt->fetchAll();

        // On transforme la chaîne `personalities` en tableau pour chaque animal
        foreach ($pets as &$pet) {
            if (!empty($pet['personalities'])) {
                $pet['personalities'] = explode(',', $pet['personalities']);
            }
        }

        // On retourne tous les animaux
        return $pets;
    }

    public function getPet($id) {
        // On définit la requête SQL pour récupérer un animal
        $sql = "SELECT * FROM pets WHERE id = :id";

        // On prépare la requête SQL
        $stmt = $this->database->getPdo()->prepare($sql);

        // On lie le paramètre
        $stmt->bindValue(':id', $id);

        // On exécute la requête SQL
        $stmt->execute();

        // On récupère le résultat comme tableau associatif
        $pet = $stmt->fetch();

        // On transforme la chaîne `personalities` en tableau si elle existe
        if ($pet && !empty($pet['personalities'])) {
            $pet['personalities'] = explode(',', $pet['personalities']);
        }

        // On retourne l'animal
        return $pet;
    }

    public function addPet($pet) {
        // On transforme le tableau `$personalities` en chaîne de caractères avec `implode`
        $personalitiesAsString = implode(',', $pet->getPersonalities());

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
            :name,
            :species,
            :nickname,
            :sex,
            :age,
            :color,
            :personalities,
            :size,
            :notes
        )";

        // On prépare la requête SQL
        $stmt = $this->database->getPdo()->prepare($sql);

        // On lie les paramètres
        $stmt->bindValue(':name', $pet->getName());
        $stmt->bindValue(':species', $pet->getSpecies());
        $stmt->bindValue(':nickname', $pet->getNickname());
        $stmt->bindValue(':sex', $pet->getSex());
        $stmt->bindValue(':age', $pet->getAge());
        $stmt->bindValue(':color', $pet->getColor());
        $stmt->bindValue(':personalities', $personalitiesAsString);
        $stmt->bindValue(':size', $pet->getSize());
        $stmt->bindValue(':notes', $pet->getNotes());

        // On exécute la requête SQL pour ajouter un animal
        $stmt->execute();

        // On récupère l'identifiant de l'animal ajouté
        $petId = $this->database->getPdo()->lastInsertId();

        // On retourne l'identifiant de l'animal ajouté.
        return $petId;
    }

    public function updatePet($id, $pet) {
        // On transforme le tableau `$personalities` en chaîne de caractères avec `implode`
        $personalitiesAsString = implode(',', $pet->getPersonalities());

        // On définit la requête SQL pour mettre à jour un animal
        $sql = "UPDATE pets SET
            name = :name,
            species = :species,
            nickname = :nickname,
            sex = :sex,
            age = :age,
            color = :color,
            personalities = :personalities,
            size = :size,
            notes = :notes
        WHERE id = :id";

        // On prépare la requête SQL
        $stmt = $this->database->getPdo()->prepare($sql);

        // On lie les paramètres
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $pet->getName());
        $stmt->bindValue(':species', $pet->getSpecies());
        $stmt->bindValue(':nickname', $pet->getNickname());
        $stmt->bindValue(':sex', $pet->getSex());
        $stmt->bindValue(':age', $pet->getAge());
        $stmt->bindValue(':color', $pet->getColor());
        $stmt->bindValue(':personalities', $personalitiesAsString);
        $stmt->bindValue(':size', $pet->getSize());
        $stmt->bindValue(':notes', $pet->getNotes());

        // On exécute la requête SQL pour mettre à jour un animal
        return $stmt->execute();
    }

    public function removePet($id) {
        // On définit la requête SQL pour supprimer un animal
        $sql = "DELETE FROM pets WHERE id = :id";

        // On prépare la requête SQL
        $stmt = $this->database->getPdo()->prepare($sql);

        // On lie le paramètre
        $stmt->bindValue(':id', $id);

        // On exécute la requête SQL pour supprimer un animal
        return $stmt->execute();
    }
}
```

Cette classe `PetsManager` permet de gérer les animaux de compagnie dans la base
de données. Elle utilise la classe `Database` pour se connecter à la base de
données et la classe `Pet` pour représenter les animaux.

Les méthodes suivantes sont définies :

- `getPets()` : récupère tous les animaux de compagnie dans la base de données.
- `getPet($id)` : récupère un animal de compagnie par son identifiant.
- `addPet($pet)` : ajoute un animal de compagnie dans la base de données.
- `updatePet($id, $pet)` : met à jour un animal de compagnie dans la base de
  données.
- `removePet($id)` : supprime un animal de compagnie de la base de données.

Chaque méthode utilise la classe `Database` pour se connecter à la base de
données et exécuter les requêtes SQL nécessaires. Les animaux sont représentés
par des objets de la classe `Pet`, ce qui permet de garder les informations
relatives à un animal au même endroit.

### Utilisation des classes dans les pages publiques

Maintenant que nous avons créé les classes `Pet`, `Database` et `PetsManager`,
nous allons les utiliser dans les pages publiques de l'application pour gérer
les animaux de compagnie.

#### Page `index.php`

Modifiez le fichier `public/index.php` pour utiliser la classe `PetsManager`
comme suit :

```php
<?php
require '../src/PetsManager.php';

// On crée une instance de PetsManager
$petsManager = new PetsManager();

// On récupère tous les animaux de compagnie
$pets = $petsManager->getPets();
?>

<!DOCTYPE html>
<html lang="fr">

<!-- Suite de la page HTML -->
<!-- ... -->
```

En incluant le fichier `PetsManager.php`, nous pouvons maintenant créer une
instance de la classe `PetsManager` grâce au mot-clé `new` et utiliser sa
méthode `getPets()` pour récupérer tous les animaux de compagnie.

Nous pouvons ensuite afficher ces animaux dans la page HTML comme préalablement.

Ouvrez votre navigateur web et accédez à l'adresse suivante :
<http://localhost/progserv1/mini-projet/public/index.php>.

La liste des animaux de compagnie devrait s'afficher correctement.

#### Page `create.php`

Modifiez le fichier `public/create.php` pour utiliser la classe `PetsManager`
comme suit :

```php
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

<!-- Suite de la page HTML -->
<!-- ... -->
```

Dans cette page, nous avons inclus le fichier `PetsManager.php` pour pouvoir
utiliser la classe `PetsManager`. Nous avons ensuite créé une instance de
`PetsManager` pour pouvoir ajouter un animal de compagnie à la base de données.

Comme `PetManager` inclut déjà la classe `Pet`, nous pouvons créer un objet
`Pet` avec les données du formulaire et nous utilisons la méthode `addPet()` de
la classe `PetsManager` pour ajouter l'animal à la base de données et rediriger
l'utilisateur vers la page d'accueil.

Ouvrez votre navigateur web et accédez à l'adresse suivante :
<http://localhost/progserv1/mini-projet/public/create.php>.

La création d'un animal de compagnie devrait s'effectuer correctement.

#### Page `view.php`

Modifiez le fichier `public/view.php` pour utiliser la classe `PetsManager`
comme suit :

```php
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
    }
} else {
    // Si l'ID n'est pas passé dans l'URL, on redirige vers la page d'accueil
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<!-- Suite de la page HTML -->
<!-- ... -->
```

Dans cette page, nous avons inclus le fichier `PetsManager.php` pour pouvoir
utiliser la classe `PetsManager`. Nous avons ensuite créé une instance de
`PetsManager` pour pouvoir récupérer un animal de compagnie à partir de son
identifiant.

Accédez à la visualisation d'un animal de compagnie. Celui-ci devrait s'afficher
correctement.

#### Page `edit.php`

Modifiez le fichier `public/edit.php` pour utiliser la classe `PetsManager`
comme suit :

```php
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

<!-- Suite de la page HTML -->
<!-- ... -->
```

Dans cette page, nous avons inclus le fichier `PetsManager.php` pour pouvoir
utiliser la classe `PetsManager`. Nous avons ensuite créé une instance de
`PetsManager` pour pouvoir récupérer un animal de compagnie à partir de son
identifiant.

Nous avons également géré la soumission du formulaire pour modifier un animal de
compagnie. Nous avons récupéré les données du formulaire, validé les données et
créé un nouvel objet `Pet` avec les données du formulaire ( comme `PetManager`
inclut déjà la classe `Pet`, il n'est pas nécessaire de l'importer à nouveau).
Nous avons ensuite utilisé la méthode `updatePet()` de la classe `PetsManager`
pour mettre à jour l'animal de compagnie dans la base de données et rediriger
l'utilisateur vers la page de l'animal modifié.

Accédez à la modification d'un animal de compagnie. Celui-ci devrait s'afficher
correctement.

#### Page `delete.php`

Modifiez le fichier `public/delete.php` pour utiliser la classe `PetsManager`
comme suit :

```php
<?php
require '../src/PetsManager.php';

$petsManager = new PetsManager();

// On vérifie si l'ID de l'animal est passé dans l'URL
if (isset($_GET["id"])) {
    // On récupère l'ID de l'animal de la superglobale `$_GET`
    $petId = $_GET["id"];

    // On supprime l'animal correspondant à l'ID
    $petsManager->removePet($petId);

    header("Location: index.php");
    exit();
} else {
    // Si l'ID n'est pas passé dans l'URL, on redirige vers la page d'accueil
    header("Location: index.php");
    exit();
}
```

Dans cette page, nous avons inclus le fichier `PetsManager.php` pour pouvoir
utiliser la classe `PetsManager`. Nous avons ensuite créé une instance de
`PetsManager` pour pouvoir supprimer un animal de compagnie à partir de son
identifiant.

Nous avons vérifié si l'ID de l'animal était passé dans l'URL. Si c'est le cas,
nous avons utilisé la méthode `removePet()` de la classe `PetsManager` pour
supprimer l'animal de compagnie de la base de données et rediriger l'utilisateur
vers la page d'accueil.

Accédez à la suppression d'un animal de compagnie. Celui-ci devrait être
supprimé correctement.

#### Vérification des modifications

A la fin de ces modifications, votre structure de projet devrait ressembler à
ceci :

```text
progserv1/
├── exercices/
│   └── index.php
├── mini-projet/
│   ├── public/
│   │   ├── create.php
│   │   ├── delete.php
│   │   ├── edit.php
│   │   ├── index.php
│   │   └── view.php
│   ├── src/
│   │   ├── Database.php
│   │   ├── Pet.php
│   │   └── PetsManager.php
│   └── petsmanager.db
├── index.php
└── phpinfo.php
```

Votre application devrait fonctionner correctement avec les modifications
effectuées. Vous devriez pouvoir créer, modifier, supprimer et visualiser des
animaux de compagnie en utilisant les classes `Pet`, `Database` et
`PetsManager`.

### Centralisation des espèces et du sexe d'un animal

PHP nous met à disposition l'utilisation de constantes publiques dans les
classes pour définir des valeurs qui ne changent pas et qui sont partagées par
tous les objets de la classe.

Nous allons utiliser cette fonctionnalité pour définir les espèces et le sexe
d'un animal de compagnie de telle manière à tout avoir au même endroit. Cela
nous permettra de centraliser ces valeurs et de faciliter la validation des
données par la suite.

Modifiez le fichier `Pet.php` pour ajouter les constantes publiques suivantes :

```php

    const SPECIES = [
        'dog' => 'Chien',
        'cat' => 'Chat',
        'lizard' => 'Lézard',
        'snake' => 'Serpent',
        'bird' => 'Oiseau',
        'rabbit' => 'Lapin',
        'other' => 'Autre'
    ];

    const SEX = [
        'male' => 'Mâle',
        'female' => 'Femelle'
    ];
```

Votre classe `Pet` devrait maintenant ressembler à ceci :

```php
<?php

class Pet {
    const SPECIES = [
        'dog' => 'Chien',
        'cat' => 'Chat',
        'lizard' => 'Lézard',
        'snake' => 'Serpent',
        'bird' => 'Oiseau',
        'rabbit' => 'Lapin',
        'other' => 'Autre'
    ];

    const SEX = [
        'male' => 'Mâle',
        'female' => 'Femelle'
    ];

    private $name;
    private $species;
    private $nickname;
    private $sex;
    private $age;
    private $color;
    private $personalities;
    private $size;
    private $notes;

    public function __construct(
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
        $this->name = $name;
        $this->species = $species;
        $this->nickname = $nickname;
        $this->sex = $sex;
        $this->age = $age;
        $this->color = $color;
        $this->personalities = $personalities;
        $this->size = $size;
        $this->notes = $notes;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSpecies() {
        return $this->species;
    }

    public function setSpecies($species) {
        $this->species = $species;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function getSex() {
        return $this->sex;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getPersonalities() {
        return $this->personalities;
    }

    public function setPersonalities($personalities) {
        $this->personalities = $personalities;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }
    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }
}
```

Cette modification permet de centraliser les espèces et le sexe d'un animal de
compagnie dans la classe `Pet`. Nous avons défini deux constantes publiques :

- `SPECIES` : un tableau associatif contenant les espèces d'animaux de
  compagnie.
- `SEX` : un tableau associatif contenant les sexes des animaux de compagnie.

#### Utilisation des constantes dans la page d'accueil

Nous allons maintenant utiliser ces constantes dans la page d'accueil
`index.php` afin d'améliorer l'affichage des espèces et du sexe des animaux de
compagnie. Ceux-ci seront affichés sous forme de texte lisible plutôt que sous
forme de code (_Lézard_ au lieu de _lizard_ par exemple).

Modifiez le fichier `public/index.php` pour utiliser les constantes de la classe
`Pet` comme suit :

```php
            <?php foreach ($pets as $pet) { ?>
                <tr>
                    <td><?= htmlspecialchars($pet['name']) ?></td>
                    <td><?= Pet::SPECIES[htmlspecialchars($pet['species'])] ?></td>
                    <td><?= Pet::SEX[htmlspecialchars($pet['sex'])] ?></td>
                    <td><?= htmlspecialchars($pet['age']) ?></td>
                    <td>
                        <a href="delete.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Supprimer</button></a>
                        <a href="edit.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Éditer</button></a>
                        <a href="view.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Visualiser</button></a>
                    </td>
                </tr>
            <?php } ?>
```

Vous remarquerez que nous avons utilisé les constantes `Pet::SPECIES` et
`Pet::SEX` pour accéder aux espèces et au sexe des animaux de compagnie. Cela
permet d'afficher les valeurs lisibles plutôt que les codes.

La notation `::` est utilisé pour accéder aux constantes publiques d'une classe
en PHP (cette même notation peut être utilisée avec des méthodes statiques). Il
est suivi du nom de la constante, qui est en majuscules par convention.

Accédez à la page d'accueil de votre application. Les espèces et le sexe des
animaux de compagnie devraient maintenant s'afficher correctement avec les
valeurs lisibles.

> [TIP]
>
> Il est aussi possible d'utiliser les constantes dans les autres pages
> publiques de l'application, comme `create.php`, `edit.php` et `view.php`, pour
> utiliser la même source d'information pour les espèces et le sexe des animaux
> de compagnie. Cela permet de centraliser les valeurs et d'éviter les erreurs
> de saisie.
>
> Ces modifications sont laissées pour le dernier cours, à votre appréciation,
> mais elles amélioreront la cohérence de l'application et faciliteront la
> maintenance du code à long terme : si une nouvelle espèce est ajoutée, il
> suffira de modifier la constante dans la classe `Pet` pour que toutes les
> pages publiques soient mises à jour automatiquement.

### Centralisation de la logique de validation

Nous avons déjà vu que la validation des données est dispersée dans plusieurs
fichiers, notamment dans les pages `create.php` et `edit.php`. Pour améliorer la
lisibilité et la maintenabilité du code, nous allons centraliser la logique de
validation des données dans la classe `Pet`.

#### Ajout de la méthode `validate()` dans la classe `Pet`

Nous allons ajouter une méthode `validate()` dans la classe `Pet` qui permettra
de valider les données d'un animal de compagnie. Cette méthode renverra un
tableau d'erreurs si des erreurs de validation sont détectées, ou un tableau
vide si les données sont valides.

> [TIP]
>
> Il existe d'autres façons de gérer la validation des données, comme
> l'utilisation d'exceptions ou de bibliothèques tierces.
>
> Cependant, pour ce mini-projet, nous allons utiliser une approche simple et
> directe en renvoyant un tableau d'erreurs.

Modifiez le fichier `Pet.php` pour ajouter la méthode `validate()` comme suit :

```php
    public function validate() {
        $errors = [];

        if (empty($this->name)) {
            array_push($errors, "Le nom est obligatoire.");
        }

        if (strlen($this->name) < 2) {
            array_push($errors, "Le nom doit contenir au moins 2 caractères.");
        }

        if (empty($this->species)) {
            array_push($errors, "L'espèce est obligatoire.");
        }

        if (!array_key_exists($this->species, self::SPECIES)) {
            array_push($errors, "L'espèce sélectionnée n'est pas valide.");
        }

        if (empty($this->sex)) {
            array_push($errors, "Le sexe est obligatoire.");
        }

        if (!array_key_exists($this->sex, self::SEX)) {
            array_push($errors, "Le sexe sélectionné n'est pas valide.");
        }

        if (empty($this->age)) {
            array_push($errors, "L'âge est obligatoire.");
        }

        if (!is_numeric($this->age) || $this->age < 0) {
            array_push($errors, "L'âge doit être un nombre entier positif.");
        }

        if (!empty($this->size) && (!is_numeric($this->size) || $this->size < 0)) {
            array_push($errors, "La taille doit être un nombre entier positif.");
        }

        return $errors;
    }
```

En ajoutant cette méthode `validate()`, nous pouvons maintenant valider les
données d'un animal de compagnie en appelant cette méthode sur un objet `Pet`.

#### Utilisation de la méthode `validate()` dans les pages publiques

Nous allons maintenant utiliser la méthode `validate()` dans les pages publiques
pour valider les données des animaux de compagnie avant de les ajouter ou de les
modifier dans la base de données.

Modifiez le fichier `public/create.php` pour utiliser la méthode `validate()`
comme suit :

```php
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
```

Dans cette page, nous avons créé un objet `Pet` avec les données du formulaire
et nous avons appelé la méthode `validate()` sur cet objet pour valider les
données. Si la méthode `validate()` renvoie un tableau vide, cela signifie que
les données sont valides et nous pouvons ajouter l'animal à la base de données.

Si des erreurs sont détectées, elles sont stockées dans le tableau `$errors` et
nous pouvons les afficher dans le formulaire pour informer l'utilisateur des
erreurs de validation.

Modifiez le fichier `public/edit.php` pour utiliser la méthode `validate()`
comme suit :

```php
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
```

Tout comme pour la page `create.php`, nous avons créé un objet `Pet` avec les
données du formulaire et nous avons appelé la méthode `validate()` sur cet objet
pour valider les données. Si la méthode `validate()` renvoie un tableau vide,
cela signifie que les données sont valides et nous pouvons mettre à jour
l'animal de compagnie dans la base de données.

Si des erreurs sont détectées, elles sont stockées dans le tableau `$errors` et
nous pouvons les afficher dans le formulaire pour informer l'utilisateur des
erreurs de validation.

#### Vérification des modifications

Grâce à ces modifications, la logique de validation des données est maintenant
centralisée dans la classe `Pet`. Cela permet de simplifier le code des pages
publiques et de rendre la validation des données plus cohérente et facile à
maintenir.

## Solution

Vous pouvez trouver la solution du mini-projet PHP à l'adresse suivante :
[`solution`](./solution/).

## Conclusion

Grâce aux principales notions de la programmation orientée objet en PHP, nous
avons pu créer une application de gestion d'animaux de compagnie structurée et
maintenable. Nous avons vu comment créer des classes pour représenter les
animaux de compagnie, comment gérer la base de données avec une classe dédiée,
et comment centraliser la logique de validation des données.

Nous avons également vu comment utiliser ces classes dans les pages publiques de
l'application pour gérer les animaux de compagnie.

La programmation orientée objet en PHP nous permet de structurer notre code de
manière modulaire et réutilisable, ce qui facilite la maintenance et l'évolution
de nos applications.

## Aller plus loin

_Ceci est une section optionnelle pour les personnes qui souhaitent aller plus
loin. Vous pouvez la sauter si vous n'avez pas de temps._

- Êtes-vous capable d'utiliser les constantes de la classe `Pet` dans les pages
  publiques pour afficher les espèces et le sexe des animaux de compagnie ?

  - **Astuce** : utilisez une boucle `foreach` pour parcourir les constantes
    `Pet::SPECIES` et `Pet::SEX` et afficher les valeurs lisibles dans les
    formulaires de création et de modification des animaux de compagnie.
  - **Astuce** : pour séparer la clé et la valeur, vous pouvez utiliser la
    notation `as` dans la boucle `foreach`, par exemple :

    ```php
      foreach (Pet::SPECIES as $key => $value) {
          echo "<option value=\"$key\">$value</option>";
      }
    ```
