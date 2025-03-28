# Cours 03 - Tableaux et boucles

## Ressources

- Théorie : [Support de cours](../01-theorie/README.md) ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/03-tableaux-et-boucles/01-theorie/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/03-tableaux-et-boucles/01-theorie/03-tableaux-et-boucles-presentation.pdf)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Exercices : [Énoncés et solutions](../03-exercices/README.md)

## Tables des matières

- [Ressources](#ressources)
- [Tables des matières](#tables-des-matières)
- [Objectifs](#objectifs)
- [Les tableaux](#les-tableaux)
  - [Tableaux indexés](#tableaux-indexés)
  - [Tableaux associatifs](#tableaux-associatifs)
  - [Tableaux multidimensionnels](#tableaux-multidimensionnels)
- [Les boucles](#les-boucles)
  - [Boucle `for`](#boucle-for)
  - [Boucle `while`](#boucle-while)
  - [Boucle `do...while`](#boucle-dowhile)
  - [Boucle `foreach`](#boucle-foreach)
- [Fonctions utiles pour les tableaux et les boucles](#fonctions-utiles-pour-les-tableaux-et-les-boucles)
  - [Fonctions `print()` et `print_r()`](#fonctions-print-et-print_r)
  - [Fonction `count()`](#fonction-count)
  - [Fonction `array_push()`](#fonction-array_push)
- [Conclusion](#conclusion)
- [Mini-projet](#mini-projet)
- [Exercices](#exercices)

## Objectifs

TODO

De façon plus précise, les objectifs de ce cours sont les suivants :

- TODO

## Les tableaux

Un tableau est une structure de données qui permet de stocker plusieurs valeurs
dans une seule variable. Les tableaux sont très utiles pour stocker des
collections de données, comme une liste de noms, une liste de nombres, etc.

Il existe plusieurs types de tableaux en PHP :

- Les tableaux indexés
- Les tableaux associatifs
- Les tableaux multidimensionnels

Chaque type de tableau a ses propres caractéristiques et peut être utilisé pour
différents types de données.

### Tableaux indexés

Un tableau indexé est un tableau qui stocke des valeurs dans un ordre séquentiel
et utilise des indices numériques pour accéder à ces valeurs. Voici un exemple
de tableau indexé :

```php
<?php
$fruits = ['apple', 'banana', 'orange', 'kiwi'];

echo $fruits[0]; // Affiche 'apple'
echo $fruits[1]; // Affiche 'banana'
echo $fruits[2]; // Affiche 'orange'
echo $fruits[3]; // Affiche 'kiwi'
```

Dans cet exemple, nous avons un tableau `$fruits` qui contient plusieurs fruits.

Chaque fruit est stocké à un index numérique, qui commence à 0 pour le premier
élément du tableau. Pour accéder à un élément du tableau, nous utilisons son
index entre crochets (`[]`).

Comme PHP est un langage de programmation dynamique, les tableaux indexés
peuvent contenir des valeurs de différents types, comme des chaînes de
caractères, des nombres, des booléens, etc., comme le montre l'exemple suivant :

```php
<?php
$mixed = ['apple', 123, true, 3.14];

echo $mixed[0]; // Affiche 'apple'
echo $mixed[1]; // Affiche 123
echo $mixed[2]; // Affiche true
echo $mixed[3]; // Affiche 3.14
```

### Tableaux associatifs

Un tableau associatif est un tableau qui stocke des valeurs en utilisant des
clés (ou des noms) pour accéder à ces valeurs. Voici un exemple de tableau
associatif :

```php
<?php
$person = [
    'name' => 'John Doe',
    'age' => 30,
    'city' => 'New York',
];

echo $person['name']; // Affiche 'John Doe'
echo $person['age']; // Affiche 30
echo $person['city']; // Affiche 'New York'
```

Dans cet exemple, nous avons un tableau `$person` qui contient des informations
sur une personne.

Chaque information est stockée avec une clé (ou un nom) qui permet d'accéder à
cette information. Pour accéder à une information du tableau, nous utilisons sa
clé entre crochets (`[]`).

Les tableaux associatifs sont très utiles pour stocker des données structurées
et pour accéder à ces données de manière plus intuitive.

D'autres langages de programmation utilisent des structures de données
similaires pour stocker des collections de données, comme les objets en
JavaScript, les dictionnaires en Python ou les maps en Java.

### Tableaux multidimensionnels

Un tableau multidimensionnel est un tableau qui contient d'autres tableaux à
l'intérieur. Ces tableaux peuvent être indexés, associatifs ou même
multidimensionnels. Voici un exemple de tableau multidimensionnel :

```php
<?php
$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
];

echo $matrix[0][0]; // Affiche 1
echo $matrix[1][1]; // Affiche 5
echo $matrix[2][2]; // Affiche 9
```

Dans cet exemple, nous avons un tableau `$matrix` qui contient d'autres tableaux
à l'intérieur. Chaque tableau interne est un tableau indexé qui stocke des
nombres.

Pour accéder à un élément du tableau multidimensionnel, nous utilisons deux
indices : le premier pour accéder au tableau interne et le deuxième pour accéder
à l'élément du tableau interne.

Les tableaux multidimensionnels sont très utiles pour stocker des données
complexes, comme des matrices, des tableaux de bord, des arbres ou encore des
listes d'animaux (😉).

Un autre exemple de tableau multidimensionnel est un tableau associatif de
tableaux associatifs :

```php
<?php
$users = [
    'john' => [
        'name' => 'John Doe',
        'age' => 30,
        'city' => 'New York',
    ],
    'jane' => [
        'name' => 'Jane Doe',
        'age' => 25,
        'city' => 'Los Angeles',
    ],
];

echo $users['john']['name']; // Affiche 'John Doe'
echo $users['jane']['age']; // Affiche 25
echo $users['john']['city']; // Affiche 'New York'
```

Dans cet exemple, nous avons un tableau `$users` qui contient des informations
sur plusieurs utilisateurs. Chaque utilisateur est stocké dans un tableau
associatif avec une clé (ou un nom) qui permet d'accéder à ses informations.

## Les boucles

PHP propose plusieurs types de boucles pour parcourir des tableaux ou des
collections de données. Voici les principaux types de boucles que vous
rencontrerez :

- La boucle `for`
- La boucle `while`
- La boucle `do...while`
- La boucle `foreach`

### Boucle `for`

La boucle `for` est une boucle qui permet de parcourir un tableau ou une
collection de données en utilisant un compteur. Voici un exemple de boucle `for`
:

```php
<?php

for ($i = 0; $i < 10; $i++) {
    echo "$i<br>";
}
```

Dans cet exemple, nous avons une boucle `for` qui affiche les nombres de 0 à 9.

La boucle `for` est composée de trois parties :

- L'initialisation du compteur (`$i = 0`)
- La condition d'arrêt (`$i < 10`)
- L'incrémentation du compteur (`$i++`)

Si `$i` est inférieur à 10, la boucle continue. Sinon, la boucle s'arrête.

La condition d'arrêt est toujours une expression booléenne qui est évaluée à
chaque itération de la boucle. Elle utilise les mêmes opérateurs de comparaison
que les instructions `if` et `else`.

Si la condition est vraie, la boucle continue. Sinon, la boucle s'arrête.

### Boucle `while`

La boucle `while` est une boucle qui permet de parcourir un tableau ou une
collection de données en utilisant une condition. Voici un exemple de boucle
`while` :

```php
<?php
$i = 0;

while ($i < 10) {
    echo "$i<br>";
    $i++;
}
```

Dans cet exemple, nous avons une boucle `while` qui affiche les nombres de 0
à 9. Dans ce cas, la boucle n'est pas très différente de la boucle `for`.

La principale différence est que la boucle `while` n'a pas de partie
d'initialisation ou d'incrémentation. Elle utilise uniquement une condition pour
déterminer si la boucle doit continuer ou s'arrêter.

Considérons un autre exemple de boucle `while` :

```php
<?php
$weather = "cloudy";

while ($weather == "cloudy") {
    echo "It's still cloudy...<br>";

    // Ici, on imagine un scénario où notre code va interagir avec un site web externe qui retourne la météo pour mettre à jour la variable `$weather`
    $weather = getWeather("Yverdon-les-Bains");
}

echo "The weather in Yverdon-les-Bains is *finally* different than cloudy! Yay!";
```

Dans cet exemple, nous avons une boucle `while` qui vérifie si le temps est
nuageux. Tant que le temps est nuageux, la boucle continue. Une fois que le
temps n'est plus nuageux, la boucle s'arrête.

### Boucle `do...while`

La boucle `do...while` est une boucle similaire à la boucle `while`, mais avec
une différence importante : le code à l'intérieur de la boucle est exécuté au
moins une fois, même si la condition est fausse. Voici un exemple de boucle
`do...while` :

```php
<?php
$userInput = "";

do {
    echo "Please enter your name: ";
    $userInput = readline();
} while ($userInput == "");
```

Dans cet exemple, nous avons une boucle `do...while` qui demande à l'utilisateur
de saisir son nom. Même si l'utilisateur ne saisit rien, le message sera affiché
au moins une fois.

Une fois que son nom a été saisi, la condition est vérifiée. Si le nom est vide,
la boucle continue. Sinon, la boucle s'arrête.

### Boucle `foreach`

La boucle `foreach` est une boucle spécialement conçue pour parcourir des
tableaux ou des collections de données. Voici un exemple de boucle `foreach` :

```php
<?php
$fruits = ['apple', 'banana', 'orange', 'kiwi'];

foreach ($fruits as $fruit) {
    echo "$fruit<br>";
}
```

## Fonctions utiles pour les tableaux et les boucles

PHP propose plusieurs fonctions pour travailler avec des tableaux. La
documentation officielle de PHP contient une liste complète de ces
fonctions[^php-fonctions-sur-les-tableaux] mais voici quelques-unes des plus
utiles.

### Fonctions `print()` et `print_r()`

La fonction `print()` affiche une chaîne de caractères à l'écran. Il s'agit
d'une alternative à la fonction `echo`.

La fonction `print_r()` affiche des informations sur une variable, y compris sa
structure et son contenu. Elle est très utile pour afficher des tableaux.

```php
<?php
$fruits = ['apple', 'banana', 'orange', 'kiwi'];

print_r($fruits);
```

```text
Array
(
    [0] => apple
    [1] => banana
    [2] => orange
    [3] => kiwi
)
```

La fonction `print_r()` affiche le tableau `$fruits` avec ses indices et ses
valeurs.

La fonction `print_r()` est très utile pour déboguer du code et afficher des
informations sur les tableaux ou toute autre variable.

### Fonction `count()`

La fonction `count()` permet de compter le nombre d'éléments dans un tableau.

En utilisant la fonction `count()`, nous pouvons facilement déterminer la taille
d'un tableau pour l'utiliser avec une boucle `for` :

```php
<?php
$fruits = ['apple', 'banana', 'orange', 'kiwi'];

for ($i = 0; $i < count($fruits); $i++) {
    echo "$fruits[$i]<br>";
}
```

Dans cet exemple, nous avons un tableau `$fruits` qui contient plusieurs fruits.
Nous utilisons une boucle `for` pour parcourir le tableau et afficher chaque
élément du tableau en utilisant son index.

Si `$i` est inférieur à la taille du tableau `$fruits`, la boucle continue.
Sinon, la boucle s'arrête.

### Fonction `array_push()`

La fonction `array_push()` permet d'ajouter un ou plusieurs éléments à la fin
d'un tableau. Voici un exemple d'utilisation de la fonction `array_push()` :

```php
<?php
$fruits = ['apple', 'banana', 'orange'];

array_push($fruits, 'kiwi', 'pear');

print_r($fruits);
```

```text
Array
(
    [0] => apple
    [1] => banana
    [2] => orange
    [3] => kiwi
    [4] => pear
)
```

Dans cet exemple, nous avons un tableau `$fruits` qui contient trois fruits.
Nous utilisons la fonction `array_push()` pour ajouter deux nouveaux fruits à la
fin du tableau.

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

[^php-fonctions-sur-les-tableaux]:
    Fonctions sur les tableaux,
    [php.net](https://www.php.net/manual/fr/ref.array.php), 20 mars 2025
