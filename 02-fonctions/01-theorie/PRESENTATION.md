---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: L. Delafontaine, avec l'aide de GitHub Copilot
title: HEIG-VD ProgServ1 Course - Cours 02 - Fonctions
description: Cours 02 - Fonctions pour le cours ProgServ1 à la HEIG-VD, Suisse
url: https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/02-fonctions/01-theorie/index.html
header: "**Cours 02 - Fonctions**"
footer: "**HEIG-VD** - ProgServ1 Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
math: mathjax
-->

# Cours 02 - Fonctions

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

- Décrire ce qu'est une fonction en programmation
- Déclarer une fonction en PHP
- Appeler une fonction en PHP
- Passer des paramètres à une fonction en PHP
- Utiliser une valeur de retour
- Expliquer ce qu'est une portée de variable

![bg right:40%][illustration-objectifs]

## Objectifs (2/2)

- Utiliser des variables globales
- Savoir où les fonctions prédéfinies en PHP
- Utiliser des fonctions prédéfinies en PHP
- Réutiliser du code avec des fonctions

![bg right:40%][illustration-objectifs]

## Qu'est-ce qu'une fonction ? (1/2)

- Ensemble d'instructions pour effectuer une tâche spécifique
- Inspirée des fonctions mathématiques :
  - $f(x) = x^2$
  - où $x$ est un paramètre
  - $f(2) = 4$, $f(3) = 9$, etc.

![bg right:40%][illustration-quest-ce-quune-fonction]

## Qu'est-ce qu'une fonction ? (2/2)

- En programmation :
  - Définie par un nom
  - Peut accepter des paramètres
  - Peut retourner une valeur
- Permet de structurer le code
- Peut être réutilisé à plusieurs endroits

![bg right:40%][illustration-quest-ce-quune-fonction]

## Déclarer une fonction en PHP (1/2)

- En PHP, une fonction est déclarée avec le mot-clé `function`
- Suivi du nom de la fonction
- Suivi des paramètres entre parenthèses (`()`)
- Suivi du corps de la fonction entre accolades (`{}`)

![bg right:40%][illustration-declarer-une-fonction-en-php]

## Déclarer une fonction en PHP (2/2)

```php
<?php
function hello() {
    echo "Hello, world!<br>";
}
```

```java
// Équivalent en Java
public class Main {
    public static void hello() {
        System.out.println("Hello, world!");
    }
}
```

## Appeler une fonction en PHP (1/3)

- Pour appeler une fonction, il suffit d'écrire son nom suivi de parenthèses
  (`()`)
- Les paramètres peuvent être passés entre les parenthèses
- Une fonction peut être appelée plusieurs fois dans le code

![bg right:40%][illustration-appeler-une-fonction-en-php]

## Appeler une fonction en PHP (2/3)

```php
<?php
function hello() {
    echo "Hello, world!<br>";
}

hello(); // Affiche "Hello, world!"
hello(); // Affiche "Hello, world!"
hello(); // Affiche "Hello, world!"
```

## Appeler une fonction en PHP (3/3)

```java
// Équivalent en Java
public class Main {
    public static void hello() {
        System.out.println("Hello, world!");
    }

    public static void main(String[] args) {
        hello(); // Affiche "Hello, world!"
        hello(); // Affiche "Hello, world!"
        hello(); // Affiche "Hello, world!"
    }
}
```

## Passer des paramètres à une fonction (1/3)

- Une fonction peut accepter des paramètres
- Les paramètres sont des valeurs que la fonction peut utiliser pour effectuer
  une tâche
- Les paramètres sont déclarés entre les parenthèses de la fonction, séparés par
  des virgules (`,`)

![bg right:40%][illustration-passer-des-parametres-a-une-fonction]

## Passer des paramètres à une fonction (2/3)

```php
<?php
function hello($name) {
    echo "Hello, $name!<br>";
}

hello("Alice"); // Affiche "Hello, Alice!"
hello("Bob"); // Affiche "Hello, Bob!"
```

## Passer des paramètres à une fonction (3/3)

