# Cours 08 - Récapitulatif de l'unité d'enseignement avec préparation à l'examen et finalisation de l'application - Mini-projet

Ce mini-projet est conçu pour vous permettre de mettre en pratique les concepts
théoriques vus dans le cours
_[Cours 08 - Récapitulatif de l'unité d'enseignement avec préparation à l'examen et finalisation de l'application](../01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/README.md)_.

## Ressources

- Récapitulatif de l'unité d'enseignement :
  [Support de cours](../01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/README.md)
  ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/08-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen-et-finalisation-de-lapplication/01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/08-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen-et-finalisation-de-lapplication/01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/08-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen-et-finalisation-de-lapplication-presentation.pdf)
  ·
  [Feedback](../01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/feedback/README.md)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Examen blanc : [Énoncé](../03-examen-blanc/README.md)

## Table des matières

- [Ressources](#ressources)
- [Table des matières](#table-des-matières)
- [Objectifs de la session](#objectifs-de-la-session)
- [Utilisation de la librairie Pico CSS](#utilisation-de-la-librairie-pico-css)
  - [Suppression des styles CSS existants](#suppression-des-styles-css-existants)
  - [Ajout de la librairie Pico CSS](#ajout-de-la-librairie-pico-css)
  - [Suppression des retours à la ligne inutiles](#suppression-des-retours-à-la-ligne-inutiles)
- [Uniformisation des boutons dans les formulaires à l'aide de classes CSS personnalisées](#uniformisation-des-boutons-dans-les-formulaires-à-laide-de-classes-css-personnalisées)
  - [Création du fichier CSS personnalisé](#création-du-fichier-css-personnalisé)
  - [Inclusion du fichier CSS personnalisé dans les pages](#inclusion-du-fichier-css-personnalisé-dans-les-pages)
- [Utilisation des constantes définies dans la classe `Pet` pour générer les valeurs des champs de formulaire](#utilisation-des-constantes-définies-dans-la-classe-pet-pour-générer-les-valeurs-des-champs-de-formulaire)
  - [Champ de formulaire pour les espèces des animaux](#champ-de-formulaire-pour-les-espèces-des-animaux)
  - [Champ de formulaire pour les sexes des animaux](#champ-de-formulaire-pour-les-sexes-des-animaux)
  - [Champ de formulaire pour les personnalités des animaux](#champ-de-formulaire-pour-les-personnalités-des-animaux)
- [Ajout d'un logo pour l'application](#ajout-dun-logo-pour-lapplication)
- [Validation du bon fonctionnement de l'application](#validation-du-bon-fonctionnement-de-lapplication)
- [Solution](#solution)
- [Conclusion](#conclusion)
- [Aller plus loin](#aller-plus-loin)
- [Sources](#sources)

## Objectifs de la session

> [!NOTE]
>
> Ce mini-projet est facultatif ! Il n'est pas nécessaire de le réaliser pour
> réussir l'examen final. Il n'a que pour but d'améliorer le mini-projet avec
> quelques fonctionnalités supplémentaires (styles CSS, amélioration du code,
> etc.).

De façon plus concise, les personnes qui étudient devraient avoir pu :

- Utiliser la librairie [Pico CSS](https://picocss.com/) pour styliser
  l'application
- Utiliser les constantes définies dans la classe `Pet` pour générer les valeurs
  des champs de formulaire
- Ajout d'un logo pour l'application

> [!NOTE]
>
> Ce mini-projet est facultatif ! Il n'est pas nécessaire de le réaliser pour
> réussir l'examen final. Il n'a que pour but d'améliorer le mini-projet avec
> quelques fonctionnalités supplémentaires (styles CSS, amélioration du code,
> etc.).

## Utilisation de la librairie Pico CSS

[Pico CSS](https://picocss.com/) est une librairie CSS légère et moderne qui
permet de styliser facilement les applications web. Pour l'utiliser dans ce
mini-projet, vous devez inclure le fichier CSS de Pico dans votre projet.

### Suppression des styles CSS existants

Avant d'ajouter Pico CSS, il est recommandé de supprimer les styles CSS
existants pour éviter les conflits. Vous pouvez le faire en supprimant ou en
commentant les lignes de code CSS dans toutes les pages publiques de votre
projet qui utilisent des styles CSS personnalisés:

- `public/index.php`
- `public/create.php`
- `public/edit.php`
- `public/view.php`

#### Page `public/index.php`

Supprimez ou commentez les lignes de code CSS dans la section `<head>` de la
page `public/index.php` :

```php
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
```

#### Pages `public/create.php`, `public/edit.php` et `public/view.php`

Supprimez ou commentez les lignes de code CSS dans la section `<head>` des pages
`public/create.php`, `public/edit.php` et `public/view.php` :

```php
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
```

### Ajout de la librairie Pico CSS

Pour ajouter la librairie Pico CSS, vous devez inclure le fichier CSS de Pico et
modifier la structure HTML de vos pages pour qu'elles soient compatibles avec
Pico CSS.

Vous pouvez le faire en ajoutant les lignes suivantes dans la section `<head>`
de chaque page publique de votre projet. Ces lignes sont décrites dans la
documentation de Pico CSS.

> [!TIP]
>
> La plupart des librairies que vous pourriez utiliser dans vos projets
> proposent une documentation en ligne. Vous pouvez généralement trouver des
> instructions sur la façon d'installer et d'utiliser ces librairies.
>
> Lire de la documentation est une compétence essentielle pour toute personne
> qui développe. Cela vous permet de comprendre comment utiliser les outils et
> bibliothèques disponibles, et de tirer le meilleur parti de ces ressources.

#### Page `public/index.php`

Ajoutez les lignes suivantes dans la section `<head>` de la page
`public/index.php` :

```php
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <title>Page d'accueil | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <main class="container">
      <!-- Contenu initial de la balise `<body></body>` -->
      <!-- ... -->
    </main>
</body>
```

#### Page `public/create.php`

Ajoutez les lignes suivantes dans la section `<head>` de la page
`public/create.php` :

```php
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <main class="container">
      <!-- Contenu initial de la balise `<body></body>` -->
      <!-- ... -->
    </main>
</body>
```

#### Page `public/edit.php`

Ajoutez les lignes suivantes dans la section `<head>` de la page
`public/edit.php` :

```php
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <title>Modifie un animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <main class="container">
      <!-- Contenu initial de la balise `<body></body>` -->
      <!-- ... -->
    </main>
</body>
```

#### Page `public/view.php`

Ajoutez les lignes suivantes dans la section `<head>` de la page
`public/view.php` :

```php
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <title>Visualise et modifie un animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <main class="container">
      <!-- Contenu initial de la balise `<body></body>` -->
      <!-- ... -->
    </main>
</body>
```

### Suppression des retours à la ligne inutiles

Pour améliorer l'apparence de votre application, vous pouvez également supprimer
les retours à la ligne inutiles `<br>` dans les fichiers `public/index.php`,
`public/create.php`, `public/edit.php` et `public/view.php`.

Ceux-ci étaient utilisés pour espacer les éléments, mais avec Pico CSS, ces
espacements sont gérés par les styles CSS. Vous pouvez donc supprimer les lignes
suivantes dans chaque fichier à l'aide d'un rechercher/remplacer :

```php
<br>
```

## Uniformisation des boutons dans les formulaires à l'aide de classes CSS personnalisées

Peut-être remarquez-vous que les boutons des formulaires ne sont pas uniformes.

En effet, les boutons de la page `public/edit.php` ne prennent pas tous la même
largeur. Par défaut, Pico CSS ne met que les boutons de type `submit` en largeur
pleine.

Pour uniformiser les boutons, nous allons ajouter une classe CSS personnalisée
dans un fichier dédié.

### Création du fichier CSS personnalisé

Pour ajouter une classe CSS personnalisée qui permet de rendre tous les boutons
de formulaire de l'application à la largeur totale de leur conteneur, vous devez
créer un fichier CSS personnalisé dans le dossier `public/css` de votre
application. Ce fichier sera chargé après la librairie Pico CSS, ce qui
permettra de surcharger les styles par défaut de Pico CSS.

Vous pouvez nommer ce fichier `custom.css` ou un autre nom de votre choix.

Créez un fichier `public/css/custom.css` et ajoutez-y le code suivant :

```css
/* Tous les boutons de formulaire prennent la largeur totale de leur conteneur */
form button {
	width: 100%;
}
```

Ce code CSS permet de rendre tous les boutons de formulaire à la largeur totale
de leur conteneur, ce qui permet d'uniformiser l'apparence des boutons dans
toutes les pages de l'application.

Tout bouton de formulaire dans l'application qui utilise la balise `<button>` ou
l'attribut `type="submit"` sera affecté par cette règle CSS. Cela inclut les
boutons de la page `public/edit.php`, ainsi que ceux des autres pages comme
`public/create.php` et `public/view.php`.

### Inclusion du fichier CSS personnalisé dans les pages

Pour inclure ce fichier CSS personnalisé dans vos pages, vous devez ajouter une
ligne dans la section `<head>` de chaque page publique de votre application.

Vous pouvez le faire en ajoutant la ligne suivante après l'inclusion de la
librairie Pico CSS :

```php
    <link rel="stylesheet" href="css/custom.css">
```

Vous devez donc modifier la section `<head>` de chaque page publique de votre
application pour inclure le fichier CSS personnalisé. Voici un exemple pour la
page `public/index.php` :

```php
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <title>Page d'accueil | Gestionnaire d'animaux de compagnie</title>
</head>
```

Vos boutons de formulaire devraient maintenant être uniformisés et prendre la
largeur totale de leur conteneur.

Vous pourriez réutiliser ce fichier CSS personnalisé pour ajouter d'autres
styles CSS personnalisés à votre application, si vous le souhaitez.

## Utilisation des constantes définies dans la classe `Pet` pour générer les valeurs des champs de formulaire

Dans le mini-projet, vous avez peut-être remarqué que les valeurs des champs de
formulaire pour les types d'animaux, les couleurs et les tailles sont
actuellement définies en dur dans les fichiers `public/create.php` et
`public/edit.php`. Pour rendre le code plus maintenable et éviter la
duplication, vous pouvez utiliser les constantes définies dans la classe `Pet`
pour générer les valeurs de ces champs de formulaire.

Pour ce faire, vous pouvez remplacer les valeurs en dur par les constantes
correspondantes de la classe `Pet`.

### Champ de formulaire pour les espèces des animaux

Notre classe `Pet` définit la constante suivante pour les espèces des animaux, à
l'aide d'un tableau associatif :

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
```

Vous pouvez utiliser cette constante pour générer les options du champ de
sélection pour les espèces des animaux dans les pages `public/create.php`,
`public/edit.php` et `public/view.php`.

Cela permet de centraliser la définition des espèces dans la classe `Pet`, ce
qui facilite la maintenance du code. Si vous souhaitez ajouter ou modifier une
espèce, vous n'avez qu'à modifier la constante `SPECIES` dans la classe `Pet`,
et les modifications seront répercutées dans toutes les pages qui utilisent
cette constante.

Remplacez le code HTML du champ de sélection pour les espèces des animaux par le
code suivant dans les pages `public/create.php` et `public/edit.php` :

```php
            <label for="species">Espèce :</label>
            <select id="species" name="species" required>
                <?php foreach (Pet::SPECIES as $key => $value) { ?>
                    <option value="<?= $key ?>" <?php if (isset($species) && $species == $key) echo "selected"; ?>><?= $value ?></option>
                <?php } ?>
            </select>
```

Replacez également le code HTML du champ de sélection pour les espèces des
animaux par le code suivant dans la page `public/view.php` :

```php
            <label for="species">Espèce :</label>
            <select id="species" disabled>
                <?php foreach (Pet::SPECIES as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= $pet["species"] == $key ? "selected" : "" ?>><?= $value ?></option>
                <?php } ?>
            </select>
```

La boucle `foreach` parcourt les constantes définies dans la classe `Pet` et
génère les options du champ de sélection pour les espèces des animaux. La valeur
de chaque option est la clé du tableau associatif, et le texte affiché est la
valeur correspondante. Si une espèce est déjà sélectionnée (par exemple, lors de
l'édition d'un animal ou lors d'une erreur de validation), l'attribut `selected`
est ajouté à l'option correspondante pour la pré-sélectionner.

### Champ de formulaire pour les sexes des animaux

De la même manière, vous pouvez utiliser la constante `SEXES` définie dans la
classe `Pet` pour générer les options du champ de sélection pour les sexes des
animaux dans les pages `public/create.php`, `public/edit.php` et
`public/view.php`.

La constante `SEXES` est définie comme suit dans la classe `Pet` :

```php
    const SEXES = [
        'male' => 'Mâle',
        'female' => 'Femelle'
    ];
```

Remplacez le code HTML du champ de sélection du sexe des animaux par le code
suivant dans les pages `public/create.php` et `public/edit.php` :

```php
            <fieldset>
                <legend>Sexe :</legend>

                <?php foreach (Pet::SEXES as $key => $value) { ?>
                    <input type="radio" id="<?= $key ?>" name="sex" value="<?= $key ?>" <?php echo (isset($sex) && $sex == $key) ? 'checked' : ''; ?> required />
                    <label for="<?= $key ?>"><?= $value ?></label>
                <?php } ?>
            </fieldset>
```

Remplacez également le code HTML du champ de sélection du sexe des animaux par
le code suivant dans la page `public/view.php` :

```php
            <fieldset>
                <legend>Sexe :</legend>

                <?php foreach (Pet::SEXES as $key => $value) { ?>
                    <input type="radio" id="<?= $key ?>" <?= $pet["sex"] == $key ? "checked" : "" ?> disabled />
                    <label for="<?= $key ?>"><?= $value ?></label>
                <?php } ?>
            </fieldset>
```

Cette boucle `foreach` parcourt les constantes définies dans la classe `Pet` et
génère les boutons radio pour les sexes des animaux. La valeur de chaque bouton
radio est la clé du tableau associatif, et le texte affiché est la valeur
correspondante. Si un sexe est déjà sélectionné (par exemple, lors de l'édition
d'un animal ou lors d'une erreur de validation), l'attribut `checked` est ajouté
au bouton radio correspondant pour le pré-sélectionner.

### Champ de formulaire pour les personnalités des animaux

Finalisons le mini-projet en ajoutant un champ de formulaire pour les
personnalités des animaux.

Pour cela, nous allons ajouter une constante `PERSONALITIES` dans la classe
`Pet`, qui contiendra les personnalités possibles des animaux. Vous pouvez
ajouter cette constante dans la classe `Pet` comme suit :

```php
    const PERSONALITIES = [
        'gentil' => 'Gentil',
        'playful' => 'Joueur',
        'curious' => 'Curieux',
        'lazy' => 'Paresseux',
        'scared' => 'Peureux',
        'aggressive' => 'Agressif'
    ];
```

Ensuite, vous pouvez mettre à jour le champ de sélection pour les personnalités
des animaux dans les pages `public/create.php` et `public/edit.php` en utilisant
cette constante. Remplacez le code HTML du champ de sélection pour les
personnalités des animaux par le code suivant dans les pages `public/create.php`
et `public/edit.php` :

```php
            <fieldset>
                <legend>Personnalité :</legend>

                <?php foreach (Pet::PERSONALITIES as $key => $value) { ?>
                    <div>
                        <input type="checkbox" id="<?= $key ?>" name="personalities[]" value="<?= $key ?>" <?= (!empty($personalities) && in_array($key, $personalities)) ? 'checked' : ''; ?> />
                        <label for="<?= $key ?>"><?= $value ?></label>
                    </div>
                <?php } ?>
            </fieldset>
```

Remplacez également le code HTML du champ de sélection pour les personnalités
des animaux par le code suivant dans la page `public/view.php` :

```php
            <fieldset>
                <legend>Personnalité :</legend>

                <?php foreach (Pet::PERSONALITIES as $key => $value) { ?>
                    <div>
                        <input type="checkbox" id="<?= $key ?>" <?= !empty($pet["personalities"]) && in_array($key, $pet["personalities"]) ? "checked" : "" ?> disabled />
                        <label for="<?= $key ?>"><?= $value ?></label>
                    </div>
                <?php } ?>
            </fieldset>
```

Cette boucle `foreach` parcourt les constantes définies dans la classe `Pet` et
génère les cases à cocher pour les personnalités des animaux. La valeur de
chaque case à cocher est la clé du tableau associatif, et le texte affiché est
la valeur correspondante. Si une personnalité est déjà sélectionnée (par
exemple, lors de l'édition d'un animal ou lors d'une erreur de validation),
l'attribut `checked` est ajouté à la case à cocher correspondante pour la
pré-sélectionner.

## Ajout d'un logo pour l'application

Pour finaliser le mini-projet, vous pouvez également ajouter un logo pour
l'application. Vous pouvez utiliser n'importe quel logo de votre choix, mais
pour cet exemple, nous allons utiliser un logo fictif.

Pour ajouter un logo, vous pouvez créer un fichier image dans le dossier
`public` de votre application. Par exemple, vous pouvez créer un fichier
`logo.svg` dans le dossier `public/images`.

Nous allons utiliser un logo SVG pour cet exemple, mais vous pouvez utiliser
n'importe quel format d'image (PNG, JPEG, etc.) que vous préférez : [Logo
SVG][illustration-logo-svg].

Ensuite, vous pouvez ajouter le logo dans la page `public/index.php` en
l'insérant au-dessus du titre de la page. Voici comment vous pouvez le faire :

```php
        <div class="logo">
            <img src="images/logo.svg" alt="Logo du gestionnaire d'animaux de compagnie">
        </div>
```

Puis, vous pouvez ajouter un peu de style CSS pour centrer le logo et l'adapter
à la taille de l'écran. Vous pouvez ajouter le code CSS suivant dans le fichier
`public/css/custom.css` que vous avez créé précédemment :

```css
/* Classe personnalisée pour le logo */
.logo {
	margin-top: 50px;
	margin-bottom: 50px;
	margin-left: auto;
	margin-right: auto;
	width: 200px;
	padding: 40px;
	border-radius: 100%;
	background-color: #0172ad;
}
```

Rafraîchissez la page `public/index.php` dans votre navigateur pour voir le logo
ajouté à l'application. Le logo devrait maintenant être centré et s'afficher
correctement au-dessus du titre de la page.

## Validation du bon fonctionnement de l'application

Après avoir effectué toutes les modifications ci-dessus, vous devriez pouvoir
tester votre application.

Non seulement, l'aspect de l'application devrait être amélioré grâce à la
librairie Pico CSS et les classes personnalisées, mais les champs de formulaire
pour les espèces, les sexes et les personnalités des animaux devraient
maintenant être générés dynamiquement à partir des constantes définies dans la
classe `Pet`.

Vous devriez pouvoir créer et modifier des animaux de compagnie en utilisant les
constantes définies dans la classe `Pet`, et les valeurs des champs de
formulaire devraient être générées dynamiquement à partir de ces constantes. Si
vous modifiez les constantes dans la classe `Pet`, les modifications devraient
être répercutées dans toutes les pages qui utilisent ces constantes.

## Solution

Vous pouvez trouver la solution du mini-projet PHP à l'adresse suivante :
[`solution`](./solution/).

## Conclusion

Dans ce dernier mini-projet, vous avez pu améliorer l'application en utilisant
la librairie Pico CSS pour styliser l'application, en uniformisant les boutons
dans les formulaires à l'aide de classes CSS personnalisées, et en utilisant les
constantes définies dans la classe `Pet` pour générer les valeurs des champs de
formulaire.

Vous avez également pu valider le bon fonctionnement de l'application en testant
les différentes fonctionnalités et en vous assurant que les champs de formulaire
étaient générés dynamiquement à partir des constantes définies dans la classe
`Pet`.

Vous avez maintenant une application de gestion d'animaux de compagnie
fonctionnelle et stylisée, prête à être utilisée ! Bravo pour votre travail et
vos efforts tout au long de cette unité d'enseignement !

## Aller plus loin

_Ceci est une section optionnelle pour les personnes qui souhaitent aller plus
loin. Vous pouvez la sauter si vous n'avez pas de temps._

- Êtes-vous capable de styliser l'application en utilisant une autre librairie
  CSS, comme [Bootstrap](https://getbootstrap.com/) ou
  [Tailwind CSS](https://tailwindcss.com/) ?
- Êtes-vous capable d'ajouter des fonctionnalités supplémentaires à
  l'application, comme la possibilité de filtrer les animaux par espèce ou par
  sexe ?

## Sources

- [Illustration][illustration-logo-svg] par
  [The Creative Idea](https://unsplash.com/@thecreativeidea) sur
  [Unsplash](https://unsplash.com/illustrations/a-brown-and-white-dog-sitting-down-with-its-tongue-out-ygsmi5ushr0)

<!-- URLs -->

[illustration-logo-svg]:
	https://unsplash.com/photos/ygsmi5ushr0/download?ixid=M3wxMjA3fDB8MXxhbGx8fHx8fHx8fHwxNzQ5MDM5ODM3fA&force=true&fm=svg
