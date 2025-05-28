# Cours 06 - Sécurité et nettoyage des saisies utilisateurs - Mini-projet

Ce mini-projet est conçu pour vous permettre de mettre en pratique les concepts
théoriques vus dans le cours
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
- [Objectifs de la session](#objectifs-de-la-session)
- [Sauvegarder une copie de la base données](#sauvegarder-une-copie-de-la-base-données)
- [Réaliser une injection SQL](#réaliser-une-injection-sql)
  - [Étape 1 : identifier une vulnérabilité](#étape-1--identifier-une-vulnérabilité)
  - [Étape 2 : former la requête SQL](#étape-2--former-la-requête-sql)
  - [Étape 3 : réaliser l'injection SQL](#étape-3--réaliser-linjection-sql)
  - [Étape 4 : corriger la vulnérabilité](#étape-4--corriger-la-vulnérabilité)
  - [Étape 5 : tester l'application](#étape-5--tester-lapplication)
- [Réaliser une attaque XSS](#réaliser-une-attaque-xss)
  - [Étape 1 : identifier une vulnérabilité](#étape-1--identifier-une-vulnérabilité-1)
  - [Étape 2 : réaliser l'attaque XSS](#étape-2--réaliser-lattaque-xss)
  - [Étape 3 : corriger la vulnérabilité](#étape-3--corriger-la-vulnérabilité)
  - [Étape 4 : tester l'application](#étape-4--tester-lapplication)
- [Ajout de la possibilité de mettre à jour un animal](#ajout-de-la-possibilité-de-mettre-à-jour-un-animal)
  - [Ajout du fichier `edit.php`](#ajout-du-fichier-editphp)
  - [Mise à jour de la fonction `updatePet()`](#mise-à-jour-de-la-fonction-updatepet)
  - [Mise à jour du fichier `view.php`](#mise-à-jour-du-fichier-viewphp)
  - [Mise à jour du fichier `index.php`](#mise-à-jour-du-fichier-indexphp)
  - [Tests de l'application](#tests-de-lapplication)
- [Solution](#solution)
- [Conclusion](#conclusion)
- [Aller plus loin](#aller-plus-loin)

## Objectifs de la session

Vous avez maintenant une petite application PHP fonctionnelle qui vous permet de
stocker et de gérer des animaux de compagnie.

Cependant, cette application n'est pas sécurisée et présente plusieurs
vulnérabilités qui la rendent facilement attaquable. Cela met en danger les
données de l'application et la sécurité des utilisateurs.

L'objectif de cette session est de vous familiariser avec les attaques les plus
courantes sur le web et de vous montrer comment les réaliser sur une application
PHP et, surtout, comment les corriger.

De façon plus concise, les personnes qui étudient devraient avoir pu :

- Réaliser une injection SQL sur une application PHP
- Réaliser une attaque XSS sur une application PHP
- Corriger les vulnérabilités de l'application PHP

## Sauvegarder une copie de la base données

Avant de commencer, il est recommandé de sauvegarder la base de données de
l'application PHP que vous avez développée dans le mini-projet précédent. Cela
vous permettra de revenir à une version fonctionnelle de l'application car
celle-ci sera modifiée lors de la réalisation des attaques.

Pour sauvegarder la base de données, copiez simplement le fichier
`petsmanager.db` sous un autre nom, par exemple `petsmanager_backup.db`.

Conservez cette copie et restaurez-la autant que nécessaire pour revenir à une
version fonctionnelle de l'application si besoin.

Pour restaurer la base de données, il suffit supprimer la base de données
existante (`petsmanager.db`) puis de copier le fichier `petsmanager_backup.db`
et de le renommer en `petsmanager.db`.

Cela restaurera la version sauvegardée.

## Réaliser une injection SQL

Dans cette section, vous allez réaliser une injection SQL sur l'application PHP
que vous avez développée dans le mini-projet précédent.

Puis, vous allez corriger toutes les vulnérabilités d'injections SQL pour
sécuriser votre application.

### Étape 1 : identifier une vulnérabilité

L'application PHP que vous avez développée dans le mini-projet précédent est
vulnérable aux injections SQL. En effet, il y a plusieurs endroits dans le code
où des données non filtrées sont insérées directement dans une requête SQL.

Par exemple, lorsque vous ajoutez un animal de compagnie par exemple, les
propriétés de l'animal (nom, espèce, etc.) sont directement insérées dans la
requête SQL sans aucun filtrage ni échappement :

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
        '$age',
        '$color',
        '$personalitiesAsString',
        '$size',
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

Cela signifie qu'un attaquant peut facilement injecter du code SQL malveillant
dans une ou l'autre des propriétés de l'animal.

### Étape 2 : former la requête SQL

Pour réaliser l'injection SQL, vous devez d'abord former la requête SQL que vous
allez injecter dans l'application.

Dans cet exemple, nous allons réaliser une injection SQL qui va supprimer la
base de données entière de l'application.

Pour cela, vous devez former la requête SQL suivante par un moyen ou un autre :

```sql
DROP TABLE pets;
```

Cette requête a pour but de supprimer la table `pets` de la base de données, ce
qui entraînera la perte de toutes les données de l'application.

À cette fin, vous pouvez utiliser les notes de l'animal pour injecter la requête
SQL.

Nous pouvons donc déduire que le texte que nous allons entrer dans le champ
`notes` de l'application sera le suivant :

```sql
'); DROP TABLE pets; --'
```

Ce qui donnera la requête SQL suivante :

```sql
INSERT INTO pets (name, species, nickname, sex, age, color, personalities, size, notes
) VALUES ('Fluffy', 'dog', 'Fluff', 'male', 3, '#ff0000', 'gentil,curious', 10, ''); DROP TABLE pets; --');
```

Cette requête, construite grâce à votre injection SQL, va réaliser en réalité
deux requêtes SQL :

1. Insérer un animal de compagnie avec le nom `Fluffy`
2. Supprimer la table `pets` de la base de données.

La première partie de la requête est la même que celle que vous avez utilisée
pour ajouter un animal de compagnie dans l'application. La seconde partie de la
requête est la requête SQL que vous avez formée à l'étape précédente.

La partie `--` à la fin de la requête est un commentaire SQL qui peut permettre
d'ignorer le reste de la requête. Cela permet d'éviter les erreurs de syntaxe
dans la requête SQL (ce n'est pas toujours nécessaire, cela peut éviter
certaines erreurs).

### Étape 3 : réaliser l'injection SQL

Maintenant que vous avez identifié le champ et la valeur nécessaire pour
celui-ci, vous pouvez réaliser l'injection SQL.

Insérez simplement un animal de compagnie dans l'application avec la requête SQL
que vous avez formée à la section précédente :

- Nom : `Fluffy`
- Espèce : `Chien`
- Surnom : `Fluff`
- Sexe : `Mâle`
- Âge : `3`
- Couleur : `#ff0000`
- Personnalité : `gentil,curious`
- Taille : `10`
- Notes : `'); DROP TABLE pets; --`

Il se peut qu'une erreur s'affiche lorsque vous essayez d'insérer l'animal de
compagnie. Cela n'est pas grave, l'injection SQL devrait déjà avoir été réalisée
et la requête SQL exécutée.

L'action d'insertion de l'animal dans la base de données exécutera la requête
SQL que vous avez formée, ce qui devrait entraîner la suppression de la table
`pets` de la base de données.

Après avoir inséré Fluffy, vous pouvez vérifier que la table a bien été
supprimée en visualisant la base de données dans Visual Studio Code.

L'injection SQL a bien fonctionné et la table `pets` a été supprimée de la base
de données avec succès !

Après avoir tout cassé (😈), vous pouvez restaurer la base de données à l'aide
de la copie de sauvegarde que vous avez faite à l'étape précédente et vous allez
corriger la vulnérabilité.

### Étape 4 : corriger la vulnérabilité

Pour corriger la vulnérabilité, vous devez utiliser des requêtes préparées pour
éviter l'injection SQL.

Dans les sections qui suivent, nous allons corriger notre application PHP pour
éviter les injections SQL à tous les endroits où elles sont possibles.

#### `addPet()`

Mettez à jour la fonction `addPet()` pour utiliser une requête préparée au lieu
d'une requête SQL brute :

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
    $stmt = $pdo->prepare($sql);

    // On lie les paramètres
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':species', $species);
    $stmt->bindValue(':nickname', $nickname);
    $stmt->bindValue(':sex', $sex);
    $stmt->bindValue(':age', $age);
    $stmt->bindValue(':color', $color);
    $stmt->bindValue(':personalities', $personalitiesAsString);
    $stmt->bindValue(':size', $size);
    $stmt->bindValue(':notes', $notes);

    // On exécute la requête SQL pour ajouter un animal
    $stmt->execute();

    // On récupère l'identifiant de l'animal ajouté
    $petId = $pdo->lastInsertId();

    // On retourne l'identifiant de l'animal ajouté.
    return $petId;
}
```

<details>
<summary>Afficher les différences entre la version vulnérable et la version corrigée</summary>

```diff
 <?php
 // Inclusion du fichier de connexion à la base de données
 require './database.php';

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
-        '$name',
-        '$species',
-        '$nickname',
-        '$sex',
-        '$age',
-        '$color',
-        '$personalitiesAsString',
-        '$size',
-        '$notes'
+        :name,
+        :species,
+        :nickname,
+        :sex,
+        :age,
+        :color,
+        :personalities,
+        :size,
+        :notes
     )";

+    // On prépare la requête SQL
+    $stmt = $pdo->prepare($sql);
+
+    // On lie les paramètres
+    $stmt->bindValue(':name', $name);
+    $stmt->bindValue(':species', $species);
+    $stmt->bindValue(':nickname', $nickname);
+    $stmt->bindValue(':sex', $sex);
+    $stmt->bindValue(':age', $age);
+    $stmt->bindValue(':color', $color);
+    $stmt->bindValue(':personalities', $personalitiesAsString);
+    $stmt->bindValue(':size', $size);
+    $stmt->bindValue(':notes', $notes);
+
     // On exécute la requête SQL pour ajouter un animal
-    $pdo->exec($sql);
+    $stmt->execute();

     // On récupère l'identifiant de l'animal ajouté
     $petId = $pdo->lastInsertId();

     // On retourne l'identifiant de l'animal ajouté.
     return $petId;
 }

 function updatePet($name, $age) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pets`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pets;

     // On vérifie si l'animal existe bien...
     if (array_key_exists($name, $pets)) {
         // ...si l'animal existe, on le récupère.
         $pet = $pets[$name];

         // On met à jour l'âge de l'animal.
         $pet['age'] = $age;

         // On met à jour l'animal dans le tableau `$pets`.
         $pets[$name] = $pet;

         // On retourne l'animal mis à jour.
         return $pet;
     } else {
         // ...si l'animal n'existe pas, on retourne `false`.
         return false;
     }
 }

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

</details>

Essayez maintenant d'insérer à nouveau l'animal de compagnie `Fluffy` avec la
requête SQL que vous avez formée à l'étape précédente.

Fluffy devrait être inséré dans la base de données sans problème et la table
`pets` ne devrait pas être supprimée. Les notes de l'animal de compagnie seront
littéralement `'); DROP TABLE pets; --` et ne seront pas interprétées comme une
requête SQL.

En corrigeant la vulnérabilité, vous avez sécurisé l'application contre les
injections SQL.

De plus, vous avez résolu le problème de ne pas pouvoir insérer des valeurs
contenant des apostrophes (`'`) dans les champs de texte évoqués lors du
précédent mini-projet. Maintenant, vous pouvez insérer des valeurs contenant des
apostrophes sans problème !

#### `removePet()`

La fonction `removePet()` est également vulnérable aux injections SQL. Vous
devez donc la corriger de la même manière que la fonction `addPet()` :

```php
function removePet($id) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
    // Même si c'est une mauvaise pratique, c'est nécessaire ici.
    global $pdo;

    // On définit la requête SQL pour supprimer un animal
    $sql = "DELETE FROM pets WHERE id = :id";

    // On prépare la requête SQL
    $stmt = $pdo->prepare($sql);

    // On lie le paramètre
    $stmt->bindValue(':id', $id);

    // On exécute la requête SQL pour supprimer un animal
    return $stmt->execute();
}
```

<details>
<summary>Afficher les différences entre la version vulnérable et la version corrigée</summary>

```diff
 <?php
 // Inclusion du fichier de connexion à la base de données
 require './database.php';

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
     $stmt = $pdo->prepare($sql);

     // On lie les paramètres
     $stmt->bindValue(':name', $name);
     $stmt->bindValue(':species', $species);
     $stmt->bindValue(':nickname', $nickname);
     $stmt->bindValue(':sex', $sex);
     $stmt->bindValue(':age', $age);
     $stmt->bindValue(':color', $color);
     $stmt->bindValue(':personalities', $personalitiesAsString);
     $stmt->bindValue(':size', $size);
     $stmt->bindValue(':notes', $notes);

     // On exécute la requête SQL pour ajouter un animal
     $stmt->execute();

     // On récupère l'identifiant de l'animal ajouté
     $petId = $pdo->lastInsertId();

     // On retourne l'identifiant de l'animal ajouté.
     return $petId;
 }

 function updatePet($name, $age) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pets`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pets;

     // On vérifie si l'animal existe bien...
     if (array_key_exists($name, $pets)) {
         // ...si l'animal existe, on le récupère.
         $pet = $pets[$name];

         // On met à jour l'âge de l'animal.
         $pet['age'] = $age;

         // On met à jour l'animal dans le tableau `$pets`.
         $pets[$name] = $pet;

         // On retourne l'animal mis à jour.
         return $pet;
     } else {
         // ...si l'animal n'existe pas, on retourne `false`.
         return false;
     }
 }

 function removePet($id) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pdo;

     // On définit la requête SQL pour supprimer un animal
-    $sql = "DELETE FROM pets WHERE id = '$id'";
+    $sql = "DELETE FROM pets WHERE id = :id";
+
+    // On prépare la requête SQL
+    $stmt = $pdo->prepare($sql);
+
+    // On lie le paramètre
+    $stmt->bindValue(':id', $id);

     // On exécute la requête SQL pour supprimer un animal
-    return $pdo->exec($sql);
+    return $stmt->execute();
 }
```

</details>

La fonction `removePet()` est maintenant sécurisée contre les injections SQL.

#### `getPet()`

La fonction `getPet()` est également vulnérable aux injections SQL. Vous devez
donc la corriger de la même manière que la fonction `addPet()` :

```php
function getPet($id) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
    // Même si c'est une mauvaise pratique, c'est nécessaire ici.
    global $pdo;

    // On définit la requête SQL pour récupérer un animal
    $sql = "SELECT * FROM pets WHERE id = :id";

    // On prépare la requête SQL
    $stmt = $pdo->prepare($sql);

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
```

<details>
<summary>Afficher les différences entre la version vulnérable et la version corrigée</summary>

```diff
 <?php
 // Inclusion du fichier de connexion à la base de données
 require './database.php';

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

 function getPet($id) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pdo;

     // On définit la requête SQL pour récupérer un animal
-    $sql = "SELECT * FROM pets WHERE id = '$id'";
+    $sql = "SELECT * FROM pets WHERE id = :id";
+
+    // On prépare la requête SQL
+    $stmt = $pdo->prepare($sql);

-    // On récupère l'animal spécifique
-    $pet = $pdo->query($sql);
+    // On lie le paramètre
+    $stmt->bindValue(':id', $id);

-    // On transforme le résultat en tableau associatif
-    $pet = $pet->fetch();
+    // On exécute la requête SQL
+    $stmt->execute();
+
+    // On récupère le résultat comme tableau associatif
+    $pet = $stmt->fetch();

     // On transforme la chaîne `personalities` en tableau si elle existe
     if ($pet && !empty($pet['personalities'])) {
         $pet['personalities'] = explode(',', $pet['personalities']);
     }

     // On retourne l'animal
     return $pet;
 }

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
     $stmt = $pdo->prepare($sql);

     // On lie les paramètres
     $stmt->bindValue(':name', $name);
     $stmt->bindValue(':species', $species);
     $stmt->bindValue(':nickname', $nickname);
     $stmt->bindValue(':sex', $sex);
     $stmt->bindValue(':age', $age);
     $stmt->bindValue(':color', $color);
     $stmt->bindValue(':personalities', $personalitiesAsString);
     $stmt->bindValue(':size', $size);
     $stmt->bindValue(':notes', $notes);

     // On exécute la requête SQL pour ajouter un animal
     $stmt->execute();

     // On récupère l'identifiant de l'animal ajouté
     $petId = $pdo->lastInsertId();

     // On retourne l'identifiant de l'animal ajouté.
     return $petId;
 }

 function updatePet($name, $age) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pets`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pets;

     // On vérifie si l'animal existe bien...
     if (array_key_exists($name, $pets)) {
         // ...si l'animal existe, on le récupère.
         $pet = $pets[$name];

         // On met à jour l'âge de l'animal.
         $pet['age'] = $age;

         // On met à jour l'animal dans le tableau `$pets`.
         $pets[$name] = $pet;

         // On retourne l'animal mis à jour.
         return $pet;
     } else {
         // ...si l'animal n'existe pas, on retourne `false`.
         return false;
     }
 }

 function removePet($id) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pdo;

     // On définit la requête SQL pour supprimer un animal
     $sql = "DELETE FROM pets WHERE id = :id";

     // On prépare la requête SQL
     $stmt = $pdo->prepare($sql);

     // On lie le paramètre
     $stmt->bindValue(':id', $id);

     // On exécute la requête SQL pour supprimer un animal
     return $stmt->execute();
 }
```

</details>

La fonction `getPet()` est maintenant sécurisée contre les injections SQL.

#### `getPets()`

La fonction `getPets()` n'est pas vulnérable aux injections SQL car elle ne
accepte pas de paramètres. Cependant, il est recommandé de la modifier pour
utiliser une requête préparée pour des raisons de cohérence et de sécurité :

```php
function getPets() {
    // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
    // Même si c'est une mauvaise pratique, c'est nécessaire ici.
    global $pdo;

    // On définit la requête SQL pour récupérer tous les animaux
    $sql = "SELECT * FROM pets";

    // On prépare la requête SQL
    $stmt = $pdo->prepare($sql);

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
```

<details>
<summary>Afficher les différences entre la version vulnérable et la version corrigée</summary>

```diff
 <?php
 // Inclusion du fichier de connexion à la base de données
 require './database.php';

 function getPets() {
     // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pdo;

     // On définit la requête SQL pour récupérer tous les animaux
     $sql = "SELECT * FROM pets";

-    // On récupère tous les animaux
-    $pets = $pdo->query($sql);
+    // On prépare la requête SQL
+    $stmt = $pdo->prepare($sql);

-    // On transforme le résultat en tableau associatif
-    $pets = $pets->fetchAll();
+    // On exécute la requête SQL
+    $stmt->execute();
+
+    // On récupère tous les animaux
+    $pets = $stmt->fetchAll();

     // On transforme la chaîne `personalities` en tableau pour chaque animal
     foreach ($pets as &$pet) {
         if (!empty($pet['personalities'])) {
             $pet['personalities'] = explode(',', $pet['personalities']);
         }
     }

     // On retourne tous les animaux
     return $pets;
 }

 function getPet($id) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pdo;

     // On définit la requête SQL pour récupérer un animal
     $sql = "SELECT * FROM pets WHERE id = :id";

     // On prépare la requête SQL
     $stmt = $pdo->prepare($sql);

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
     $stmt = $pdo->prepare($sql);

     // On lie les paramètres
     $stmt->bindValue(':name', $name);
     $stmt->bindValue(':species', $species);
     $stmt->bindValue(':nickname', $nickname);
     $stmt->bindValue(':sex', $sex);
     $stmt->bindValue(':age', $age);
     $stmt->bindValue(':color', $color);
     $stmt->bindValue(':personalities', $personalitiesAsString);
     $stmt->bindValue(':size', $size);
     $stmt->bindValue(':notes', $notes);

     // On exécute la requête SQL pour ajouter un animal
     $stmt->execute();

     // On récupère l'identifiant de l'animal ajouté
     $petId = $pdo->lastInsertId();

     // On retourne l'identifiant de l'animal ajouté.
     return $petId;
 }

 function updatePet($name, $age) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pets`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pets;

     // On vérifie si l'animal existe bien...
     if (array_key_exists($name, $pets)) {
         // ...si l'animal existe, on le récupère.
         $pet = $pets[$name];

         // On met à jour l'âge de l'animal.
         $pet['age'] = $age;

         // On met à jour l'animal dans le tableau `$pets`.
         $pets[$name] = $pet;

         // On retourne l'animal mis à jour.
         return $pet;
     } else {
         // ...si l'animal n'existe pas, on retourne `false`.
         return false;
     }
 }

 function removePet($id) {
     // On utilise le mot-clé `global` pour accéder à la variable `$pdo`.
     // Même si c'est une mauvaise pratique, c'est nécessaire ici.
     global $pdo;

     // On définit la requête SQL pour supprimer un animal
     $sql = "DELETE FROM pets WHERE id = :id";

     // On prépare la requête SQL
     $stmt = $pdo->prepare($sql);

     // On lie le paramètre
     $stmt->bindValue(':id', $id);

     // On exécute la requête SQL pour supprimer un animal
     return $stmt->execute();
 }
```

</details>

La fonction `getPets()` est maintenant sécurisée contre les injections SQL.

### Étape 5 : tester l'application

Une fois que vous avez corrigé toutes les vulnérabilités, testez l'application
pour vous assurer que tout fonctionne correctement :

- Ajoutez un animal de compagnie avec un nom contenant une apostrophe (`'`) et
  vérifiez que l'animal est ajouté correctement.
- Essayez d'insérer un animal de compagnie avec un nom contenant du code
  JavaScript malveillant et vérifiez que le code n'est pas exécuté.
- Essayez de supprimer un animal de compagnie et vérifiez que l'animal est
  supprimé correctement.

Vous avez maintenant sécurisé votre application PHP contre les injections SQL !

## Réaliser une attaque XSS

Dans cette section, vous allez réaliser une attaque XSS sur l'application PHP
que vous avez développée dans le mini-projet précédent.

Puis, vous allez corriger toutes les vulnérabilités d'attaques XSS pour
sécuriser votre application.

### Étape 1 : identifier une vulnérabilité

L'application PHP que vous avez développée dans le mini-projet précédent est
vulnérable aux attaques XSS. En effet, lorsque vous ajoutez un animal de
compagnie, le nom de l'animal est directement affiché sur la page d'accueil sans
aucun filtrage ni échappement :

```php
            <?php foreach ($pets as $pet) { ?>
                <tr>
                    <td><?= $pet['name'] ?></td>
                    <td><?= $pet['species'] ?></td>
                    <td><?= $pet['sex'] ?></td>
                    <td><?= $pet['age'] ?></td>
                    <td>
                        <a href="delete.php?id=<?= $pet['id'] ?>"><button>Supprimer</button></a>
                        <a href="view.php?id=<?= $pet['id'] ?>"><button>Visualiser</button></a>
                    </td>
                </tr>
            <?php } ?>
```

Cela signifie qu'un attaquant peut facilement injecter du code JavaScript
malveillant dans le nom de l'animal.

### Étape 2 : réaliser l'attaque XSS

Pour réaliser l'attaque XSS, insérez un animal de compagnie avec un nom qui
contient du code JavaScript malveillant :

- Nom : `<script>alert('Suis le lapin blanc')</script>`
- Espèce : `Lapin`
- Surnom : `Trinity`
- Sexe : `Femelle`
- Âge : `33`
- Couleur : `Blanc`
- Personnalités : `Curieuse`
- Taille : `172`
- Notes : `Tu appartiens à la matrice.`

Une fois l'animal de compagnie inséré, vous serez automatiquement redirigé sur
la page d'accueil.

Vous devriez voir une boîte de dialogue d'alerte contenant le message "Suis le
lapin blanc" lorsque la page sera chargée.

Le code JavaScript malveillant a été exécuté car il a été injecté dans le nom de
l'animal et affiché sur la page sans être échappé.

### Étape 3 : corriger la vulnérabilité

Pour corriger la vulnérabilité, vous devez échapper les données avant de les
afficher sur la page.

Dans les sections qui suivent, nous allons corriger notre application PHP pour
éviter les attaques XSS à tous les endroits où elles sont possibles.

#### `index.php`

Mettez à jour le fichier `index.php` pour échapper les données avant de les
afficher sur la page :

```php
            <?php foreach ($pets as $pet) { ?>
                <tr>
                    <td><?= htmlspecialchars($pet['name']) ?></td>
                    <td><?= htmlspecialchars($pet['species']) ?></td>
                    <td><?= htmlspecialchars($pet['sex']) ?></td>
                    <td><?= htmlspecialchars($pet['age']) ?></td>
                    <td>
                        <a href="delete.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Supprimer</button></a>
                        <a href="view.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Visualiser</button></a>
                    </td>
                </tr>
            <?php } ?>
```

<details>
<summary>Afficher les différences entre la version vulnérable et la version corrigée</summary>

```diff
 <?php
 require 'functions.php';

 // Récupère tous les animaux
 $pets = getPets();
 ?>

 <!DOCTYPE html>
 <html lang="fr">

 <head>
     <title>Page d'accueil | Gestionnaire d'animaux de compagnie</title>

     <style>
         table,
         th,
         td {
             border: 1px solid black;
             border-collapse: collapse;
             padding: 8px;
         }
     </style>
 </head>

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
                 <th>Actions</th>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($pets as $pet) { ?>
                 <tr>
-                    <td><?= $pet['name'] ?></td>
-                    <td><?= $pet['species'] ?></td>
-                    <td><?= $pet['sex'] ?></td>
-                    <td><?= $pet['age'] ?></td>
+                    <td><?= htmlspecialchars($pet['name']) ?></td>
+                    <td><?= htmlspecialchars($pet['species']) ?></td>
+                    <td><?= htmlspecialchars($pet['sex']) ?></td>
+                    <td><?= htmlspecialchars($pet['age']) ?></td>
                     <td>
-                        <a href="delete.php?id=<?= $pet['id'] ?>"><button>Supprimer</button></a>
-                        <a href="view.php?id=<?= $pet['id'] ?>"><button>Visualiser</button></a>
+                        <a href="delete.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Supprimer</button></a>
+                        <a href="view.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Visualiser</button></a>
                    </td>
                 </tr>
             <?php } ?>
         </tbody>
     </table>
 </body>

 </html>
```

</details>

En utilisant la fonction `htmlspecialchars()`, vous échappez les caractères
spéciaux HTML dans tous les champs affichés sur la page.

Cela signifie que le code JavaScript malveillant ne sera pas exécuté lorsque la
page sera chargée.

Essayez maintenant à nouveau de rafraîchir la page d'accueil. Vous ne devriez
plus voir la boîte de dialogue d'alerte contenant le message "Suis le lapin
blanc".

Le nom de l'animal est maintenant affiché correctement sans exécuter le code
JavaScript malveillant.

En corrigeant la vulnérabilité, vous avez sécurisé l'application contre les
attaques XSS.

#### `view.php`

La page `view.php` est également vulnérable aux attaques XSS. Vous devez donc la
corriger de la même manière que la page `index.php` :

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
        <input type="text" id="name" value="<?= htmlspecialchars($pet["name"]) ?>" disabled />

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" disabled>
            <option value="dog" <?= htmlspecialchars($pet["species"]) == "dog" ? "selected" : "" ?>>Chien</option>
            <option value="cat" <?= htmlspecialchars($pet["species"]) == "cat" ? "selected" : "" ?>>Chat</option>
            <option value="lizard" <?= htmlspecialchars($pet["species"]) == "lizard" ? "selected" : "" ?>>Lézard</option>
            <option value="snake" <?= htmlspecialchars($pet["species"]) == "snake" ? "selected" : "" ?>>Serpent</option>
            <option value="bird" <?= htmlspecialchars($pet["species"]) == "bird" ? "selected" : "" ?>>Oiseau</option>
            <option value="rabbit" <?= htmlspecialchars($pet["species"]) == "rabbit" ? "selected" : "" ?>>Lapin</option>
            <option value="other" <?= htmlspecialchars($pet["species"]) == "other" ? "selected" : "" ?>>Autre</option>
        </select>

        <br>

        <label for="nickname">Surnom :</label><br>
        <input type="text" id="nickname" value="<?= htmlspecialchars($pet["nickname"]) ?>" disabled />

        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" <?= htmlspecialchars($pet["sex"]) == "male" ? "checked" : "" ?> disabled />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" <?= htmlspecialchars($pet["sex"]) == "female" ? "checked" : "" ?> disabled />
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

        <a href="delete.php?id=<?= $pet["id"] ?>">
            <button type="button">Supprimer</button>
        </a><br>
        <a href="edit.php?id=<?= $pet["id"] ?>">
            <button type="button">Mettre à jour</button>
        </a>
    </form>
</body>

</html>
```

<details>
<summary>Afficher les différences entre la version vulnérable et la version corrigée</summary>

```diff
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
-        <input type="text" id="name" value="<?= $pet["name"] ?>" disabled />
+        <input type="text" id="name" value="<?= htmlspecialchars($pet["name"]) ?>" disabled />

         <br>

         <label for="species">Espèce :</label><br>
         <select id="species" disabled>
-            <option value="dog" <?= $pet["species"] == "dog" ? "selected" : "" ?>>Chien</option>
-            <option value="cat" <?= $pet["species"] == "cat" ? "selected" : "" ?>>Chat</option>
-            <option value="lizard" <?= $pet["species"] == "lizard" ? "selected" : "" ?>>Lézard</option>
-            <option value="snake" <?= $pet["species"] == "snake" ? "selected" : "" ?>>Serpent</option>
-            <option value="bird" <?= $pet["species"] == "bird" ? "selected" : "" ?>>Oiseau</option>
-            <option value="rabbit" <?= $pet["species"] == "rabbit" ? "selected" : "" ?>>Lapin</option>
-            <option value="other" <?= $pet["species"] == "other" ? "selected" : "" ?>>Autre</option>
+            <option value="dog" <?= htmlspecialchars($pet["species"]) == "dog" ? "selected" : "" ?>>Chien</option>
+            <option value="cat" <?= htmlspecialchars($pet["species"]) == "cat" ? "selected" : "" ?>>Chat</option>
+            <option value="lizard" <?= htmlspecialchars($pet["species"]) == "lizard" ? "selected" : "" ?>>Lézard</option>
+            <option value="snake" <?= htmlspecialchars($pet["species"]) == "snake" ? "selected" : "" ?>>Serpent</option>
+            <option value="bird" <?= htmlspecialchars($pet["species"]) == "bird" ? "selected" : "" ?>>Oiseau</option>
+            <option value="rabbit" <?= htmlspecialchars($pet["species"]) == "rabbit" ? "selected" : "" ?>>Lapin</option>
+            <option value="other" <?= htmlspecialchars($pet["species"]) == "other" ? "selected" : "" ?>>Autre</option>
         </select>

         <br>

         <label for="nickname">Surnom :</label><br>
-        <input type="text" id="nickname" value="<?= $pet["nickname"] ?>" disabled />
+        <input type="text" id="nickname" value="<?= htmlspecialchars($pet["nickname"]) ?>" disabled />

         <fieldset>
             <legend>Sexe :</legend>

-            <input type="radio" id="male" <?= $pet["sex"] == "male" ? "checked" : "" ?> disabled />
+            <input type="radio" id="male" <?= htmlspecialchars($pet["sex"]) == "male" ? "checked" : "" ?> disabled />
             <label for="male">Mâle</label><br>

-            <input type="radio" id="female" <?= $pet["sex"] == "female" ? "checked" : "" ?> disabled />
+            <input type="radio" id="female" <?= htmlspecialchars($pet["sex"]) == "female" ? "checked" : "" ?> disabled />
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

-        <a href="delete.php?id=<?= $pet["id"] ?>">
+        <a href="delete.php?id=<?= htmlspecialchars($pet["id"]) ?>">
             <button type="button">Supprimer</button>
         </a>
     </form>
 </body>

 </html>
```

</details>

Vous avez maintenant sécurisé la page `view.php` contre les attaques XSS.

#### `create.php`

La page `create.php` est également vulnérable aux attaques XSS. Vous devez donc
la corriger de la même manière que les pages `index.php` :

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
```

<details>
<summary>Afficher les différences entre la version vulnérable et la version corrigée</summary>

```diff
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
-        <input type="text" id="name" name="name" value="<?php if (isset($name)) echo $name; ?>" required minlength="2">
+        <input type="text" id="name" name="name" value="<?php if (isset($name)) echo htmlspecialchars($name); ?>" required minlength="2">

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
-        <input type="text" id="nickname" name="nickname" value="<?php if (isset($nickname)) echo $nickname; ?>" />
+        <input type="text" id="nickname" name="nickname" value="<?php if (isset($nickname)) echo htmlspecialchars($nickname); ?>" />

         <fieldset>
             <legend>Sexe :</legend>

             <input type="radio" id="male" name="sex" value="male" <?php echo (isset($sex) && $sex == 'male') ? 'checked' : ''; ?> required />
             <label for="male">Mâle</label><br>

             <input type="radio" id="female" name="sex" value="female" <?php echo (isset($sex) && $sex == 'female') ? 'checked' : ''; ?> required />
             <label for="female">Femelle</label>
         </fieldset>

         <br>

         <label for="age">Âge :</label><br>
-        <input type="number" id="age" name="age" value="<?php if (isset($age)) echo $age; ?>" required min="0" />
+        <input type="number" id="age" name="age" value="<?php if (isset($age)) echo htmlspecialchars($age); ?>" required min="0" />

         <br>

         <label for="color">Couleur :</label><br>
-        <input type="color" id="color" name="color" value="<?php if (isset($color)) echo $color; ?>" />
+        <input type="color" id="color" name="color" value="<?php if (isset($color)) echo htmlspecialchars($color); ?>" />

         <fieldset>
             <legend>Personnalité :</legend>

             <div>
                 <input type="checkbox" id="gentil" name="personalities[]" value="gentil" <?php echo (isset($personalities) && in_array("gentil", $personal
ities)) ? 'checked' : ''; ?> />
                 <label for="gentil">Gentil</label>
             </div>

             <div>
                 <input type="checkbox" id="playful" name="personalities[]" value="playful" <?php echo (isset($personalities) && in_array("playful", $perso
nalities)) ? 'checked' : ''; ?> />
                 <label for="playful">Joueur</label>
             </div>

             <div>
                 <input type="checkbox" id="curious" name="personalities[]" value="curious" <?php echo (isset($personalities) && in_array("curious", $perso
nalities)) ? 'checked' : ''; ?> />
                 <label for="curious">Curieux</label>
             </div>

             <div>
                 <input type="checkbox" id="lazy" name="personalities[]" value="lazy" <?php echo (isset($personalities) && in_array("lazy", $personalities)
) ? 'checked' : ''; ?> />
                 <label for="lazy">Paresseux</label>
             </div>

             <div>
                 <input type="checkbox" id="scared" name="personalities[]" value="scared" <?php echo (isset($personalities) && in_array("scared", $personal
ities)) ? 'checked' : ''; ?> />
                 <label for="scared">Peureux</label>
             </div>

             <div>
                 <input type="checkbox" id="aggressive" name="personalities[]" value="aggressive" <?php echo (isset($personalities) && in_array("aggressive
", $personalities)) ? 'checked' : ''; ?> />
                 <label for="aggressive">Agressif</label>
             </div>
         </fieldset>

         <br>

         <label for="size">Taille :</label><br>
-        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo $size; ?>" min="0" step="0.1" />
+        <input type="number" id="size" name="size" value="<?php if (isset($size)) echo htmlspecialchars($size); ?>" min="0" step="0.1" />

         <br>

         <label for="notes">Notes :</label><br>
-        <textarea id="notes" name="notes" rows="4" cols="50"><?php if (isset($notes)) echo $notes; ?></textarea>
+        <textarea id="notes" name="notes" rows="4" cols="50"><?php if (isset($notes)) echo htmlspecialchars($notes); ?></textarea>

         <br>
         <br>

         <button type="submit">Créer</button><br>
         <button type="reset">Réinitialiser</button>
     </form>
 </body>

 </html>
```

</details>

La page `create.php` est maintenant sécurisée contre les attaques XSS.

### Étape 4 : tester l'application

Une fois que vous avez corrigé toutes les vulnérabilités, testez l'application
pour vous assurer que tout fonctionne correctement :

- Utilisez toutes les pages de l'application (`index.php`, `create.php` et
  `view.php`) et vérifiez que les données sont correctement échappées.

Toutes données affichées sur la page provenant de saisies utilisateur doivent
être échappées pour éviter les attaques XSS.

## Ajout de la possibilité de mettre à jour un animal

Afin de finaliser les fonctionnalités de notre application de gestion d'animaux
de compagnie, il ne reste qu'à ajouter la possibilité de mettre à jour un animal
de compagnie.

### Ajout du fichier `edit.php`

Pour ajouter la possibilité de mettre à jour un animal de compagnie, vous devez
créer un nouveau fichier `edit.php` qui contiendra le formulaire de mise à jour
de l'animal.

Votre structure de projet devrait ressembler à ceci :

```text
progserv1/
├── exercices/
│   └── index.php
├── mini-projet/
│   ├── create.php
│   ├── database.php
│   ├── edit.php
│   ├── functions.php
│   ├── index.php
│   └── view.php
├── index.php
└── phpinfo.php
```

Complétez le fichier `edit.php` avec le code suivant :

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
        // On met à jour l'animal dans la base de données
        $success = updatePet(
            $id,
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
    <title>Modifie un animal de compagnie | Gestionnaire d'animaux de compagnie</title>

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

        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" value="<?= isset($name) ? htmlspecialchars($name) : "" ?>" required minlength="2">

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" name="species" required>
            <option value="dog" <?= isset($species) && $species == "dog" ? "selected" : "" ?>>Chien</option>
            <option value="cat" <?= isset($species) && $species == "cat" ? "selected" : "" ?>>Chat</option>
            <option value="lizard" <?= isset($species) && $species == "lizard" ? "selected" : "" ?>>Lézard</option>
            <option value="snake" <?= isset($species) && $species == "snake" ? "selected" : "" ?>>Serpent</option>
            <option value="bird" <?= isset($species) && $species == "bird" ? "selected" : "" ?>>Oiseau</option>
            <option value="rabbit" <?= isset($species) && $species == "rabbit" ? "selected" : "" ?>>Lapin</option>
            <option value="other" <?= isset($species) && $species == "other" ? "selected" : "" ?>>Autre</option>
        </select>

        <br>

        <label for="nickname">Surnom :</label><br>
        <input type="text" id="nickname" name="nickname" value="<?= isset($nickname) ? htmlspecialchars($nickname) : "" ?>" />

        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" name="sex" value="male" <?= isset($sex) && $sex == "male" ? "checked" : "" ?> required />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" name="sex" value="female" <?= isset($sex) && $sex == "female" ? "checked" : ""; ?> required />
            <label for="female">Femelle</label>
        </fieldset>

        <br>

        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age" value="<?= isset($age) ? htmlspecialchars($age) : "" ?>" required min="0" />

        <br>

        <label for="color">Couleur :</label><br>
        <input type="color" id="color" name="color" value="<?= isset($color) ? htmlspecialchars($color) : "" ?>" />

        <fieldset>
            <legend>Personnalité :</legend>

            <div>
                <input type="checkbox" id="gentil" name="personalities[]" value="gentil" <?= !empty($personalities) && in_array("gentil", $personalities) ? "checked" : "" ?> />
                <label for="gentil">Gentil</label>
            </div>

            <div>
                <input type="checkbox" id="playful" name="personalities[]" value="playful" <?= !empty($personalities) && in_array("playful", $personalities) ? "checked" : "" ?> />
                <label for="playful">Joueur</label>
            </div>

            <div>
                <input type="checkbox" id="curious" name="personalities[]" value="curious" <?= !empty($personalities) && in_array("curious", $personalities) ? "checked" : "" ?> />
                <label for="curious">Curieux</label>
            </div>

            <div>
                <input type="checkbox" id="lazy" name="personalities[]" value="lazy" <?= !empty($personalities) && in_array("lazy", $personalities) ? "checked" : "" ?> />
                <label for="lazy">Paresseux</label>
            </div>

            <div>
                <input type="checkbox" id="scared" name="personalities[]" value="scared" <?= !empty($personalities) && in_array("scared", $personalities) ? "checked" : "" ?> />
                <label for="scared">Peureux</label>
            </div>

            <div>
                <input type="checkbox" id="aggressive" name="personalities[]" value="aggressive" <?= !empty($personalities) && in_array("aggressive", $personalities) ? "checked" : "" ?> />
                <label for="aggressive">Agressif</label>
            </div>
        </fieldset>

        <br>

        <label for="size">Taille :</label><br>
        <input type="number" id="size" name="size" value="<?= isset($size) ? htmlspecialchars($size) : "" ?>" min="0" step="0.1" />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"><?= isset($notes) ? htmlspecialchars($notes) : "" ?></textarea>

        <br>
        <br>

        <a href="delete.php?id=<?= htmlspecialchars($pet["id"]) ?>">
            <button type="button">Supprimer</button>
        </a><br>
        <button type="submit">Mettre à jour</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>

</head>
```

Prenez le temps de lire le code et de comprendre son fonctionnement.

Vous remarquerez peut-être que le code est très similaire à celui des fichiers
`create.php` et `view.php`. Cela est normal car le formulaire de mise à jour est
une fusion de ces deux fonctionnalités.

Prenons le temps de passer en revue les différentes parties du code. Le contenu
de certains blocs de code sont volontairement laissés vides pour se concentrer
sur le fonctionnement global de la page.

```php
if (isset($_GET["id"])) {
    // 1. On vérifie si l'ID de l'animal est passé dans l'URL
    // ...
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 2. On gère la soumission du formulaire
    // ...
} else {
    // 3. Si l'ID n'est pas passé dans l'URL, on redirige vers la page d'accueil
    // ...
}

// 4. Affichage du formulaire
// ...
```

1. Dans cette première partie, nous vérifions si l'ID de l'animal est passé dans
   l'URL. Si c'est le cas, nous récupérons l'animal correspondant à cet ID.
2. Si nous sommes dans le cas où l'utilisateur a soumis le formulaire, nous
   récupérons les données du formulaire et nous les validons. Si le formulaire
   est valide, nous mettons à jour l'animal dans la base de données.
3. Si l'ID n'est pas passé dans l'URL et que nous ne sommes pas dans le cas où
   l'utilisateur a soumis le formulaire, nous redirigeons vers la page
   d'accueil.
4. Enfin, nous affichons le formulaire de mise à jour de l'animal avec les
   données pré-remplies et les erreurs éventuelles.

Concentrons-nous sur la partie de code qui récupère l'animal à partir de son ID
(point 1 et point 3) :

```php
if (isset($_GET["id"])) {
    // On récupère l'ID de l'animal de la superglobale `$_GET`
    $petId = $_GET["id"];

    // On récupère l'animal correspondant à l'ID
    $pet = getPet($petId);

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
    // On gère la soumission du formulaire
    // ...
} else {
    // Si l'ID n'est pas passé dans l'URL, on redirige vers la page d'accueil
    header("Location: index.php");
    exit();
}
```

Dans cette partie, très semblable à la page `view.php`, nous vérifions si l'ID
de l'animal est passé dans l'URL. Nous utilisons la fonction `getPet()` pour
récupérer l'animal correspondant à l'ID. Si l'animal n'existe pas, nous
redirigeons vers la page d'accueil.

Sinon, nous initialisons les variables avec les données de l'animal.

Cette dernière partie est importante car elle nous permet de pré-remplir le
formulaire avec les données de l'animal à mettre à jour et de garder les mêmes
noms de variables, autant lors de la construction du formulaire que lors de la
soumission du formulaire.

Dans le bloc du code `else`, nous redirigeons vers la page d'accueil si l'ID
n'est pas passé dans l'URL. Cela permet d'éviter d'afficher le formulaire de
mise à jour sans avoir d'animal à mettre à jour.

Concentrons-nous maintenant sur la partie d'affichage du formulaire de mise à
jour de l'animal (point 4)

```php
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlentities($pet["id"]) ?>" />

        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" value="<?= isset($name) ? htmlspecialchars($name) : "" ?>" required minlength="2">

        <br>

        <label for="species">Espèce :</label><br>
        <select id="species" name="species" required>
            <option value="dog" <?= isset($species) && $species == "dog" ? "selected" : "" ?>>Chien</option>
            <option value="cat" <?= isset($species) && $species == "cat" ? "selected" : "" ?>>Chat</option>
            <option value="lizard" <?= isset($species) && $species == "lizard" ? "selected" : "" ?>>Lézard</option>
            <option value="snake" <?= isset($species) && $species == "snake" ? "selected" : "" ?>>Serpent</option>
            <option value="bird" <?= isset($species) && $species == "bird" ? "selected" : "" ?>>Oiseau</option>
            <option value="rabbit" <?= isset($species) && $species == "rabbit" ? "selected" : "" ?>>Lapin</option>
            <option value="other" <?= isset($species) && $species == "other" ? "selected" : "" ?>>Autre</option>
        </select>

        <br>

        <label for="nickname">Surnom :</label><br>
        <input type="text" id="nickname" name="nickname" value="<?= isset($nickname) ? htmlspecialchars($nickname) : "" ?>" />

        <fieldset>
            <legend>Sexe :</legend>

            <input type="radio" id="male" name="sex" value="male" <?= isset($sex) && $sex == "male" ? "checked" : "" ?> required />
            <label for="male">Mâle</label><br>

            <input type="radio" id="female" name="sex" value="female" <?= isset($sex) && $sex == "female" ? "checked" : ""; ?> required />
            <label for="female">Femelle</label>
        </fieldset>

        <br>

        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age" value="<?= isset($age) ? htmlspecialchars($age) : "" ?>" required min="0" />

        <br>

        <label for="color">Couleur :</label><br>
        <input type="color" id="color" name="color" value="<?= isset($color) ? htmlspecialchars($color) : "" ?>" />

        <fieldset>
            <legend>Personnalité :</legend>

            <div>
                <input type="checkbox" id="gentil" name="personalities[]" value="gentil" <?= !empty($personalities) && in_array("gentil", $personalities) ? "checked" : "" ?> />
                <label for="gentil">Gentil</label>
            </div>

            <div>
                <input type="checkbox" id="playful" name="personalities[]" value="playful" <?= !empty($personalities) && in_array("playful", $personalities) ? "checked" : "" ?> />
                <label for="playful">Joueur</label>
            </div>

            <div>
                <input type="checkbox" id="curious" name="personalities[]" value="curious" <?= !empty($personalities) && in_array("curious", $personalities) ? "checked" : "" ?> />
                <label for="curious">Curieux</label>
            </div>

            <div>
                <input type="checkbox" id="lazy" name="personalities[]" value="lazy" <?= !empty($personalities) && in_array("lazy", $personalities) ? "checked" : "" ?> />
                <label for="lazy">Paresseux</label>
            </div>

            <div>
                <input type="checkbox" id="scared" name="personalities[]" value="scared" <?= !empty($personalities) && in_array("scared", $personalities) ? "checked" : "" ?> />
                <label for="scared">Peureux</label>
            </div>

            <div>
                <input type="checkbox" id="aggressive" name="personalities[]" value="aggressive" <?= !empty($personalities) && in_array("aggressive", $personalities) ? "checked" : "" ?> />
                <label for="aggressive">Agressif</label>
            </div>
        </fieldset>

        <br>

        <label for="size">Taille :</label><br>
        <input type="number" id="size" name="size" value="<?= isset($size) ? htmlspecialchars($size) : "" ?>" min="0" step="0.1" />

        <br>

        <label for="notes">Notes :</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"><?= isset($notes) ? htmlspecialchars($notes) : "" ?></textarea>

        <br>
        <br>

        <a href="delete.php?id=<?= htmlspecialchars($pet["id"]) ?>">
            <button type="button">Supprimer</button>
        </a><br>
        <button type="submit">Mettre à jour</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
```

Dans cette partie, très similaire à la page `create.php`, nous affichons le
formulaire de mise à jour de l'animal avec les données pré-remplies. Nous
utilisons la fonction `htmlspecialchars()` pour échapper les données de l'animal
afin d'éviter les attaques XSS.

Lorsque l'utilisateur accède à la page `edit.php`, nous affichons le formulaire
de mise à jour de l'animal avec les données pré-remplies issues des variables
initialisées précédemment.

Un point important à noter est que nous avons ajouté un champ caché
[`<input type="hidden" />`](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/hidden)
qui contient l'ID de l'animal à mettre à jour.

Un champ caché est un champ de formulaire qui n'est pas visible pour
l'utilisateur, mais qui est envoyé avec le formulaire lors de la soumission. Il
est utilisé pour stocker des informations que l'utilisateur ne doit pas
modifier, mais qui sont nécessaires pour le traitement du formulaire.

Dans ce cas, nous utilisons le champ caché pour stocker l'ID de l'animal à
mettre à jour. Lorsque le formulaire est soumis, l'ID de l'animal est envoyé
avec les autres données du formulaire. Cela nous permet de savoir quel animal
mettre à jour lorsque le formulaire est soumis.

Lorsque l'utilisateur soumet le formulaire, nous transmettons toutes les
informations nécessaires à la page `edit.php` (la page elle-même) pour mettre à
jour l'animal dans la base de données, ce qui nous amène à la partie suivante.

Concentrons-nous sur la partie de code qui gère la soumission du formulaire et
la mise à jour de l'animal (point 2) :

```php
if (isset($_GET["id"])) {
    // On vérifie si l'ID de l'animal est passé dans l'URL
    // ...
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
        // On met à jour l'animal dans la base de données
        $success = updatePet(
            $id,
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
    // ...
}

// Affichage du formulaire
// ...
```

Dans cette partie, très similaire au fichier `create.php`, nous récupérons les
données du formulaire et nous les validons. Si le formulaire est valide, nous
appelons la fonction `updatePet()` pour mettre à jour l'animal dans la base de
données.

Vous remarquerez peut-être que nous récupérons l'ID de l'animal à partir du
champ caché du formulaire. Cela nous permet de savoir quel animal mettre à jour
lorsque le formulaire est soumis.

Nous vérifions également si la mise à jour a réussi. Si c'est le cas, nous
redirigeons vers la page de l'animal modifié. Sinon, nous affichons un message
d'erreur.

Si une erreur survient lors de la mise à jour, nous affichons les différents
messages d'erreur en utilisant les mêmes noms de variables que ceux initialisés
lors de la récupération des données de l'animal dans la base de données et
pré-remplissons le formulaire avec les données de l'animal, permettant ainsi de
corriger les erreurs.

### Mise à jour de la fonction `updatePet()`

Dans le fichier `functions.php`, vous devez mettre à jour la fonction
`updatePet()` pour qu'elle prenne en compte les nouvelles données passées dans
le formulaire de mise à jour :

```php

function updatePet(
    $id,
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
    $stmt = $pdo->prepare($sql);

    // On lie les paramètres
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':species', $species);
    $stmt->bindValue(':nickname', $nickname);
    $stmt->bindValue(':sex', $sex);
    $stmt->bindValue(':age', $age);
    $stmt->bindValue(':color', $color);
    $stmt->bindValue(':personalities', $personalitiesAsString);
    $stmt->bindValue(':size', $size);
    $stmt->bindValue(':notes', $notes);

    // On exécute la requête SQL pour mettre à jour un animal
    return $stmt->execute();
}
```

Cette fonction est très similaire à la fonction `addPet()`, mais elle utilise
une requête SQL `UPDATE` au lieu d'une requête `INSERT`. Elle prend également en
compte l'ID de l'animal à mettre à jour.

En utilisant toutes les bonnes pratiques de sécurité, nous avons utilisé des
requêtes préparées pour éviter les injections SQL.

La méthode `execute()` renvoie `true` si la mise à jour a réussi, sinon elle
renvoie `false`.

### Mise à jour du fichier `view.php`

Afin de permettre la mise à jour d'un animal, vous devez mettre à jour le
fichier `view.php` pour y ajouter un bouton vers la page d'édition de celui-ci :

```php
        <a href="delete.php?id=<?= htmlspecialchars($pet["id"]) ?>">
            <button type="button">Supprimer</button>
        </a><br>
        <a href="edit.php?id=<?= htmlspecialchars($pet["id"]) ?>">
            <button type="button">Mettre à jour</button>
        </a>
```

### Mise à jour du fichier `index.php`

De la même manière que le fichier `view.php`, vous devez mettre à jour le
fichier `index.php` pour ajouter un bouton vers la page de mise à jour de
l'animal :

```php
                    <td>
                        <a href="delete.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Supprimer</button></a>
                        <a href="edit.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Éditer</button></a>
                        <a href="view.php?id=<?= htmlspecialchars($pet['id']) ?>"><button>Visualiser</button></a>
                    </td>
```

### Tests de l'application

Une fois que vous avez ajouté la fonctionnalité de mise à jour, testez
l'application pour vous assurer que tout fonctionne correctement :

- Créez un nouvel animal de compagnie.
- Visualisez la liste des animaux de compagnie.
- Visualisez l'animal de compagnie que vous venez de créer.
- Mettez à jour l'animal de compagnie que vous venez de créer.
- Vérifiez que les données sont correctement mises à jour.
- Supprimez l'animal de compagnie que vous venez de créer.

## Solution

Vous pouvez trouver la solution du mini-projet PHP à l'adresse suivante :
[`solution`](./solution/).

## Conclusion

Vous avez maintenant une application de gestion d'animaux de compagnie
fonctionnelle avec la possibilité de créer, visualiser, mettre à jour et
supprimer des animaux de compagnie ! Bravo ! Vous pouvez être fier.e de vous !

Dans le prochain cours, nous verrons comment améliorer la structure de notre
application en utilisant des principes de programmation orientée objet (POO)
pour rendre notre code plus modulaire, réutilisable et plus facile à comprendre
et maintenir.

## Aller plus loin

_Ceci est une section optionnelle pour les personnes qui souhaitent aller plus
loin. Vous pouvez la sauter si vous n'avez pas de temps._

- Ajoutez la possibilité de trier les animaux par age dans la liste des animaux.
  - Vous pouvez utiliser un paramètre dans l'URL (tel que `?ageSort=asc` ou
    `?ageSort=desc`) pour déterminer l'ordre de tri.
  - Vous pouvez utiliser la fonction
    [`usort()`](https://www.php.net/manual/fr/function.usort.php) pour trier un
    tableau d'animaux.
- Ajoutez la possibilité de filtrer les animaux par espèce dans la liste des
  animaux.
  - Vous pouvez utiliser un paramètre dans l'URL (tel que `?species=dog`) pour
    filtrer les animaux par espèce.
  - Vous pouvez utiliser la fonction
    [`array_filter()`](https://www.php.net/manual/fr/function.array-filter.php)
    pour filtrer un tableau d'animaux.