```java
public class Main {
    public static void hello(String name) {
        System.out.println("Hello, " + name + "!");
    }

    public static void main(String[] args) {
        hello("Alice"); // Affiche "Hello, Alice!"
        hello("Bob"); // Affiche "Hello, Bob!"
    }
}
```

## Retourner une valeur depuis une fonction (1/3)

- Une fonction peut retourner une valeur
- La valeur retournée peut être utilisée dans le code appelant (= le code qui
  appelle la fonction)
- La valeur retournée (unique) est définie avec le mot-clé `return`

![bg right:40%][illustration-retourner-une-valeur-depuis-une-fonction]

## Retourner une valeur depuis une fonction (2/3)

```php
<?php
function square($x) {
    return $x * $x;
}

$result = square(3);

echo $result; // Affiche 9
```

## Retourner une valeur depuis une fonction (3/3)

```java
// Équivalent en Java
public class Main {
    public static int square(int x) {
        return x * x;
    }

    public static void main(String[] args) {
        int result = square(3);

        System.out.println(result); // Affiche 9
    }
}
```

## Paramètres optionnels (1/2)

- En PHP, il est possible de définir des paramètres optionnels
- Les paramètres optionnels ont une valeur par défaut
- Les paramètres optionnels doivent être définis après les paramètres
  obligatoires

![bg right:40%][illustration-parametres-optionnels]

## Paramètres optionnels (2/2)

```php
<?php
function hello($name = "world") {
    echo "Hello, $name!<br>";
}

hello(); // Affiche "Hello, world!"
hello("Alice"); // Affiche "Hello, Alice!"
```

```java
// Équivalent en Java

// Il n'est pas possible de définir des paramètres optionnels en Java.
// Ceci est spécifique à PHP.
```

## Passer plusieurs paramètres à une fonction (1/3)

- Une fonction peut accepter plusieurs paramètres
- Les paramètres sont séparés par des virgules (`,`)
- Les paramètres sont passés dans le même ordre que leur déclaration

![bg right:40%][illustration-passer-plusieurs-parametres-a-une-fonction]

## Passer plusieurs paramètres à une fonction (2/3)

```php
<?php
function add($x, $y) {
    return $x + $y;
}

$result = add(3, 5);

echo $result; // Affiche 8
```

## Passer plusieurs paramètres à une fonction (3/3)

```java
// Équivalent en Java
public class Main {
    public static int add(int x, int y) {
        return x + y;
    }

    public static void main(String[] args) {
        int result = add(3, 5);

        System.out.println(result); // Affiche 8
    }
}
```

## Portée des variables (1/3)

- La portée d'une variable est l'endroit où elle peut être utilisée
- Une variable déclarée à l'intérieur d'une fonction ne peut être utilisée qu'à
  l'intérieur de cette fonction
- Une erreur survient si une variable est utilisée en dehors de sa portée

![bg right:40%][illustration-portee-des-variables]

## Portée des variables (2/3)

```php
<?php
function square($x) {
    return $x * $x;
}

echo $x; // Erreur : variable $x non définie
```

## Portée des variables (3/3)

```java
// Équivalent en Java
public class Main {
    public static int square(int x) {
        return x * x;
    }

    public static void main(String[] args) {
        System.out.println(x); // Erreur : variable x non définie
    }
}
```

## Variables globales (1/3)

- Une variable globale est une variable déclarée en dehors de toute fonction
- Une variable globale peut être utilisée à l'intérieur d'une fonction à l'aide
  du mot-clé `global`
- À éviter autant que possible, car cela rend le code difficile à comprendre et
  à maintenir

![bg right:40%][illustration-variables-globales]

## Variables globales (2/3)

```php
<?php
$x = 42;

function square() {
    global $x;

    $x = $x * $x;
}

square();

echo $x; // Affiche 1764
```

## Variables globales (3/3)

```java
// Équivalent en Java
public class Main {
    public static int x = 42;

    public static int square() {
        x = x * x;
    }

    public static void main(String[] args) {
        square();

        System.out.println(x); // Affiche 1764
    }
}
```

## Fonctions prédéfinies en PHP (1/3)

