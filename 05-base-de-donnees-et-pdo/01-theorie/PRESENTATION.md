---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: L. Delafontaine, avec l'aide de GitHub Copilot
title: HEIG-VD ProgServ1 Course - Cours 05 - Base de données et PDO
description: Cours 05 - Base de données et PDO pour le cours ProgServ1 à la HEIG-VD, Suisse
url: https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/05-base-de-donnees-et-pdo/01-theorie/index.html
header: "**Cours 05 - Base de données et PDO**"
footer: "**HEIG-VD** - ProgServ1 Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
math: mathjax
-->

# Cours 05 - Base de données et PDO

<!--
_class: lead
_paginate: false
-->

<https://github.com/heig-vd-progserv1-course>

[Support de cours][course-material] · [Présentation (web)][presentation-web] ·
[Présentation (PDF)][presentation-pdf]

<small>L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).</small>

<small>Ce travail est sous licence [CC BY-SA 4.0][license].</small>

![bg brightness:2 opacity:0.2][illustration-principale]

## _Retrouvez plus de détails dans le support de cours_

<!-- _class: lead -->

_Cette présentation est un résumé du support de cours. Pour plus de détails,
consultez le [support de cours][course-material]._

## Objectifs (1/2)

- Expliquer les concepts de base des bases de données et des systèmes de gestion
  de base de données (SGBD)
- Utiliser l'extension PDO de PHP pour interagir avec une base de données
- Créer une base de données SQLite et des tables avec PDO

![bg right:40%][illustration-objectifs]

## Objectifs (2/2)

- Insérer, mettre à jour, récupérer et supprimer des données dans une base de
  données SQLite avec PDO

![bg right:40%][illustration-objectifs]

## Base de données

- Ensemble d'informations organisées de manière à permettre un accès rapide et
  efficace à ces informations
- Généralement organisées en tables, qui contiennent des lignes et des colonnes
  :
  - Lignes : enregistrements uniques
  - Colonnes : champs de données

![bg right:40%][illustration-base-de-donnees]

### Système de gestion de base de données (SGBD)

- Logiciel permettant de créer, gérer et interroger des bases de données
- Fournit une interface pour interagir avec les données (création, insertion,
  mise à jour, suppression)
- Chacun avec ces caractéristiques mais avec les mêmes concepts de base

![bg right:40%][illustration-systeme-de-gestion-de-base-de-donnees]

### SQLite

- SGBD léger et intégré
- Pas besoin d'installation ou de configuration complexe
- Stocke les données dans un fichier unique
- Prise en charge de SQL standard
- Idéal pour les applications de petite à moyenne taille

![bg right:40% w:80%](https://www.sqlite.org/images/sqlite370_banner.svg)

## PDO

- PHP Data Objects (PDO) est une extension de PHP qui fournit une interface
  orientée objet pour accéder à des bases de données
- Permet d'interagir avec différentes bases de données (MySQL, PostgreSQL,
  SQLite, etc.)
- Fournit une API cohérente pour effectuer des opérations sur des base de
  données

![bg right:40%][illustration-systeme-de-gestion-de-base-de-donnees]

### Connexion à une base de données SQLite

```php
<?php
// Chemin vers le fichier de base de données SQLite
const DATABASE_FILE = 'path/to/database.db';

// Création d'une instance de PDO pour se connecter à la base de données
$pdo = new PDO("sqlite:" . DATABASE_FILE);
```

### Création d'une table

```php
// Création d'une table `users`
$sql = 'CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE
)';

// On exécute la requête SQL pour créer la table
$pdo->exec($sql);
```

### Insertion de données

```php
// On définit la requête SQL pour ajouter un utilisateur
$sql = "INSERT INTO users (
    name,
    email
) VALUES (
    'John Doe',
    'john.doe@heig-vd.ch'
)";

// On exécute la requête SQL pour ajouter l'utilisateur
$pdo->exec($sql);
```

---

```php
// On définit la requête SQL pour ajouter un utilisateur
$sql = "INSERT INTO users (
    name,
    email
) VALUES (
    'Jane Doe',
    'jane.doe@heig-vd.ch'
)";

// On exécute la requête SQL pour ajouter l'utilisateur
$pdo->exec($sql);
```

---

