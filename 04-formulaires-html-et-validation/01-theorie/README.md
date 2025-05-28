# Cours 04 - Formulaires HTML et validation

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
- [Objectifs](#objectifs)
- [Formulaires HTML](#formulaires-html)
  - [Structure d'un formulaire](#structure-dun-formulaire)
  - [Attributs](#attributs)
- [Envoyer les données des formulaires](#envoyer-les-données-des-formulaires)
  - [URL d'action](#url-daction)
  - [Méthodes `GET` et `POST`](#méthodes-get-et-post)
- [Réceptionner les données des formulaires](#réceptionner-les-données-des-formulaires)
  - [Traitement des données à l'aide des superglobales PHP](#traitement-des-données-à-laide-des-superglobales-php)
  - [Conservation des données saisies](#conservation-des-données-saisies)
- [Validation des formulaires](#validation-des-formulaires)
  - [Côté serveur](#côté-serveur)
  - [Côté client](#côté-client)
- [Conclusion](#conclusion)
- [Mini-projet](#mini-projet)
- [Exercices](#exercices)

## Objectifs

Dans ce cours, nous allons explorer les formulaires HTML et la validation des
données saisies par les utilisateurs. Nous allons apprendre à créer des
formulaires HTML, à envoyer des données au serveur et à traiter ces données à
l'aide de PHP.

Nous allons également aborder la validation des formulaires, tant côté serveur
que côté client. La validation est essentielle pour garantir la sécurité et
l'intégrité des données, ainsi que pour améliorer l'expérience utilisateur.

De façon plus concise, les personnes qui étudient devraient être capables de :

- Créer des formulaires HTML pour collecter des données utilisateur.
- Envoyer des données de formulaires au serveur à l'aide de PHP.
- Récupérer les données envoyées par le formulaire à l'aide de PHP.
- Expliquer la différence entre les méthodes `GET` et `POST`.
- Valider les données saisies par l'utilisateur côté serveur et côté client.
- Afficher des messages d'erreur clairs en cas de validation échouée.
- Pré-remplir les champs de formulaire avec les valeurs précédemment saisies.

## Formulaires HTML

Les formulaires HTML sont des éléments essentiels pour interagir avec les
utilisateurs sur le web.

Ils permettent de collecter des données, d'envoyer des informations à un serveur
et de créer des interfaces utilisateur dynamiques.

Un formulaire HTML est constitué de divers éléments tels que des champs de
texte, des boutons, des cases à cocher, des listes déroulantes, etc. Ces
éléments permettent aux utilisateurs de saisir des informations et d'interagir
avec l'application web.

Les formulaires sont souvent utilisés pour des actions telles que l'inscription,
la connexion, la recherche, la soumission de commentaires, etc. Ils sont
essentiels pour créer des applications web interactives et conviviales.

### Structure d'un formulaire

Un formulaire HTML est défini à l'aide de la balise `<form>`. Cette balise
permet de regrouper les différents éléments du formulaire et de spécifier
comment les données doivent être envoyées au serveur.

Au sein du formulaire, il est possible d'inclure divers éléments tels que des
champs de texte, des boutons, des cases à cocher, des listes déroulantes, etc.
Chaque élément est défini à l'aide de balises HTML spécifiques, telles que
[`<input>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input),
[`<select>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/select),
etc.

Voici un exemple de structure de formulaire HTML :

```html
<form action="register.php" method="POST">
	<label for="username">Pseudo :</label><br />
	<input type="text" id="username" name="username" />

	<label for="password">Mot de passe :</label><br />
	<input type="password" id="password" name="password" />

	<br />

	<button type="submit">Envoyer</button>
</form>
```

Dans cet exemple, le formulaire contient deux champs de texte (email et mot de
passe) et un bouton de soumission.

Chacun de ces champs a un nom (`name`) qui est utilisé pour identifier les
données lors de l'envoi au serveur. De plus, chaque champ a un identifiant
(`id`) qui est utilisé pour lier une étiquette (`<label>`) au champ de
formulaire. Cela permet d'améliorer l'accessibilité et l'expérience utilisateur.

L'attribut `action` spécifie l'URL à laquelle les données du formulaire seront
envoyées lorsque l'utilisateur cliquera sur le bouton "Envoyer". L'attribut
`method` spécifie la méthode HTTP à utiliser pour envoyer les données (dans ce
cas, `POST`).

Tous les champs de formulaire sont documentés dans la
[documentation de MDN](https://developer.mozilla.org/fr/). Voici quelques champs
de formulaire courants :

- [Champs `<input>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input)
- [Champ `<select>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/select)
- [Champ `<textarea>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/textarea)
- [Champ `<button>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/button)
- [Champ `<label>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/label)
- [Champ `<fieldset>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/fieldset)

Nous allons en explorer quelques-uns dans cette section.

#### Champs `<input>`

Les champs `<input>` sont utilisés pour créer divers types de champs de saisie,
tels que des champs de texte, des cases à cocher, des boutons radio, des champs
de mot de passe, etc. Le type de champ est spécifié à l'aide de l'attribut
`type`.

Voici quelques types de champs `<input>` courants :

```html
<!-- Champ de texte -->
<input type="text" name="name" />

<!-- Champ de email -->
<input type="email" name="email" />

<!-- Champ de mot de passe -->
<input type="password" name="password" />

<!-- Champ de case à cocher -->
<input type="checkbox" name="subscribe" value="yes" />
```

#### Champ `<select>`

Le champ `<select>` est utilisé pour créer une liste déroulante. Il permet à
l'utilisateur de choisir une option parmi plusieurs. Les options sont définies à
l'aide de la balise `<option>`. Voici un exemple de champ `<select>` :

```html
<select name="country">
	<option value="france">France</option>
	<option value="switzerland">Suisse</option>
	<option value="belgium">Belgique</option>
</select>
```

Chaque option a une valeur (`value`) qui sera envoyée au serveur lorsque le
formulaire sera soumis. La valeur affichée à l'utilisateur est le texte entre la
balise `<option>` et la balise de fermeture `</option>`.

#### Champ `<textarea>`

Le champ `<textarea>` est utilisé pour créer un champ de saisie de texte
multiligne. Il permet à l'utilisateur de saisir de grandes quantités de texte.

Voici un exemple de champ `<textarea>` :

```html
<textarea name="message" rows="4" cols="50">
    Écrivez votre message ici...
</textarea>
```

Le champ `<textarea>` peut inclure des attributs pour spécifier la taille du
champ, tels que `rows` (nombre de lignes) et `cols` (nombre de colonnes).

Il peut également être pré-rempli avec du texte par défaut en plaçant le texte
entre la balise d'ouverture `<textarea>` et la balise de fermeture
`</textarea>`.

#### Champs `<button>`

Le champ `<button>` est utilisé pour créer un bouton cliquable. Il peut être
utilisé pour soumettre le formulaire ou effectuer d'autres actions.

Voici quelques types de champs `<button>` courants :

```html
<!-- Ce bouton soumet le formulaire -->
<button type="submit">Envoyer</button>

<!-- Ce bouton réinitialise le formulaire -->
<button type="reset">Réinitialiser</button>
```

Le bouton de type `submit` envoie les données du formulaire au serveur lorsque
l'utilisateur clique dessus. Le bouton de type `reset` réinitialise tous les
champs du formulaire à leurs valeurs par défaut.

### Attributs

Les éléments de formulaire HTML peuvent avoir divers attributs qui permettent de
personnaliser leur comportement. Voici quelques attributs courants que l'on peut
utiliser avec les éléments de formulaire (entre autres) :

- `name` : spécifie le nom du champ de formulaire. Ce nom est utilisé pour
  identifier le champ lors de l'envoi des données au serveur.
- `id` : spécifie un identifiant unique pour l'élément. Cela permet de lier une
  étiquette (`<label>`) à un champ de formulaire et d'appliquer des styles CSS.
- `value` : spécifie la valeur par défaut du champ. Pour les champs de type
  `checkbox` et `radio`, il spécifie la valeur qui sera envoyée au serveur si le
  champ est sélectionné.
- `placeholder` : spécifie un texte d'indice qui s'affiche dans le champ avant
  que l'utilisateur ne saisisse une valeur. Cela permet de donner des
  indications sur le format attendu.
- `required` : indique que le champ est obligatoire et doit être rempli avant la
  soumission du formulaire. Si le champ est vide, le navigateur affichera un
  message d'erreur.

La documentation MDN fournit des informations détaillées sur les attributs des
éléments de formulaire HTML :

- [Champs `<input>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/input)
- [Champ `<select>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/select)
- [Champ `<textarea>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/textarea)
- [Champ `<button>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/button)
- [Champ `<label>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/label)
- [Champ `<fieldset>`](https://developer.mozilla.org/fr/docs/Web/HTML/Element/fieldset)

## Envoyer les données des formulaires

Lorsqu'un utilisateur remplit un formulaire et clique sur le bouton de
soumission ( `<button type="submit">` ou `<input type="submit">`), les données
saisies sont envoyées à un serveur pour traitement. Cela permet de collecter des
informations, d'enregistrer des données dans une base de données ou d'effectuer
d'autres actions en fonction des données saisies.

### URL d'action

L'URL d'action est l'URL à laquelle les données du formulaire seront envoyées
lorsque le formulaire sera soumis. Cette URL peut être un script PHP, un
endpoint d'API ou toute autre ressource capable de traiter les données du
formulaire. L'URL d'action est spécifiée dans l'attribut `action` de la balise
`<form>`.

### Méthodes `GET` et `POST`

Les formulaires HTML peuvent envoyer des données à un serveur en utilisant
différentes méthodes reposants sur le protocole HTTP. Les deux méthodes les plus
courantes sont `GET` et `POST`.

Illustrons la différence entre ces deux méthodes à l'aide du formulaire suivant
:

```html
<!-- La méthode peut être `GET` ou `POST` -->
<form action="login.php" method="">
	<label for="username">Pseudo : </label><br />
	<input type="text" id="username" name="username" value="xXBestOf1400Xx" />

	<label for="password">Mot de passe :</label><br />
	<input
		type="password"
		id="password"
		name="password"
		value="m0n-sup3r-m0t-de-p4asse"
	/>

	<button type="submit">Envoyer</button>
</form>
```

- La méthode `GET` envoie les données du formulaire dans l'URL de la requête
  HTTP.

  Par exemple, si une personne soumet un formulaire avec la méthode `GET`, les
  données seront envoyées à l'URL `login.php` avec les paramètres `username` et
  `password` :
  `http://localhost/login.php?username=xXBestOf1400Xx&password=m0n-sup3r-m0t-de-p4asse`.

  Les données sont ajoutées à l'URL après le point d'interrogation (`?`) et sont
  séparées par des esperluettes (`&`) si plusieurs champs sont présents.

  Cette méthode est déconseillée car cela signifie que les données sont visibles
  dans la barre d'adresse du navigateur et peuvent être enregistrées dans
  l'historique du navigateur. Dans cet exemple, le nom d'utilisateur et le mot
  de passe pourraient facilement être retrouvés par un tiers et les utiliser à
  des fins malveillantes.

  De plus, la méthode `GET` a une limite de taille pour les données envoyées
  dans l'URL. La plupart des navigateurs limitent la longueur de l'URL à environ
  2000 caractères, ce qui peut poser problème si vous devez envoyer de grandes
  quantités de données.

- La méthode `POST` envoie les données du formulaire dans le corps de la requête
  HTTP.

  En reprenant l'exemple précédent, si une personne soumet un formulaire avec la
  méthode `POST`, les données ne seront pas visibles dans l'URL. Au lieu de
  cela, elles seront envoyées dans le corps de la requête HTTP : l'URL de la
  requête ressemblera à ceci : `http://localhost/login.php`, et les données
  seront envoyées dans le corps de la requête.

  Cela signifie que les données sont envoyées de manière plus sécurisée, car
  elles ne sont pas visibles dans l'URL et ne peuvent pas être facilement
  interceptées par des tiers. De plus, la méthode `POST` permet d'envoyer des
  données plus volumineuses que la méthode `GET`, car il n'y a pas de limite de
  taille pour le corps de la requête.

  Cette méthode est généralement utilisée pour des requêtes plus complexes,
  telles que l'envoi de données sensibles (comme des mots de passe) ou la
  soumission de formulaires contenant de grandes quantités de données.

## Réceptionner les données des formulaires

Lorsque le formulaire est soumis, le serveur reçoit les données envoyées par
l'utilisateur. Ces données peuvent être traitées de différentes manières selon
la technologie utilisée côté serveur.

Avec PHP par exemple, les données sont accessibles via les superglobales `$_GET`
ou `$_POST`.

### Traitement des données à l'aide des superglobales PHP

Avec PHP par exemple, vous pouvez accéder aux données du formulaire en utilisant
les superglobales `$_GET` ou `$_POST`, selon la méthode utilisée pour envoyer
les données (`GET` ou `POST`).

Ces superglobales sont des tableaux associatifs qui associent les noms des
champs (à l'aide de l'attribut `name`) du formulaire aux valeurs soumises.

Vous pouvez ensuite utiliser ces données pour effectuer des opérations telles
que l'insertion dans une base de données, l'envoi d'e-mails ou la génération de
réponses dynamiques.

Voici un exemple de traitement des données d'un formulaire en PHP en utilisant
la page `login.php` :

```php
<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Authentification</title>
</head>

<body>
    <h1>Se connecter</h1>
    <form action="login.php" method="POST">
        <label for="username">Pseudo :</label><br>
        <input type="text" id="username" name="username" />

        <br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" />

        <br>

        <button type="submit">Envoyer</button>
    </form>

</body>

</html>

<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    echo "Le nom d'utilisateur est : " . $username . "<br>";
    echo "Le mot de passe est : " . $password . "<br>";
}
?>
```

Ici, nous avons un code PHP séparé en deux parties : la première partie génère
le formulaire HTML en lui-même et la deuxième partie traite les données soumises
lorsque le formulaire est envoyé.

Lorsque l'utilisateur accède à la page `login.php`, il voit le formulaire HTML.
Ce formulaire contient deux champs de texte pour le prénom et le nom, ainsi
qu'un bouton "Envoyer". Le formulaire est configuré pour envoyer les données à
la même page (`login.php`) lorsque l'utilisateur clique sur le bouton "Envoyer".

Lorsque l'utilisateur remplit le formulaire et clique sur le bouton "Envoyer",
les données sont envoyées à la même page (`register.php`) en utilisant la
méthode `POST`. Le code PHP vérifie si la méthode de la requête est `POST` et
récupère les valeurs des champs `firstName` et `lastName` à l'aide de la
superglobale `$_POST`.

Ensuite, il affiche un message de bienvenue avec le prénom et le nom de
l'utilisateur qui aura été saisi dans le formulaire.

### Conservation des données saisies

Lors de la soumission du formulaire, les données saisies par l'utilisateur sont
perdues.

Afin de conserver les valeurs saisies par l'utilisateur et améliorer
l'expérience utilisateur, il est possible de pré-remplir les champs du
formulaire avec les valeurs précédemment saisies.

Voici un exemple de code PHP qui conserve des valeurs saisies par l'utilisateur
:

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
}
?>

<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Authentification</title>
</head>

<body>
    <h1>Se connecter</h1>
    <form action="login.php" method="POST">
        <label for="username">Pseudo :</label><br>
        <input
            type="text"
            id="username"
            name="username"
            value="<?php echo isset($username) ? $username : ''; ?>" />

        <br>

        <label for="password">Mot de passe :</label><br>
        <input
            type="password"
            id="password"
            name="password" />

        <br>

        <button type="submit">Envoyer</button>
    </form>

    <?php
    echo "Le nom d'utilisateur est : " . $username . "<br>";
    echo "Le mot de passe est : " . $password . "<br>";
    ?>

</body>

</html>
```

Dans cet exemple, nous avons déplacé la section PHP au début du fichier pour
gérer la soumission du formulaire. Cela nous permet de conserver les valeurs
saisies par l'utilisateur dans les champs de formulaire en cas d'erreur.

Nous avons également ajouté un attribut `value` au champ de saisie du pseudo
pour conserver la valeur saisie par l'utilisateur si elle existe (grâce à la
fonction `isset()` qui vérifie si la variable `$username` est définie). Si elle
n'existe pas, nous laissons le champ vide. Cela permet à l'utilisateur de ne pas
avoir à ressaisir son pseudo s'il a déjà été saisi précédemment.

Nous ne souhaitons pas conserver le mot de passe pour des raisons de sécurité,
donc nous n'avons pas ajouté d'attribut `value` au champ de mot de passe.

Nous avons également ajouté une section PHP à la fin du fichier pour afficher le
résultat de la soumission du formulaire. Cela permet à l'utilisateur de voir les
données qu'il a saisies après avoir cliqué sur le bouton "Envoyer".

## Validation des formulaires

Lorsque l'utilisateur soumet un formulaire, il est important de valider les
données saisies pour s'assurer qu'elles sont correctes et conformes aux
attentes. La validation des formulaires peut être effectuée à la fois côté
server et côté client.

### Côté serveur

La validation côté serveur est essentielle pour garantir la sécurité et
l'intégrité des données.

La validation des formulaires peut inclure des vérifications telles que :

- Vérifier que les champs obligatoires sont remplis.
- Vérifier que les données saisies respectent un format spécifique (par exemple,
  une adresse e-mail valide ou longueur minimale, etc.).
- Etc.

Voici un exemple de validation côté serveur en PHP :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Par défaut, il n'y a pas d'erreurs
    $errors = [];

    // Validation des données
    if (empty($username)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le pseudo est obligatoire.");
    }

    if (strlen($username) < 2) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le pseudo doit contenir au moins 2 caractères.");
    }

    if (empty($password)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le mot de passe est obligatoire.");
    }

    if (strlen($password) < 8) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le mot de passe doit contenir au moins 8 caractères.");
    }
}
?>

<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Authentification</title>
</head>

<body>
    <h1>Se connecter</h1>
    <form action="login.php" method="POST">
        <label for="username">Pseudo :</label><br>
        <input
            type="text"
            id="username"
            name="username"
            value="<?php echo isset($username) ? $username : ''; ?>" />

        <br>

        <label for="password">Mot de passe :</label><br>
        <input
            type="password"
            id="password"
            name="password" />

        <br>

        <button type="submit">Envoyer</button>
    </form>

    <?php
    // On affiche les données si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // S'il n'y a pas d'erreurs, on affiche les données
        if (empty($errors)) {
            echo "<p style='color: green;'>Le nom d'utilisateur est : $username</p>";
            echo "<p style='color: green;'>Le mot de passe est : $password</p>";
        } else {
            // S'il y a des erreurs, on les affiche
            foreach ($errors as $error) {
                echo "<p style='color: red;'>$error<p>";
            }
        }
    }
    ?>
</body>

</html>
```

Dans cet exemple, nous avons ajouté une validation côté serveur pour vérifier
que les champs `username` et `password` ne sont pas vides et respectent
certaines contraintes de longueur.

Si les données ne sont pas valides, les messages d'erreurs associés sont ajoutés
à un tableau `$errors`.

Nous vérifions ensuite si le tableau `$errors` est vide. Si c'est le cas, cela
signifie que toutes les validations ont réussi et nous affichons les données
saisies par l'utilisateur dans une couleur verte.

Sinon, nous parcourons le tableau `$errors` et affichons chaque message d'erreur
dans une couleur rouge.

### Côté client

La validation côté client permet de fournir une validation et un retour immédiat
à l'utilisateur avant que les données ne soient envoyées au serveur. Cela peut
réduire le nombre de requêtes envoyées au serveur et améliorer l'expérience
utilisateur.

Pour cela, les champs de formulaire HTML peuvent être configurés avec des
attributs pour effectuer une validation de base.

Il existe plusieurs attributs HTML qui peuvent être utilisés pour valider les
données côté client, certaines spécifiques selon le type de champ. Ces attributs
sont décrits dans la documentation MDN présentée ci-dessus (section
[Attributs](#attributs)).

Voici un exemple de validation côté client à l'aide d'attributs HTML :

```php
<?php
// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Par défaut, il n'y a pas d'erreurs
    $errors = [];

    // Validation des données
    if (empty($username)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le pseudo est obligatoire.");
    }

    if (strlen($username) < 2) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le pseudo doit contenir au moins 2 caractères.");
    }

    if (empty($password)) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le mot de passe est obligatoire.");
    }

    if (strlen($password) < 8) {
        // On ajoute un message d'erreur au tableau
        array_push($errors, "Le mot de passe doit contenir au moins 8 caractères.");
    }
}
?>

<!-- Gère l'affichage du formulaire -->
<!DOCTYPE html>
<html>

<head>
    <title>Authentification</title>
</head>

<body>
    <h1>Se connecter</h1>
    <form action="login.php" method="POST">
        <label for="username">Pseudo :</label><br>
        <input
            type="text"
            id="username"
            name="username"
            value="<?php echo isset($username) ? $username : ''; ?>"
            required
            minlength="2" />

        <br>

        <label for="password">Mot de passe :</label><br>
        <input
            type="password"
            id="password"
            name="password"
            required
            minlength="8" />

        <br>

        <button type="submit">Envoyer</button>
    </form>

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
</body>

</html>
```

Dans cet exemple, nous avons ajouté les attributs `required` et `minlength` aux
champs de formulaire. L'attribut `required` indique que le champ est obligatoire
et doit être rempli avant la soumission du formulaire. L'attribut `minlength`
spécifie la longueur minimale requise pour le champ.

Lorsque l'utilisateur essaie de soumettre le formulaire sans remplir les champs
ou en saisissant des valeurs qui ne respectent pas les contraintes de longueur,
le navigateur affichera automatiquement un message d'erreur et empêchera la
soumission du formulaire.

Cela permet de fournir un retour immédiat à l'utilisateur sans avoir besoin
d'envoyer les données au serveur.

De plus, l'affichage de la soumission réussie ou des erreurs de validation a été
amélioré en ajoutant des messages de succès ou d'erreur après la soumission du
formulaire en mélangeant PHP et HTML.

Pour préserver la sécurité des données, les données soumises ne sont plus
affichées après la soumission du formulaire. Au lieu de cela, un message de
soumission réussie est affiché si le formulaire a été soumis avec succès.

> [!CAUTION]
>
> Il est important de noter que la validation côté client ne remplace pas la
> validation côté serveur.
>
> Il est toujours recommandé de valider les données côté serveur pour garantir
> la sécurité et l'intégrité des données, même si l'utilisateur a contourné la
> validation côté client.

## Conclusion

Dans cette session, nous avons exploré les formulaires HTML et la validation des
données saisies par les utilisateurs. Nous avons appris à créer des formulaires
HTML, à envoyer des données au serveur et à traiter ces données à l'aide de PHP.

Nous avons également abordé la validation des formulaires, tant côté serveur que
côté client grâce à l'utilisation d'attributs HTML.

En cas de validation échouée, nous avons vu comment afficher des messages
d'erreur clairs et comment conserver les valeurs saisies par l'utilisateur dans
le formulaire.

La validation est essentielle pour garantir la sécurité et l'intégrité des
données, ainsi que pour améliorer l'expérience utilisateur.

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