- PHP fournit de nombreuses fonctions prédéfinies
- Ces fonctions permettent de réaliser des tâches courantes
- La
  [documentation officielle de PHP](https://www.php.net/manual/fr/funcref.php)
  est une ressource précieuse pour trouver des fonctions prédéfinies

![bg right:40%][illustration-fonctions-predefinies-en-php]

## Fonctions prédéfinies en PHP (2/3)

```php
<?php
$length = strlen("Hello, world!");

echo $length; // Affiche 13
```

## Fonctions prédéfinies en PHP (3/3)

```java
// Équivalent en Java
public class Main {
    public static void main(String[] args) {
        String s = "Hello, world!";
        int length = s.length();

        System.out.println(length); // Affiche 13
    }
}
```

### Fonctions mathématiques (1/2)

- PHP propose de nombreuses fonctions mathématiques
- Par exemple, `abs`, `sqrt`, `pow`, `min`, `max`, etc.
- [Documentation complète](https://www.php.net/manual/fr/ref.math.php)
- Exemple : `sqrt`

![bg right:40%][illustration-fonctions-mathematiques]

### Fonctions mathématiques (2/2)

```php
<?php
$result = sqrt(16);

echo $result; // Affiche 4
```

```java
// Équivalent en Java
public class Main {
    public static void main(String[] args) {
        double result = Math.sqrt(16);
        System.out.println(result); // Affiche 4.0
    }
}
```

### Fonctions sur les chaînes de caractères (1/2)

- PHP propose de nombreuses fonctions pour manipuler des chaînes de caractères
- Par exemple, `strlen`, `substr`, `str_replace`, `strtolower`, `strtoupper`,
  etc.
- [Documentation complète](https://www.php.net/manual/fr/ref.strings.php)
- Exemple : `strupper`

![bg right:40%][illustration-fonctions-sur-les-chaines-de-caracteres]

### Fonctions sur les chaînes de caractères (2/2)

```php
$result = strtoupper("hello, world!");

echo $result; // Affiche "HELLO, WORLD!"
```

```java
// Équivalent en Java
public class Main {
    public static void main(String[] args) {
        String result = "hello, world!".toUpperCase();

        System.out.println(result); // Affiche "HELLO, WORLD!"
    }
}
```

### Fonctions sur les variables (1/3)

- PHP propose de nombreuses fonctions pour manipuler des variables
- Par exemple, `isset`, `empty`, `unset`, `is_array`, `is_string`, etc.
- [Documentation complète](https://www.php.net/manual/fr/ref.var.php)
- Exemple : `isset`

![bg right:40%][illustration-fonctions-sur-les-variables]

### Fonctions sur les variables (2/3)

```php
<?php
$var = 42;

if (isset($var)) {
    echo "The variable is defined.";
} else {
    echo "The variable is not defined.";
}

echo "<br>"; // Retour à la ligne HTML
```

---

```php
if (isset($undefined)) {
    echo "The variable is defined.";
} else {
    echo "The variable is not defined.";
}
```

### Fonctions sur les variables (3/3)

```java
// Équivalent en Java
public class Main {
    public static void main(String[] args) {
        int var = 42;

        if (var != null) {
            System.out.println("The variable is defined.");
        } else {
            System.out.println("The variable is not defined.");
        }

        System.out.println(); // Retour à la ligne
```

---

```java
        int undefined;

        if (undefined != null) {
            System.out.println("The variable is defined.");
        } else {
            System.out.println("The variable is not defined.");
        }
    }
}
```

## Réutiliser du code avec des fonctions (1/2)

- Les fonctions permettent de réutiliser du code
- Le code est plus facile à lire et à maintenir
- Il est possible d'importer des fonctions définies dans d'autres fichiers avec
  la directive `require`

![bg right:40%][illustration-reutiliser-du-code-avec-des-fonctions]

## Réutiliser du code avec des fonctions (2/2)

```php
<?php
// Fichier `functions.php`
function hello($name) {
    echo "Hello, $name!<br>";
}
```

```php
<?php
// Fichier `index.php`
require "functions.php"; // On inclut le fichier

// La fonction `hello` est définie dans le fichier importé
// et peut être utilisée ici
hello("Alice");
```

### Différence entre `include` et `require`

- Il est possible d'importer des fichiers avec `include` et `require`
- `include` : si le fichier n'est pas trouvé, un avertissement est émis
- `require` : si le fichier n'est pas trouvé, une erreur fatale est émise
- Nous conseillons de toujours utiliser `require`

![bg right:40%][illustration-difference-entre-include-et-require]

## Conclusion

- Les fonctions permettent de structurer et réutiliser du code
- Les fonctions peuvent accepter des paramètres et retourner des valeurs
- Fonctions personnelles ou des fonctions prédéfinies
- La portée des variables est importante à comprendre

![bg right:40%][illustration-principale]

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer

- (Re)lire le [support de cours][course-material].
- Réaliser le [mini-projet][mini-project].
- Faire les [exercices][exercices].
- Poser des questions si nécessaire.

\
**Pour le mini-projet ou les exercices, n'hésitez pas à vous entraidez si vous avez des difficultés !**

![bg right:40%][illustration-a-vous-de-jouer]

## Sources (1/3)

- [Illustration principale][illustration-principale] par
  [Richard Jacobs](https://unsplash.com/@rj2747) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-elephants-drinking-water-8oenpCXktqQ)
- [Illustration][illustration-objectifs] par
  [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  [Unsplash](https://unsplash.com/photos/j6brni7fpvs)
- [Illustration][illustration-quest-ce-quune-fonction] par
  [Birmingham Museums Trust](https://unsplash.com/@birminghammuseumstrust) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-people-in-a-street-y3TC9H0261s)
- [Illustration][illustration-declarer-une-fonction-en-php] par
  [Aaron Burden](https://unsplash.com/@aaronburden) sur
  [Unsplash](https://unsplash.com/photos/fountain-pen-on-black-lined-paper-y02jEX_B0O0)
- [Illustration][illustration-appeler-une-fonction-en-php] par
  [Alexander Andrews](https://unsplash.com/@alex_andrews) sur
  [Unsplash](https://unsplash.com/photos/black-corded-telephone-JYGnB9gTCls)
- [Illustration][illustration-passer-des-parametres-a-une-fonction] par
  [Diane Picchiottino](https://unsplash.com/@diane_soko) sur
  [Unsplash](https://unsplash.com/photos/white-and-black-chess-board-itHFvqW09yM)
- [Illustration][illustration-retourner-une-valeur-depuis-une-fonction] par
  [Mika Baumeister](https://unsplash.com/@kommumikation) sur
  [Unsplash](https://unsplash.com/photos/red-and-white-stop-sign-WOn90Iui_08)
- [Illustration][illustration-parametres-optionnels] par
  [Florian Schmetz](https://unsplash.com/@floschmaezz) sur
  [Unsplash](https://unsplash.com/photos/white-and-black-i-love-you-print-on-brick-wall-LPckxbrqE5w)

## Sources (2/3)

- [Illustration][illustration-passer-plusieurs-parametres-a-une-fonction] par
  [Eric Prouzet](https://unsplash.com/@eprouzet) sur
  [Unsplash](https://unsplash.com/photos/assorted-color-mugs-on-rack-5lUMTeo7-bE)
- [Illustration][illustration-portee-des-variables] par
  [Daniel Christie](https://unsplash.com/@daniel_christie97) sur
  [Unsplash](https://unsplash.com/photos/a-close-up-of-a-telescope-with-the-sun-in-the-background-MQTQBREtUxE)
- [Illustration][illustration-variables-globales] par
  [NASA](https://unsplash.com/@nasa) sur
  [Unsplash](https://unsplash.com/photos/photo-of-outer-space-Q1p7bh3SHj8)
- [Illustration][illustration-fonctions-predefinies-en-php] par
  [Jeriden Villegas](https://unsplash.com/@jeriden94) sur
  [Unsplash](https://unsplash.com/photos/man-in-blue-denim-jeans-and-blue-denim-jacket-standing-on-orange-metal-bar-during-daytime-niSnhfMjiMI)
- [Illustration][illustration-fonctions-mathematiques] par
  [Thomas T](https://unsplash.com/@pyssling240) sur
  [Unsplash](https://unsplash.com/photos/a-blackboard-with-a-lot-of-writing-on-it-OPpCbAAKWv8)
- [Illustration][illustration-fonctions-sur-les-chaines-de-caracteres] par
  [Kier in Sight Archives](https://unsplash.com/@kierinsightarchives) sur
  [Unsplash](https://unsplash.com/photos/white-and-black-abstract-illustration-qXA4b_dZSbQ)
- [Illustration][illustration-fonctions-sur-les-variables] par
  [Jan Huber](https://unsplash.com/@jan_huber) sur
  [Unsplash](https://unsplash.com/photos/yellow-and-red-light-streaks-NjV34SrbM_g)
- [Illustration][illustration-reutiliser-du-code-avec-des-fonctions] par
  [Jack Church](https://unsplash.com/@jackchurch) sur
  [Unsplash](https://unsplash.com/photos/a-sign-on-the-side-of-a-building-advertising-giving-back-LZ8NzZrByts)

## Sources (3/3)

- [Illustration][illustration-difference-entre-include-et-require] par
  [Clay Banks](https://unsplash.com/@claybanks) sur
  [Unsplash](https://unsplash.com/photos/five-human-hands-on-brown-surface-LjqARJaJotc)
- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

<!-- URLs -->

[presentation-web]:
	https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/02-fonctions/01-theorie/index.html
[presentation-pdf]:
	https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/02-fonctions/01-theorie/02-fonctions-presentation.pdf
[course-material]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/02-fonctions/01-theorie/README.md
[license]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/LICENSE.md
[mini-project]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/02-fonctions/02-mini-project/README.md
[exercices]:
	https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course/blob/main/02-fonctions/03-exercices/README.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-quest-ce-quune-fonction]:
	https://images.unsplash.com/photo-1583737097406-5a4b42b37b97?fit=crop&h=720
[illustration-declarer-une-fonction-en-php]:
	https://images.unsplash.com/photo-1455390582262-044cdead277a?fit=crop&h=720
[illustration-appeler-une-fonction-en-php]:
	https://images.unsplash.com/photo-1523966211575-eb4a01e7dd51?fit=crop&h=720
[illustration-passer-des-parametres-a-une-fonction]:
	https://images.unsplash.com/photo-1629706168156-d2d0558c972e?fit=crop&h=720
[illustration-retourner-une-valeur-depuis-une-fonction]:
	https://images.unsplash.com/photo-1605882174146-a464b70cf691?fit=crop&h=720
[illustration-parametres-optionnels]:
	https://images.unsplash.com/photo-1619344501177-cb47c4a94c59?fit=crop&h=720
[illustration-passer-plusieurs-parametres-a-une-fonction]:
	https://images.unsplash.com/photo-1563696629964-8c3ce077cf3e?fit=crop&h=720
[illustration-portee-des-variables]:
	https://images.unsplash.com/photo-1541548861402-1cea6405a59a?fit=crop&h=720
[illustration-variables-globales]:
	https://images.unsplash.com/photo-1451187580459-43490279c0fa?fit=crop&h=720
[illustration-fonctions-predefinies-en-php]:
	https://images.unsplash.com/photo-1593313637552-29c2c0dacd35?fit=crop&h=720
[illustration-fonctions-mathematiques]:
	https://images.unsplash.com/photo-1635372722656-389f87a941b7?fit=crop&h=720
[illustration-fonctions-sur-les-chaines-de-caracteres]:
	https://images.unsplash.com/photo-1622321786092-a3df1d448be1?fit=crop&h=720
[illustration-fonctions-sur-les-variables]:
	https://images.unsplash.com/photo-1604012164853-9bb541fe0296?fit=crop&h=720
[illustration-reutiliser-du-code-avec-des-fonctions]:
	https://images.unsplash.com/photo-1620429405088-b41981579f19?fit=crop&h=720
[illustration-difference-entre-include-et-require]:
	https://images.unsplash.com/photo-1556484687-30636164638b?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