```php
// On récupère l'identifiant de l'utilisateur inséré
$janeDoeId = $pdo->lastInsertId();

// On affiche l'identifiant de l'utilisateur inséré
echo "L'identifiant de l'utilisateur inséré est : $janeDoeId<br>";
```

### Récupération de données

```php
// On définit la requête SQL pour récupérer l'utilisateur `Jane Doe`
$sql = "SELECT * FROM users WHERE id = '$janeDoeId'";

// On récupère l'utilisateur spécifique
$user = $pdo->query($sql);

// On transforme le résultat en tableau associatif
$user = $user->fetch();

// On affiche l'utilisateur
print_r($user);
```

---

```php
// On définit la requête SQL pour récupérer tous les utilisateurs
$sql = "SELECT * FROM users";

// On récupère tous les utilisateurs
$users = $pdo->query($sql);

// On transforme le résultat en tableau associatif
$users = $users->fetchAll();

// On affiche les utilisateurs
print_r($users);
```

### Mise à jour de données

```php
// On définit la requête SQL pour mettre à jour l'utilisateur `Jane Doe`
$sql = "UPDATE users SET
    name = 'Jane Smith',
    email = 'jane.smith@heig-vd.ch'
WHERE id = '$janeDoeId'";

// On exécute la requête SQL pour mettre à jour l'utilisateur
$pdo->exec($sql);
```

---

```php
// On récupère l'utilisateur mis à jour
$sql = "SELECT * FROM users WHERE id = '$janeDoeId'";
$user = $pdo->query($sql);
$user = $user->fetch();

// On affiche l'utilisateur mis à jour
print_r($user);
```

### Suppression de données

```php
// On définit la requête SQL pour supprimer l'utilisateur
$sql = "DELETE FROM users WHERE id = '$janeDoeId'";

// On exécute la requête SQL pour supprimer l'utilisateur
$pdo->exec($sql);

// On récupère tous les utilisateurs
$sql = "SELECT * FROM users";
$users = $pdo->query($sql);
$users = $users->fetchAll();

// On affiche les utilisateurs restants
print_r($users);
```

## Conclusion

- Les bases de données permettent de stocker et de gérer des données
- SQLite est un système de gestion de base de données (SGBD)
- PDO est une extension PHP qui permet d'interagir avec SGBDs
- Les opérations de base incluent la création, l'insertion, la mise à jour et la
  suppression de données

![bg right:40%][illustration-principale]

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- (Re)lire le [support de cours][course-material].
- Réaliser le [mini-projet][mini-project].
- Faire les [exercices][exercices].
- Poser des questions si nécessaire.

\
**Pour le mini-projet ou les exercices, n'hésitez pas à vous entraidez si vous avez
des difficultés !**

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration principale][illustration-principale] par
  [Richard Jacobs](https://unsplash.com/@rj2747) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-elephants-drinking-water-8oenpCXktqQ)
- [Illustration][illustration-objectifs] par
  [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  [Unsplash](https://unsplash.com/photos/j6brni7fpvs)
- [Illustration][illustration-base-de-donnees] par
  [Jan Antonin Kolar](https://unsplash.com/@jankolar) sur
  [Unsplash](https://unsplash.com/photos/brown-wooden-drawer-lRoX0shwjUQ)
- [Illustration][illustration-systeme-de-gestion-de-base-de-donnees] par
  [israel palacio](https://unsplash.com/@othentikisra) sur
  [Unsplash](https://unsplash.com/photos/two-square-blue-led-lights-ImcUkZ72oUs)
- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

<!-- URLs -->

[presentation-web]:
	https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/05-base-de-donnees-et-pdo/01-theorie/index.html
[presentation-pdf]:
	https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/05-base-de-donnees-et-pdo/01-theorie/05-base-de-donnees-et-pdo-presentation.pdf
[course-material]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/05-base-de-donnees-et-pdo/01-theorie/README.md
[license]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/LICENSE.md
[mini-project]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/05-base-de-donnees-et-pdo/02-mini-project/README.md
[exercices]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/05-base-de-donnees-et-pdo/03-exercices/README.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-base-de-donnees]:
	https://images.unsplash.com/photo-1544383835-bda2bc66a55d?fit=crop&h=720
[illustration-systeme-de-gestion-de-base-de-donnees]:
	https://images.unsplash.com/photo-1534224039826-c7a0eda0e6b3?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
