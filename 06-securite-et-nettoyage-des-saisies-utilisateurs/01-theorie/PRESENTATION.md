---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: L. Delafontaine, avec l'aide de GitHub Copilot
title: HEIG-VD ProgServ1 Course - Cours 06 - Sécurité et nettoyage des saisies utilisateurs
description: Cours 06 - Sécurité et nettoyage des saisies utilisateurs pour le cours ProgServ1 à la HEIG-VD, Suisse
url: https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/06-securite-et-nettoyage-des-saisies-utilisateurs/01-theorie/index.html
header: "**Cours 06 - Sécurité et nettoyage des saisies utilisateurs**"
footer: "**HEIG-VD** - ProgServ1 Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
math: mathjax
-->

# Cours 06 - Sécurité et nettoyage des saisies utilisateurs

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

- Lister les différences entre la validation et le nettoyage des saisies
  utilisateurs
- Lister les implications de sécurité des saisies utilisateurs
- Décrire les attaques par injection SQL et XSS
- Se prémunir contre les injections SQL et les attaques XSS

![bg right:40%][illustration-objectifs]

## Objectifs (2/2)

- Utiliser des requêtes préparées avec PDO
- Échapper les données avant de les afficher dans une page web

![bg right:40%][illustration-objectifs]

## Validation et nettoyage des saisies utilisateurs

- La validation consiste à vérifier que les données saisies par l'utilisateur
  respectent un certain format ou des règles spécifiques.
- Le nettoyage consiste à supprimer ou échapper (= modifier) les caractères
  spéciaux ou malveillants des données saisies par l'utilisateur.

![bg right:40%][illustration-validation-et-nettoyage-des-saisies-utilisateurs]

## Nettoyage des saisies utilisateurs (1/3)

- _"Échapper"_ signifie remplacer les caractères spéciaux par des séquences de
  caractères interprétées comme des caractères littéraux plutôt que comme des
  caractères spéciaux.
