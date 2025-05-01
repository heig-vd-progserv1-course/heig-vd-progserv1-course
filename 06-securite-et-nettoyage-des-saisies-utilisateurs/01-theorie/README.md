# Cours 06 - Sécurité et nettoyage des saisies utilisateurs

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
- [Objectifs](#objectifs)
- [Validation et nettoyage des saisies utilisateurs](#validation-et-nettoyage-des-saisies-utilisateurs)
- [Nettoyage des saisies utilisateurs](#nettoyage-des-saisies-utilisateurs)
- [Implications de sécurité](#implications-de-sécurité)
  - [Injections SQL](#injections-sql)
  - [Attaques XSS](#attaques-xss)
- [Se prémunir conte les injections SQL et les attaques XSS](#se-prémunir-conte-les-injections-sql-et-les-attaques-xss)
  - [Requêtes préparées](#requêtes-préparées)
- [Conclusion](#conclusion)
- [Mini-projet](#mini-projet)
- [Exercices](#exercices)

## Objectifs

Jusqu'à présent, nous avons vu comment créer une base de données et interagir
avec elle à l'aide de PHP et de PDO. Cependant, il est important de s'assurer
que les données saisies par les utilisateurs sont sécurisées et valables avant
de les insérer dans la base de données. Cela est particulièrement important pour
éviter les attaques par injection SQL et les attaques XSS.

Cette session vise à vous familiariser avec les concepts de sécurité et de
nettoyage des saisies utilisateurs. Nous allons aborder les injections SQL et
les attaques XSS, ainsi que les bonnes pratiques pour éviter ces types
d'attaques.

De façon plus précise, les personnes qui étudient devraient être capables de :

- TODO

## Validation et nettoyage des saisies utilisateurs

La validation et le nettoyage des saisies utilisateurs sont des étapes
essentielles dans le développement d'applications web sécurisées. Ces étapes
permettent de s'assurer que les données saisies par les utilisateurs sont
valides, sûres et ne contiennent pas de code malveillant. Cela est
particulièrement important lorsque les données saisies par les utilisateurs sont
utilisées dans des requêtes SQL ou affichées dans des pages web.

La validation consiste à vérifier que les données saisies par les utilisateurs
sont conformes à un ensemble de règles prédéfinies. Par exemple, si un champ
doit contenir une adresse e-mail, la validation vérifiera que la valeur saisie
est bien une adresse e-mail valide. Si la valeur saisie ne respecte pas les
règles de validation, elle sera rejetée et l'utilisateur sera invité à corriger
sa saisie.

Le nettoyage consiste à supprimer ou échapper les caractères spéciaux ou
malveillants dans les données saisies par les utilisateurs. Cela permet de
s'assurer que les données saisies ne contiennent pas de code malveillant qui
pourrait être injecté dans une requête SQL ou exécuté dans une page web.

Jusqu'à présent, nous avons vu comment comment valider les saisies utilisateurs
dans le
[Cours 04 - Formulaires HTML et validation](../../04-formulaires-html-et-validation/01-theorie/README.md).
Nous allons maintenant nous intéresser à la sécurité des saisies utilisateurs et
aux attaques qui peuvent être réalisées si les saisies utilisateurs ne sont pas
correctement validées et nettoyées.

## Nettoyage des saisies utilisateurs

Le nettoyage des saisies utilisateurs consiste à supprimer ou échapper les
caractères spéciaux ou malveillants dans les données saisies par les
utilisateurs.

Le terme _"échapper"_ fait référence à la pratique de remplacer les caractères
spéciaux par des séquences d'échappement qui sont interprétées comme des
caractères littéraux plutôt que comme des caractères spéciaux. Par exemple, le
caractère `<` est un caractère spécial en HTML qui est utilisé pour ouvrir une
balise.

Si vous souhaitez afficher le caractère `<` dans une page web, vous devez
l'échapper en utilisant la séquence d'échappement `&lt;`. Cela garantit que le
caractère `<` est affiché comme un caractère littéral plutôt que comme le début
d'une balise HTML.

En PHP, la fonction
[`htmlspecialchars`](https://www.php.net/manual/fr/function.htmlspecialchars.php)
est utilisée pour échapper les caractères spéciaux dans une chaîne de
caractères.

Voici quelques exemples de caractères spéciaux et leurs séquences d'échappement
en HTML :

| Caractère | Séquence d'échappement |
| :-------- | :--------------------- |
| `<`       | `&lt;`                 |
| `>`       | `&gt;`                 |
| `&`       | `&amp;`                |
| `"`       | `&quot;`               |
| `'`       | `&apos;`               |

Une liste plus complète des caractères spéciaux et de leurs séquences
d'échappement est disponible sur Wikipedia :
[Liste des entités de caractère de XML et HTML](https://fr.wikipedia.org/wiki/Liste_des_entit%C3%A9s_de_caract%C3%A8re_de_XML_et_HTML).

Voici un exemple de code PHP qui utilise la fonction `htmlspecialchars` pour
échapper les caractères spéciaux dans une chaîne de caractères :

```php
// On définit une chaîne de caractères HTML avec des caractères spéciaux
$string = "<a href='test'>Test</a>";

// On échappe les caractères spéciaux
// La chaîne échappée sera : &lt;a href='test'&gt;Test&lt;/a&gt;
$escapedString = htmlspecialchars($string);

// On affiche la chaîne échappée, qui sera littéralement
// <a href='test'>Test</a>
// et non un lien cliquable
echo $escapedString;
```

Dans cet exemple, la chaîne de caractères `$string` contient du code HTML qui
génère un lien. Sans nettoyage, ce code serait interprété par le navigateur et
afficherait un lien cliquable.

Cependant, en utilisant la fonction `htmlspecialchars`, nous échappons les
caractères spéciaux et affichons la chaîne de caractères échappée.

Cela garantit que le code HTML (ou JavaScript) est affiché comme une chaîne de
caractères littérale plutôt que comme du code qui serait interprété par le
navigateur.

## Implications de sécurité

Il existe plusieurs types d'attaques qui peuvent être réalisées si les saisies
utilisateurs ne sont pas correctement nettoyées. Les deux types d'attaques les
plus courants sont :

- Les injections SQL
- Les attaques XSS

### Injections SQL

Les injections SQL sont une technique d'attaque qui permet à un attaquant
d'injecter du code SQL malveillant dans une requête SQL. Cela peut entraîner des
fuites de données, des modifications non autorisées de données ou même la
suppression de données.

Les injections SQL se produisent généralement lorsque les entrées utilisateur ne
sont pas correctement filtrées ou échappées avant d'être utilisées dans une
requête SQL. Par exemple, si une application web permet à un utilisateur de
fournir un nom d'utilisateur et un mot de passe, et que ces valeurs sont
directement insérées dans une requête SQL sans être échappées, un attaquant
pourrait entrer une chaîne de caractères malveillante qui modifie la requête SQL
pour exécuter des actions non autorisées.

Voici un exemple de code PHP vulnérable aux injections SQL :

> [!CAUTION]
>
> **Attention** : ce code est vulnérable aux injections SQL et ne respecte pas
> les bonnes pratiques pour enregistrer les mots de passe dans la base de
> données.
>
> Ni la validation ni le nettoyage des saisies utilisateurs ne sont effectués.
>
> **Ce code ne doit pas être utilisé dans une application réelle**. Il est
> uniquement fourni à titre d'exemple.

```php
<?php
// Constante pour le fichier de base de données SQLite
const DATABASE_FILE = './users.db';

// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // On récupère les données du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $pdo = new PDO("sqlite:" . DATABASE_FILE);

    // Création d'une table `users`
    $sql = 'CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )';

    // On exécute la requête SQL pour créer la table
    $pdo->exec($sql);

    // On prépare la requête SQL pour ajouter un utilisateur
    $sql = "INSERT INTO users (
        email,
        password
    ) VALUES (
        '$email',
        '$password'
    )";

    // On exécute la requête SQL pour ajouter l'utilisateur
    $pdo->exec($sql);
}
?>

<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Création d'un compte</title>
</head>

<body>
    <h1>Création d'un compte</h1>
    <form action="register.php" method="POST">
        <label for="email">E-mail :</label><br>
        <input
            type="text"
            id="email"
            name="email" />

        <br>

        <label for="password">Mot de passe :</label><br>
        <input
            type="text"
            id="password"
            name="password" />

        <br>

        <button type="submit">Envoyer</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <p>Le formulaire a été soumis avec succès.</p>
    <?php } ?>
</body>

</html>
```

Dans cet exemple, les valeurs de `$email` et `$password` sont directement
insérées dans la requête SQL sans être échappées. Cela signifie qu'un attaquant
pourrait entrer une chaîne de caractères malveillante dans le champ `email` ou
`password` qui modifierait la requête SQL pour exécuter des actions non
autorisées.

Par exemple, un attaquant pourrait entrer les valeurs suivantes dans le
formulaire :

- Pour le champ `email` : `', ''); DROP TABLE users; ---`
- Pour le champ `password` : `password`

Cela modifierait la requête SQL pour qu'elle ressemble à ceci :

```sql
INSERT INTO users (email, password) VALUES ('' OR 1=1; DROP TABLE users; --', 'password')
```

Dans cet exemple, la requête SQL serait modifiée pour exécuter deux instructions
SQL :

1. `INSERT INTO users (email, password) VALUES ('', 'password')` : cela
   insérerait un nouvel utilisateur avec un e-mail vide et le mot de passe
   `password`.
2. `DROP TABLE users` : cela supprimerait la table `users` de la base de
   données.

Cela signifie que l'attaquant pourrait supprimer la table `users` de la base de
données, ce qui entraînerait la perte de toutes les données de la table. Il est
donc important de toujours valider et nettoyer les saisies utilisateurs avant de
les utiliser dans une requête SQL. Cela garantit que seules les données valides
et sûres sont utilisées dans l'application.

### Attaques XSS

Les attaques XSS (Cross-Site Scripting) sont une technique d'attaque qui permet
à un attaquant d'injecter du code JavaScript malveillant dans une page web. Cela
peut entraîner des fuites de données, des modifications non autorisées de
données ou même la redirection de l'utilisateur vers un site malveillant.

Tout comme les injections SQL, les attaques XSS se produisent généralement
lorsque les entrées utilisateur ne sont pas correctement filtrées ou échappées
avant d'être affichées dans une page web. Par exemple, si une application web
permet à un utilisateur de fournir un commentaire, et que ce commentaire est
directement affiché dans une page web sans être échappé, un attaquant pourrait
entrer une chaîne de caractères malveillante qui injecte du code JavaScript dans
la page web.

Comme vous n'avez pas encore étudié le JavaScript, nous ne nous attarderons pas
trop en détail sur ce type d'attaques. Cependant, il est important de garder à
l'esprit que les attaques XSS sont une menace sérieuse pour la sécurité des
applications web et que les principes de sécurité que vous apprendrez dans ce
mini-projet s'appliquent également à la prévention des attaques XSS.

## Se prémunir conte les injections SQL et les attaques XSS

Pour se protéger contre les injections SQL et les attaques XSS, il est important
de suivre certaines bonnes pratiques lors de la manipulation des données saisies
par les utilisateurs. Voici quelques-unes des meilleures pratiques à suivre :

- Toujours utiliser des requêtes préparées et des instructions paramétrées lors
  de l'interaction avec une base de données. Cela garantit que les entrées
  utilisateur sont correctement échappées et que le code SQL malveillant ne peut
  pas être injecté dans la requête.
- Toujours valider et filtrer les entrées utilisateur avant de les utiliser dans
  une requête SQL ou de les afficher dans une page web. Cela garantit que seules
  les données valides et sûres sont utilisées dans l'application.
- Toujours échapper les données avant de les afficher dans une page web. Cela
  garantit que le code JavaScript malveillant ne peut pas être injecté dans la
  page web.

### Requêtes préparées

Les requêtes préparées sont une fonctionnalité de PDO qui permet de préparer une
requête SQL avant de l'exécuter. Cela permet de séparer le code SQL des données
et d'éviter les injections SQL. Les requêtes préparées utilisent des paramètres
pour représenter les valeurs qui seront insérées dans la requête SQL. Ces
paramètres sont ensuite liés aux valeurs réelles avant d'exécuter la requête.
Voici un exemple de requête préparée :

```php
// On prépare la requête SQL
$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
$stmt = $pdo->prepare($sql);
// On lie les paramètres aux valeurs réelles
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
// On exécute la requête
$stmt->execute();
// On récupère les résultats
$results = $stmt->fetchAll();
```

Dans cet exemple, les valeurs de `$username` et `$password` sont liées aux
paramètres `:username` et `:password` dans la requête SQL. Cela garantit que les
valeurs sont correctement échappées et que le code SQL malveillant ne peut pas
être injecté dans la requête.

Pour éviter les injections SQL, il est donc important de toujours utiliser des
requêtes préparées et des instructions paramétrées lors de l'interaction avec
une base de données. Cela garantit que les entrées utilisateur sont correctement
échappées et que le code SQL malveillant ne peut pas être injecté dans la
requête.

## Conclusion

TODO

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
