# Cours 02 - Fonctions - Mini-projet

Ce mini-projet est conçu pour vous permettre de mettre en pratique les concepts
théoriques vus dans le cours _[Cours 02 - Fonctions](../01-theorie/README.md)_.

## Ressources

- Théorie : [Support de cours](../01-theorie/README.md) ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/02-fonctions/01-theorie/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/02-fonctions/01-theorie/02-fonctions-presentation.pdf)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Exercices : [Énoncés et solutions](../03-exercices/README.md)

## Tables des matières

- [Ressources](#ressources)
- [Tables des matières](#tables-des-matières)
- [Objectifs de la session](#objectifs-de-la-session)
- [Création du ficher `functions.php`](#création-du-ficher-functionsphp)
- [Importer et utiliser les fonctions dans le fichier `index.php`](#importer-et-utiliser-les-fonctions-dans-le-fichier-indexphp)
- [Créer les pages de base pour gérer les animaux de compagnie](#créer-les-pages-de-base-pour-gérer-les-animaux-de-compagnie)
  - [Créer une page pour ajouter un animal de compagnie](#créer-une-page-pour-ajouter-un-animal-de-compagnie)
  - [Créer une page pour visualiser un animal de compagnie](#créer-une-page-pour-visualiser-un-animal-de-compagnie)
  - [Créer une page pour modifier un animal de compagnie](#créer-une-page-pour-modifier-un-animal-de-compagnie)
  - [Mettre à jour la page d'accueil](#mettre-à-jour-la-page-daccueil)
- [Valider la structure de votre projet](#valider-la-structure-de-votre-projet)
- [Solution](#solution)
- [Conclusion](#conclusion)
- [Aller plus loin](#aller-plus-loin)

## Objectifs de la session

À l'issue de cette session, les personnes qui étudient devraient avoir pu :

- Mettre en place une structure de projet PHP
- Créer des fonctions PHP pour visualiser, ajouter, modifier et supprimer des
  animaux de compagnie de façon fictive
- Créer les pages HTML de base pour gérer les animaux de compagnie

## Création du ficher `functions.php`

Afin de séparer les fonctions de notre projet, nous allons créer un fichier
`functions.php` qui contiendra toutes les fonctions nécessaires pour notre
mini-projet.

Pour le moment, ce fichier contiendra différentes fonctions pour manipuler des
animaux de compagnie de façon fictive. Ces fonctions ne seront donc pas
fonctionnelles et seront à compléter dans de futurs sessions mais permettront
d'illustrer comment séparer les fonctions de notre projet.

Créez un fichier `functions.php` dans le dossier `mini-projet`.

Votre structure de projet devrait ressembler à ceci :

```text
progserv1/
├── exercices/
│   └── index.php
├── mini-projet/
│   ├── functions.php
│   └── index.php
├── index.php
└── phpinfo.php
```

Complétez le fichier `functions.php` avec les fonctions suivantes :

```php
<?php
function getPets() {
    echo "Getting pets.<br>";
}

function getPet($name) {
    echo "Getting pet with name '$name'.<br>";
}

function addPet($name, $age) {
    echo "Adding $name, who is $age years old.<br>";
}

function updatePet($name, $age) {
    echo "Updating pet with name '$name' to be $age years old.<br>";
}

function removePet($name) {
    echo "Removing pet with name '$name'.<br>";
}
```

Prenez le temps de comprendre ce que font ces fonctions. Pour le moment, toutes
ces fonctions sont fictives et ne font que afficher des actions que nous
implémenterons dans de futurs sessions.

## Importer et utiliser les fonctions dans le fichier `index.php`

Dans le fichier `index.php`, remplacez le contenu pour importer le fichier
`functions.php`. Cela vous permettra d'y utiliser les fonctions que vous avez
créées dans le fichier `functions.php`.

```php
<?php
require 'functions.php';
```

Ajoutez ensuite des appels aux fonctions pour manipuler des animaux de compagnie
de façon fictive. Vous pourriez, par exemple :

1. Créer un chat nommé _Caramel_, âgé de 3 ans
2. Créer un chien nommé _Rex_, âgé de 8 ans
3. Créer un oiseau nommé _Tweety_, âgé de 1 an
4. Créer un lézard nommé _Godzilla_, âgé de 4 ans
5. Récupérer tous les animaux
6. Récupérer l'animal nommé _Rex_
7. Mettre à jour l'âge de _Rex_ à 9 ans
8. Supprimer _Tweety_ (désolé Tweety)

Essayez de le faire sans regarder la solution !

<details>
<summary>Afficher la solution</summary>

```php
// Crée Caramel, un chat de 3 ans
addPet("Caramel", 3);

// Crée Rex, un chien de 8 ans
addPet("Rex", 8);

// Crée Tweety, un oiseau de 1 an
addPet("Tweety", 1);

// Crée Godzilla, un lézard de 4 ans
addPet("Godzilla", 4);

// Récupère tous les animaux
getPets();

// Récupère l'animal nommé Rex
getPet("Rex");

// Met à jour l'âge de Rex à 9 ans
updatePet("Rex", 9);

// Supprime Tweety... :(
removePet("Tweety");
```

</details>

Votre fichier `index.php` devrait ressembler à ceci :

```php
<?php
require 'functions.php';

// Crée Caramel, un chat de 3 ans
addPet("Caramel", 3);

// Crée Rex, un chien de 8 ans
addPet("Rex", 8);

// Crée Tweety, un oiseau de 1 an
addPet("Tweety", 1);

// Crée Godzilla, un lézard de 4 ans
addPet("Godzilla", 4);

// Récupère tous les animaux
getPets();

// Récupère l'animal nommé Rex
getPet("Rex");

// Met à jour l'âge de Rex à 9 ans
updatePet("Rex", 9);

// Supprime Tweety... :(
removePet("Tweety");
```

Ouvrez votre navigateur et allez à l'adresse
<http://localhost/progserv1/mini-projet/index.php>.

Vous devriez voir les messages suivants :

```text
Adding Caramel, who is 3 years old.
Adding Rex, who is 8 years old.
Adding Tweety, who is 1 years old.
Adding Godzilla, who is 4 years old.
Getting pets.
Getting pet with name 'Rex'.
Updating pet with name 'Rex' to be 9 years old.
Removing pet with name 'Tweety'.
```

## Créer les pages de base pour gérer les animaux de compagnie

Maintenant que vous avez créé des fonctions pour manipuler des animaux de
compagnie de façon fictive, vous pouvez créer des pages pour gérer ces animaux.

Pour le moment, ces pages ne seront que des squelettes pour les futures
implémentations.

### Créer une page pour ajouter un animal de compagnie

Créez un fichier `create.php` dans le dossier `mini-projet`. Cette page
permettra d'ajouter un nouvel animal de compagnie.

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
</body>

</html>
```

Validez que la page `create.php` s'affiche correctement dans votre navigateur en
allant à l'adresse <http://localhost/progserv1/mini-projet/create.php>.

### Créer une page pour visualiser un animal de compagnie

Créez un fichier `view.php` dans le dossier `mini-projet`. Cette page permettra
de visualiser un animal de compagnie.

```php
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Visualise un animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Visualise un animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour visualiser un animal de compagnie.</p>
</body>

</html>
```

Validez que la page `view.php` s'affiche correctement dans votre navigateur en
allant à l'adresse <http://localhost/progserv1/mini-projet/view.php>.

### Créer une page pour modifier un animal de compagnie

Créez un fichier `update.php` dans le dossier `mini-projet`. Cette page permettra
de visualiser un animal de compagnie.

```php
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Modifie un animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Modifie un animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour modifier un animal de compagnie.</p>
</body>

</html>
```

Validez que la page `update.php` s'affiche correctement dans votre navigateur en
allant à l'adresse <http://localhost/progserv1/mini-projet/update.php>.

### Mettre à jour la page d'accueil

Modifiez la page d'accueil `index.php` pour y ajouter du contenu HTML pour
visualiser tous les animaux de compagnie. Le contenu de cette page devrait
ressembler à ceci :

```php
<?php
require 'functions.php';

// Crée Caramel, un chat de 3 ans
addPet("Caramel", 3);

// Crée Rex, un chien de 8 ans
addPet("Rex", 8);

// Crée Tweety, un oiseau de 1 an
addPet("Tweety", 1);

// Crée Godzilla, un lézard de 4 ans
addPet("Godzilla", 4);

// Récupère tous les animaux
getPets();

// Récupère l'animal nommé Rex
getPet("Rex");

// Met à jour l'âge de Rex à 9 ans
updatePet("Rex", 9);

// Supprime Tweety... :(
removePet("Tweety");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page d'accueil | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Page d'accueil du gestionnaire d'animaux de compagnie</h1>
    <p>Bienvenue sur la page d'accueil du gestionnaire d'animaux de compagnie !</p>
    <p>Utilise cette page pour visualiser et gérer tous les animaux de compagnie.</p>
</body>

</html>
```

Validez que la page `index.php` s'affiche correctement dans votre navigateur en
allant à l'adresse <http://localhost/progserv1/mini-projet/index.php>.

Pour le moment, cette page est un mélange entre du code PHP brut pour valider le
fonctionnement des fonctions et du HTML pour afficher le contenu de la page.
Dans les prochaines sessions, nous verrons comment utiliser les fonctions pour
manipuler des animaux de compagnie de façon plus réaliste.

## Valider la structure de votre projet

A la fin de cette session, votre structure de projet devrait ressembler à ceci :

```text
progserv1/
├── exercices/
│   └── index.php
├── mini-projet/
│   ├── create.php
│   ├── functions.php
│   ├── index.php
│   └── view.php
├── index.php
└── phpinfo.php
```

## Solution

Vous pouvez trouver la solution du mini-projet PHP à l'adresse suivante :
[`solution`](./solution/).

## Conclusion

Dans cette seconde session, vous avez appris à créer des fonctions en PHP pour
manipuler des animaux de compagnie de façon fictive.

Ces fonctions, dans un fichier `functions.php` séparé, ont été importées et
utilisées dans un fichier `index.php` afin de garder une structure de projet
propre. Cela nous permettra de réutiliser ces fonctions dans d'autres parties de
notre projet.

Dans la prochaine session, nous verrons comment utiliser ces fonctions pour
manipuler les animaux de compagnie de façon plus réaliste à l'aide de tableaux.

## Aller plus loin

_Ceci est une section optionnelle pour les personnes qui souhaitent aller plus
loin. Vous pouvez la sauter si vous n'avez pas de temps._

- Comment pourriez-vous modifier les fonctions pour qu'elles retournent des
  valeurs plutôt que d'afficher des messages ?
- Comment pourriez-vous modifier les fonctions pour qu'elles utilisent des
  paramètres par défaut pour l'âge des animaux ?