- La fonction
  [`htmlspecialchars`](https://www.php.net/manual/fr/function.htmlspecialchars.php)
  est utilisée pour cela.

![bg right:40%][illustration-nettoyage-des-saisies-utilisateurs]

## Nettoyage des saisies utilisateurs (2/3)

Par exemple, la table suivante présente des caractères échappés.

| Caractère | Séquence d'échappement |
| :-------- | :--------------------- |
| `<`       | `&lt;`                 |
| `>`       | `&gt;`                 |
| `&`       | `&amp;`                |
| `"`       | `&quot;`               |
| `'`       | `&apos;`               |

## Nettoyage des saisies utilisateurs (3/3)

```php
// On définit une chaîne de caractères HTML avec des caractères spéciaux
$string = "<a href='index.php'>Accueil</a>";

// Affiche un lien cliquable - à éviter à tout prix
echo $string;

// On échappe les caractères spéciaux
// La chaîne échappée sera : &lt;a href='index.php'&gt;Accueil&lt;/a&gt;
$escapedString = htmlspecialchars($string);

// On affiche la chaîne échappée, qui sera littéralement
// <a href='index.php'>Accueil</a>
// et non un lien cliquable
echo $escapedString;
```

## Implications de sécurité

- Les saisies utilisateurs peuvent contenir des données malveillantes.
- Ces données peuvent être utilisées pour réaliser des attaques avec des
  conséquences graves.
- Les attaques les plus courantes sont :
  - Les injections SQL
  - Les attaques XSS

![bg][illustration-injections-sql]
![bg right:40% vertical][illustration-attaques-xss]

### Injections SQL (1/3)

- Permettent d'injecter du code SQL dans une requête déjà existante.
- Permettent d'accéder à des données sensibles ou de modifier la base de
  données.
- Souvent réalisées en utilisant des formulaires web lorsque les saisies
  utilisateurs ne sont pas correctement échappées ou validées.

![bg right:40%][illustration-injections-sql]

### Injections SQL (2/3)

```php
<?php
// Constante pour le fichier de base de données SQLite
const DATABASE_FILE = "./users.db";

// Connexion à la base de données
$pdo = new PDO("sqlite:" . DATABASE_FILE);

// Création d'une table `users`
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
)";
```

---

```php
// On exécute la requête SQL pour créer la table
$pdo->exec($sql);

// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // On récupère les données du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // On prépare la requête SQL pour ajouter un utilisateur
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    // On exécute la requête SQL pour ajouter l'utilisateur
    $pdo->exec($sql);
}
?>
```

---

```php
<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Création d'un compte</title>
</head>

<body>
    <h1>Création d'un compte</h1>
    <a href="view-accounts.php"><button>Voir les comptes</button></a>
```

---

```php
    <form action="create-account.php" method="POST">
        <label for="email">E-mail :</label><br>
        <input
            type="text"
            id="email"
            name="email" />

        <br>

        <label for="password">Mot de passe :</label><br>
        <input
            type="password"
            id="password"
            name="password" />
```

---

```php
        <br>

        <button type="submit">Envoyer</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <p>Le formulaire a été soumis avec succès.</p>
    <?php } ?>
</body>

</html>
```

### Injections SQL (3/3)

- Si un utilisateur saisit `'); DROP TABLE users; --` dans le champ password, la
  requête SQL devient :

```sql
INSERT INTO users (email, password) VALUES ('me@example.com', ''); DROP TABLE users; --'
```

- La requête SQL est alors exécutée et la table `users` est supprimée.
- Les traits d'union ( `--`) sont un commentaire SQL ; le reste de la requête
  est ignoré.
- En injectant notre propre code SQL, nous pouvons manipuler la base de données.
  Les conséquences sont infinies. 🙃

### Attaques XSS (1/3)

- Permettent d'injecter et d'exécuter du code JavaScript dans une page web.
- Souvent réalisées lors de l'affichage de données non échappées dans une page
  web.
- Comme vous n'avez pas encore étudié JavaScript, nous n'allons pas aller dans
  les détails mais illustrer le principe.

![bg right:40%][illustration-attaques-xss]

### Attaques XSS (2/3)

```php
<?php
// Constante pour le fichier de base de données SQLite
const DATABASE_FILE = "./users.db";

// Connexion à la base de données
$pdo = new PDO("sqlite:" . DATABASE_FILE);

// On prépare la requête SQL pour récupérer tous les utilisateurs
$sql = "SELECT * FROM users";

// On exécute la requête SQL pour récupérer les utilisateurs
$users = $pdo->query($sql);
```

---

```php
// On transforme le résultat en tableau
$users = $users->fetchAll();
?>

<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Comptes utilisateurs</title>
</head>

<body>
    <h1>Comptes utilisateurs</h1>

    <a href="create-account.php"><button>Créer un compte</button></a>
```

---

```php
    <ul>
        <?php foreach ($users as $user) : ?>
            <li><?= $user["email"] ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>
```

### Attaques XSS (3/3)

- Si un utilisateur saisit `<script>alert("Vous avez été piraté !");</script>`
  dans le champ email, la page affichera une alerte JavaScript avec le message
  `Vous avez été piraté !`.
- Bien que l'exemple paraisse inoffensif, du code JavaScript a été injecté et
  exécuté dans la page web avec succès.
- En injectant notre propre code JavaScript, nous pouvons manipuler la page web.
  Les conséquences sont infinies. 🙃

## Se prémunir conte les injections SQL et les attaques XSS

- Les bonnes pratiques à suivre :
  - Ne jamais faire confiance aux saisies utilisateurs.
  - Toujours valider, nettoyer et échapper les saisies utilisateurs avant de les
    utiliser.

![bg right:40%][illustration-se-premunir-conte-les-injections-sql-et-les-attaques-xss]

### Requêtes préparées avec PDO (1/4)

- Fonctionnalité de PDO pour éviter les injections SQL.
- Permet de préparer une requête SQL avec des paramètres.
- Les paramètres sont remplacés et échappés automatiquement par des valeurs lors
  de l'exécution de la requête.

![bg right:40%][illustration-injections-sql]

### Requêtes préparées avec PDO (2/4)

```php
    // On prépare la requête SQL pour ajouter un utilisateur
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

    // On prépare la requête SQL
    $stmt = $pdo->prepare($sql);

    // On lie les paramètres aux valeurs réelles
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);

    // On exécute la requête
    $stmt->execute();
```

### Requêtes préparées avec PDO (3/4)

```diff
     // On prépare la requête SQL pour ajouter un utilisateur
-    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
+    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
+
+    // On prépare la requête
+    $stmt = $pdo->prepare($sql);
+
+    // On lie les paramètres
+    $stmt->bindValue(':email', $email);
+    $stmt->bindValue(':password', $password);

     // On exécute la requête SQL pour ajouter l'utilisateur
-    $pdo->exec($sql);
+    $stmt->execute();
```

### Requêtes préparées avec PDO (4/4)

- Les paramètres sont automatiquement échappés et remplacés par PDO.
- Les injections SQL sont donc impossibles.
- Recommandé d'utiliser des requêtes préparées pour toutes les requêtes SQL,
  même celles qui ne contiennent pas de saisies utilisateurs.

### Échapper les données (1/4)

- Permet de transformer les caractères spéciaux en séquences d'échappement.
- Permet d'éviter les attaques XSS.
- Utiliser la fonction
  [`htmlspecialchars`](https://www.php.net/manual/fr/function.htmlspecialchars.php)
  offerte par PHP pour échapper les caractères spéciaux.

![bg right:40%][illustration-attaques-xss]

### Échapper les données (2/4)

```php
    <ul>
        <?php foreach ($users as $user) : ?>
            <li><?= htmlspecialchars($user["email"]) ?></li>
        <?php endforeach; ?>
    </ul>
```

### Échapper les données (3/4)

```diff
     <ul>
         <?php foreach ($users as $user) : ?>
-            <li><?= $user["email"] ?></li>
+            <li><?= htmlspecialchars($user["email"]) ?></li>
         <?php endforeach; ?>
     </ul>
```

### Échapper les données (4/4)

- Les caractères spéciaux sont transformés en séquences d'échappement.
- Les attaques XSS sont donc impossibles.
- Recommandé d'utiliser `htmlspecialchars` pour toutes les données affichées
  issues de saisies utilisateurs.

## Conclusion (1/2)

- **Ne jamais faire confiance aux saisies utilisateurs !**
- La validation et le nettoyage des saisies utilisateurs sont essentiels pour
  éviter les injections SQL et les attaques XSS.
- Utiliser des requêtes préparées avec PDO pour éviter les injections SQL.

![bg right:40%][illustration-principale]

## Conclusion (2/2)

- Utiliser `htmlspecialchars` pour échapper les données avant de les afficher
  dans une page web.
- Dans la vie réelle, il est souvent nécessaire de tâtonner pour trouver les
  vulnérabilités.
- **Il peut y avoir des conséquences graves !** Ne pas reproduire ces attaques
  sur des applications web sans autorisation explicite !

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
- [Illustration][illustration-validation-et-nettoyage-des-saisies-utilisateurs]
  par [Kelly Sikkema](https://unsplash.com/@kellysikkema) sur
  [Unsplash](https://unsplash.com/photos/stack-of-papers-flat-lay-photography-tQQ4BwN_UFs)
- [Illustration][illustration-nettoyage-des-saisies-utilisateurs] par
  [Towfiqu barbhuiya](https://unsplash.com/@towfiqu999999) sur
  [Unsplash](https://unsplash.com/photos/person-holding-white-ceramic-mug-ho-p7qLBewk)
- [Illustration][illustration-injections-sql] par
  [Sunder Muthukumaran](https://unsplash.com/@sunder_2k25) sur
  [Unsplash](https://unsplash.com/photos/a-stack-of-stacked-blue-and-white-plates-n7eJHQwefeI)
- [Illustration][illustration-attaques-xss] par
  [Jen Theodore](https://unsplash.com/@jentheodore) sur
  [Unsplash](https://unsplash.com/photos/white-and-black-abstract-painting-aWmQE4CvXK0)
- [Illustration][illustration-se-premunir-conte-les-injections-sql-et-les-attaques-xss]
  par [John Salvino](https://unsplash.com/@jsalvino) sur
  [Unsplash](https://unsplash.com/photos/gray-steel-chain-locked-on-gate-bqGBbLq_yfc)
- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

<!-- URLs -->

[presentation-web]:
	https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/06-securite-et-nettoyage-des-saisies-utilisateurs/01-theorie/index.html
[presentation-pdf]:
	https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/06-securite-et-nettoyage-des-saisies-utilisateurs/01-theorie/06-securite-et-nettoyage-des-saisies-utilisateurs-presentation.pdf
[course-material]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/06-securite-et-nettoyage-des-saisies-utilisateurs/01-theorie/README.md
[license]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/LICENSE.md
[mini-project]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/06-securite-et-nettoyage-des-saisies-utilisateurs/02-mini-project/README.md
[exercices]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/06-securite-et-nettoyage-des-saisies-utilisateurs/03-exercices/README.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-validation-et-nettoyage-des-saisies-utilisateurs]:
	https://images.unsplash.com/photo-1554224155-1696413565d3?fit=crop&h=720
[illustration-nettoyage-des-saisies-utilisateurs]:
	https://images.unsplash.com/photo-1628177142898-93e36e4e3a50?fit=crop&h=720
[illustration-injections-sql]:
	https://images.unsplash.com/photo-1633412802994-5c058f151b66?fit=crop&h=720
[illustration-attaques-xss]:
	https://images.unsplash.com/photo-1579894963949-95530a650650?fit=crop&h=720
[illustration-se-premunir-conte-les-injections-sql-et-les-attaques-xss]:
	https://images.unsplash.com/photo-1508345228704-935cc84bf5e2?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
