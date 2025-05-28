# Cours 05 - Base de données et PDO

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
- [Objectifs](#objectifs)
- [Base de données](#base-de-données)
  - [Système de gestion de base de données (SGBD)](#système-de-gestion-de-base-de-données-sgbd)
  - [SQLite](#sqlite)
- [PDO](#pdo)
  - [Connexion à une base de données SQLite](#connexion-à-une-base-de-données-sqlite)
  - [Création d'une table](#création-dune-table)
  - [Insertion de données](#insertion-de-données)
  - [Récupération de données](#récupération-de-données)
  - [Mise à jour de données](#mise-à-jour-de-données)
  - [Suppression de données](#suppression-de-données)
- [Conclusion](#conclusion)
- [Mini-projet](#mini-projet)
- [Exercices](#exercices)

## Objectifs

Dans ce cours, nous allons étudier les bases de données leur intégration avec
PHP grâce à l'extension PDO.

Nous allons aborder les concepts de base des bases de données, ainsi que les
différents types de systèmes de gestion de base de données (SGBD) et leurs
caractéristiques.

Nous allons nous concentrer sur SQLite, un SGBD léger et autonome, qui est
intégré dans de nombreuses applications et langages de programmation.

Nous allons étudier l'extension PDO de PHP, qui fournit une interface abstraite
pour accéder et interagir avec différentes bases de données

De façon plus concise, les personnes qui étudient devraient être capables de :

- Expliquer les concepts de base des bases de données et des systèmes de gestion
  de base de données (SGBD)
- Utiliser l'extension PDO de PHP pour interagir avec une base de données
- Créer une base de données SQLite et des tables avec PDO
- Insérer, mettre à jour, récupérer et supprimer des données dans une base de
  données SQLite avec PDO

## Base de données

Pour rappel, une base de données est un ensemble d'informations organisées de
manière à permettre un accès rapide et efficace à celle-ci.

Les bases de données sont utilisées pour stocker et gérer des données dans de
nombreux domaines, notamment les applications web, les systèmes de gestion de
contenu, les applications de commerce électronique, etc.

Les bases de données sont généralement organisées en tables, qui contiennent des
lignes et des colonnes. Chaque ligne représente un enregistrement unique, tandis
que chaque colonne représente un champ de données. Les tables peuvent être liées
entre elles par des relations, ce qui permet de créer des bases de données plus
complexes et de gérer des données interconnectées.

### Système de gestion de base de données (SGBD)

Un système de gestion de base de données (SGBD) (appelé _"database management
system (DBMS)"_ en anglais) est un logiciel qui permet de créer, gérer et
interroger des bases de données. Il fournit une interface pour interagir avec
les données, ainsi que des outils pour effectuer des opérations telles que la
création de tables, l'insertion de données, la mise à jour de données et la
suppression de données.

Les SGBD sont utilisés pour gérer des bases de données de toutes tailles, allant
des petites bases de données locales aux grandes bases de données distribuées.

Les systèmes de gestion de base de données les plus courants sont, entre autres,
MySQL, PostgreSQL, SQLite et MongoDB.

Chacun de ces SGBD a ses propres caractéristiques et avantages, mais ils
partagent tous des concepts de base communs.

### SQLite

Dans le contexte de ce cours, nous allons utiliser SQLite comme SGBD.

SQLite est un SGBD léger et autonome qui est intégré dans de nombreuses
applications et langages de programmation. Il est particulièrement adapté pour
les applications de petite à moyenne taille, ainsi que pour les applications
mobiles.

SQLite est une base de données locale qui est stockée dans un fichier unique sur
le disque. Cela signifie qu'il n'est pas nécessaire d'installer un serveur de
base de données séparé pour l'utiliser.

SQLite est donc facile à utiliser et ne nécessite pas de configuration complexe,
ce qui en fait un excellent choix pour les développeurs qui souhaitent créer
rapidement des applications avec une base de données.

## PDO

PDO (PHP Data Objects) est une extension de PHP qui fournit une interface
abstraite pour accéder à différentes bases de données. Il permet aux
développeurs de travailler avec plusieurs SGBD sans avoir à se soucier des
différences entre eux. PDO prend en charge de nombreux SGBD, notamment MySQL,
PostgreSQL, SQLite et d'autres.

PDO facilite ainsi la gestion des connexions, des requêtes et des transactions
qui pourraient être faites à une base de données. Il prend également en charge
les requêtes préparées, ce qui permet de protéger contre les attaques par
injection SQL et d'améliorer les performances des requêtes.

### Connexion à une base de données SQLite

Pour se connecter à une base de données SQLite avec PDO, il suffit de créer une
instance de la classe `PDO` en spécifiant le chemin du fichier de base de
données. Voici un exemple de code :

```php
<?php
// Chemin vers le fichier de base de données SQLite
const DATABASE_FILE = 'path/to/database.db';

// Création d'une instance de PDO pour se connecter à la base de données
$pdo = new PDO("sqlite:" . DATABASE_FILE);
```

Dans cet exemple, nous créons une instance de `PDO` en spécifiant le chemin vers
le fichier de base de données SQLite.

Ceci crée une connexion à la base de données. Si le fichier de base de données
n'existe pas, SQLite le créera automatiquement.

Nous n'avons pas encore étudié en détail la programmation orientée objet (POO)
en PHP. Pour le moment, il est juste nécessaire de retenir que PDO est une
classe qui permet de se connecter à une base de données et d'exécuter des
requêtes SQL sur celle-ci. Nous étudierons la POO en détail dans un prochain
cours.

### Création d'une table

Pour créer une table dans une base de données SQLite avec PDO, nous utilisons la
méthode `exec()` de l'objet `PDO`. Voici un exemple de code :

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

Dans cet exemple, nous créons une table `users` avec trois colonnes : `id`,
`name` et `email`.

La colonne `id` est une clé primaire qui s'incrémente automatiquement, tandis
que les colonnes `name` et `email` sont des champs de texte qui ne peuvent pas
être nuls.

La colonne `email` est également définie comme unique, ce qui signifie qu'aucun
deux utilisateurs ne peuvent avoir la même adresse e-mail.

Nous utilisons la méthode `exec()` pour exécuter la requête SQL de création de
table. Cette méthode retourne le nombre de lignes affectées par la requête, mais
elle ne retourne pas de résultats.

### Insertion de données

Pour insérer des données dans une table, nous utilisons la méthode `exec()` de
l'objet `PDO`. Voici un exemple de code :

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

Dans cet exemple, nous insérons deux nouveaux utilisateurs dans la table
`users`.

Nous utilisons la méthode `exec()` pour exécuter la requête SQL d'insertion.
Cette méthode ne retourne pas de résultats.

Cette façon de faire implique des risques de sécurité, notamment les attaques
par injection SQL. Nous verrons comment utiliser des requêtes préparées pour
protéger notre application contre ces attaques dans un prochain cours.

Il est possible de récupérer l'identifiant de l'utilisateur inséré en utilisant
la méthode `lastInsertId()` de l'objet `PDO`. Voici un exemple de code :

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

// On récupère l'identifiant de l'utilisateur inséré
$janeDoeId = $pdo->lastInsertId();

// On affiche l'identifiant de l'utilisateur inséré
echo "L'identifiant de l'utilisateur inséré est : $janeDoeId<br>";
```

Cette méthode retourne l'identifiant de la dernière ligne insérée dans la table.
Cela peut être utile si vous souhaitez effectuer d'autres opérations sur
l'utilisateur inséré, comme l'ajout d'informations supplémentaires ou la
création de relations avec d'autres tables.

### Récupération de données

Pour récupérer des données d'une table, nous utilisons la méthode `query()` de
l'objet `PDO`. Voici un exemple de code :

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

Dans cet exemple, nous récupérons un utilisateur spécifique de la table `users`
en fonction de son identifiant.

Nous exécutons la requête SQL avec la méthode `query()`.

Ensuite, nous utilisons la méthode `fetchAll()` pour récupérer tous le résultat
de la requête sous forme de tableau associatif.

La différence entre `exec()` et `query()` est que `exec()` est utilisée pour les
requêtes qui ne retournent pas de résultats (comme les requêtes d'insertion ou
de suppression), tandis que `query()` est utilisée pour les requêtes qui
retournent des résultats (comme les requêtes de sélection).

Afin de récupérer toutes les lignes d'une table, nous pouvons utiliser la
méthode `fetchAll()`.

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

Dans cet exemple, nous récupérons tous les utilisateurs de la table `users`.

Nous exécutons la requête SQL avec la méthode `query()`.

Ensuite, nous utilisons la méthode `fetchAll()` pour récupérer tous les
résultats de la requête sous forme d'un tableau associatif multidimensionnel
contenant tous les utilisateurs.

### Mise à jour de données

Pour mettre à jour des données dans une table, nous utilisons la méthode
`exec()` de l'objet `PDO`. Voici un exemple de code :

```php
// On définit la requête SQL pour mettre à jour l'utilisateur `Jane Doe`
$sql = "UPDATE users SET
    name = 'Jane Smith',
    email = 'jane.smith@heig-vd.ch'
WHERE id = '$janeDoeId'";

// On exécute la requête SQL pour mettre à jour l'utilisateur
$pdo->exec($sql);

// On récupère l'utilisateur mis à jour
$sql = "SELECT * FROM users WHERE id = '$janeDoeId'";
$user = $pdo->query($sql);
$user = $user->fetch();

// On affiche l'utilisateur mis à jour
print_r($user);
```

Dans cet exemple, nous mettons à jour le nom de l'utilisateur `Jane Doe` en
`Jane Smith` ainsi que son adresse e-mail.

Nous utilisons la méthode `exec()` pour exécuter la requête SQL de mise à jour.

Cette méthode ne retourne pas de résultats. Nous utilisons la clause `WHERE`
pour spécifier quel utilisateur nous souhaitons mettre à jour. Si nous ne
spécifions pas de clause `WHERE`, tous les utilisateurs de la table seront mis à
jour.

### Suppression de données

Pour supprimer des données d'une table, nous utilisons la méthode `exec()` de
l'objet `PDO`. Voici un exemple de code :

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

Dans cet exemple, nous supprimons l'utilisateur `Jane Smith` de la table
`users`. Nous utilisons la méthode `exec()` pour exécuter la requête SQL de
suppression. Cette méthode ne retourne pas de résultats. Nous utilisons la
clause `WHERE` pour spécifier quel utilisateur nous souhaitons supprimer.

## Conclusion

Dans ce cours, nous avons étudié les bases de données et leur intégration avec
PHP grâce à l'extension PDO.

Nous avons vu les concepts de base des bases de données, ainsi que les
différents types de systèmes de gestion de base de données (SGBD) et leurs
caractéristiques.

Nous avons étudié SQLite, un SGBD léger et autonome, qui est intégré de base
dans PHP.

Nous avons également étudié l'extension PDO de PHP, qui fournit une interface
abstraite pour accéder et interagir avec différentes bases de données. Nous
avons vu comment se connecter à une base de données SQLite avec PDO, créer une
table, insérer des données, récupérer des données, mettre à jour des données et
supprimer des données.

Dans un prochain cours, nous étudierons les requêtes préparées et comment
protéger notre application contre les attaques par injection SQL. Nous avons
également vu comment utiliser des transactions pour garantir l'intégrité des
données dans une base de données.

## Mini-projet

Nous vous invitons maintenant à réaliser le mini-projet de cette session pour
mettre en pratique les concepts vus en classe.

Vous trouverez les détails du mini-projet ici :
[Consignes](../02-mini-project/README.md).

## Exercices

Nous vous invitons également à réaliser les exercices de cette session pour
renforcer votre compréhension des concepts vus en classe.

Vous trouverez les détails des exercices ici :
[Énoncés et solutions](../03-exercices/README.md).
