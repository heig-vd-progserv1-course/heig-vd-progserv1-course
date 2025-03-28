# Cours 03 - Tableaux et boucles - Exercices

Cette série d'exercices est conçue pour vous permettre de valider les concepts
théoriques et pratiques vus dans le cours
_[Cours 03 - Tableaux et boucles](../01-theorie/README.md)_.

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
- [Exercice 1](#exercice-1)
- [Exercice 2](#exercice-2)
- [Exercice 3](#exercice-3)
- [Exercice 4](#exercice-4)
- [Exercice 5](#exercice-5)
- [Exercice 6](#exercice-6)
- [Exercice 7](#exercice-7)
- [Exercice 8](#exercice-8)
- [Exercice 9](#exercice-9)
- [Exercice 10](#exercice-10)
- [Exercice 11](#exercice-11)
- [Exercice 12](#exercice-12)
- [Exercice 13](#exercice-13)
- [Exercice 14](#exercice-14)
- [Exercice 15](#exercice-15)
- [Exercice 16](#exercice-16)
- [Exercice 17](#exercice-17)
- [Exercice 18](#exercice-18)
- [Exercice 19](#exercice-19)
- [Exercice 20](#exercice-20)

## Exercice 1

Créez un tableau indexé `$fruits` contenant les éléments suivants :

- Pomme
- Poire
- Banane
- Cerise
- Fraise

Affichez le contenu du tableau avec la fonction `print_r`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$fruits = ["Pomme", "Poire", "Banane", "Cerise", "Fraise"];

print_r($fruits);
```

```text
Array ( [0] => Pomme [1] => Poire [2] => Banane [3] => Cerise [4] => Fraise )
```

</details>

## Exercice 2

Créez un tableau associatif `$person` contenant les éléments suivants :

- `firstName` : John
- `lastName` : Doe
- `age` : 30
- `city` : New York

Affichez le contenu du tableau avec la fonction `print_r`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$person = [
    "firstName" => "John",
    "lastName" => "Doe",
    "age" => 30,
    "city" => "New York"
];

print_r($person);
```

```text
Array ( [firstName] => John [lastName] => Doe [age] => 30 [city] => New York )
```

</details>

## Exercice 3

Créez un tableau multidimensionnel `$ticTacToe` (le tic-tac-toe est le nom anglophone du jeu du morpion) composé de trois tableaux indexés
contenant les éléments suivants :

- Une première ligne avec les valeurs `X`, `O` et `X`
- Une deuxième ligne avec les valeurs `O`, `X` et `O`
- Une troisième ligne avec les valeurs `X`, `O` et `X`

Affichez le contenu du tableau avec la fonction `print_r`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$ticTacToe = [
    ["X", "O", "X"],
    ["O", "X", "O"],
    ["X", "O", "X"]
];

print_r($ticTacToe);
```

```text
Array ( [0] => Array ( [0] => X [1] => O [2] => X ) [1] => Array ( [0] => O [1] => X [2] => O ) [2] => Array ( [0] => X [1] => O [2] => X ) )
```

</details>

## Exercice 4

Créez un tableau `$people` composé de trois tableaux associatifs contenant les éléments suivants :

- Un tableau avec les clés `name`, `age` et `city` et les valeurs `John Doe`, `30` et `New York`
- Un tableau avec les clés `name`, `age` et `city` et les valeurs `Jane Doe`, `25` et `Los Angeles`
- Un tableau avec les clés `name`, `age` et `city` et les valeurs `Alice Smith`, `35` et `Chicago`

Affichez le contenu du tableau avec la fonction `print_r`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$people = [
    [
        "name" => "John Doe",
        "age" => 30,
        "city" => "New York"
    ],
    [
        "name" => "Jane Doe",
        "age" => 25,
        "city" => "Los Angeles"
    ],
    [
        "name" => "Alice Smith",
        "age" => 35,
        "city" => "Chicago"
    ]
];

print_r($people);
```

```text
Array ( [0] => Array ( [name] => John Doe [age] => 30 [city] => New York ) [1] => Array ( [name] => Jane Doe [age] => 25 [city] => Los Angeles ) [2] => Array ( [name] => Alice Smith [age] => 35 [city] => Chicago ) )
```

</details>

## Exercice 5

Créez un tableau multidimensionnel associatif `$fruitsAndVegetables` composé de deux tableaux indexés contenant les éléments suivants :

- Un tableau avec les valeurs `Pomme`, `Poire`, `Banane`, `Cerise` et `Fraise` qui a comme clé `fruits`
- Un tableau avec les valeurs `Carotte`, `Tomate`, `Salade`, `Concombre` et `Radis` qui a comme clé `vegetables`

Affichez le contenu du tableau avec la fonction `print_r`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$fruitsAndVegetables = [
    "fruits" => ["Pomme", "Poire", "Banane", "Cerise", "Fraise"],
    "vegetables" => ["Carotte", "Tomate", "Salade", "Concombre", "Radis"]
];

print_r($fruitsAndVegetables);
```

```text
Array ( [fruits] => Array ( [0] => Pomme [1] => Poire [2] => Banane [3] => Cerise [4] => Fraise ) [vegetables] => Array ( [0] => Carotte [1] => Tomate [2] => Salade [3] => Concombre [4] => Radis ) )
```

</details>

## Exercice 6

En reprenant l'[exercice 1](#exercice-1), affichez le troisième élément du tableau `$fruits`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$fruits = ["Pomme", "Poire", "Banane", "Cerise", "Fraise"];

echo $fruits[2];
```

```text
Banane
```

</details>

## Exercice 7

En reprenant l'[exercice 2](#exercice-2), affichez la valeur de la clé `age` du tableau `$person`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$person = [
    "firstName" => "John",
    "lastName" => "Doe",
    "age" => 30,
    "city" => "New York"
];

echo $person["age"];
```

```text
30
```

</details>

## Exercice 8

En reprenant l'[exercice 3](#exercice-3), affichez la valeur de la deuxième ligne et de la troisième colonne du tableau `$ticTacToe`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$ticTacToe = [
    ["X", "O", "X"],
    ["O", "X", "O"],
    ["X", "O", "X"]
];

echo $ticTacToe[1][2];
```

```text
O
```

</details>

## Exercice 9

En reprenant l'[exercice 4](#exercice-4), affichez la valeur de la clé `name` du dernier tableau du tableau `$people`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$people = [
    [
        "name" => "John Doe",
        "age" => 30,
        "city" => "New York"
    ],
    [
        "name" => "Jane Doe",
        "age" => 25,
        "city" => "Los Angeles"
    ],
    [
        "name" => "Alice Smith",
        "age" => 35,
        "city" => "Chicago"
    ]
];

echo $people[2]["name"];
```

```text
Alice Smith
```

</details>

## Exercice 10

En reprenant l'[exercice 5](#exercice-5), affichez la valeur de la clé `vegetables` du tableau `$fruitsAndVegetables`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$fruitsAndVegetables = [
    "fruits" => ["Pomme", "Poire", "Banane", "Cerise", "Fraise"],
    "vegetables" => ["Carotte", "Tomate", "Salade", "Concombre", "Radis"]
];

print_r($fruitsAndVegetables["vegetables"]);
```

```text
Array ( [0] => Carotte [1] => Tomate [2] => Salade [3] => Concombre [4] => Radis )
```

</details>

## Exercice 11

En utilisant une boucle `for`, affichez les éléments du tableau `$fruits` de l'[exercice 1](#exercice-1) un par un.

**Bonus** : faites de même avec les boucles `while`, `do...while` et `foreach`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$fruits = ["Pomme", "Poire", "Banane", "Cerise", "Fraise"];

for ($i = 0; $i < count($fruits); $i++) {
    echo "$fruits[$i]<br>";
}

echo "<br>";

$i = 0;
while ($i < count($fruits)) {
    echo "$fruits[$i]<br>";
    $i++;
}

echo "<br>";

$i = 0;
do {
    echo "$fruits[$i]<br>";
    $i++;
} while ($i < count($fruits));

echo "<br>";

foreach ($fruits as $fruit) {
    echo "$fruit<br>";
}
```

```text
Pomme
Poire
Banane
Cerise
Fraise
(3x)
```

</details>

## Exercice 12

En utilisant une boucle `for`, affichez les éléments du tableau `$ticTacToe` de l'[exercice 3](#exercice-3) avec à chaque fois le numéro de la ligne et le numéro de la colonne avec le format
`Ligne x, colonne y : valeur`.

**Bonus** : faites de même avec les boucles `while`, `do...while` et `foreach`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php

<?php
$ticTacToe = [
    ["X", "O", "X"],
    ["O", "X", "O"],
    ["X", "O", "X"]
];

// On itère sur les lignes
for ($i = 0; $i < count($ticTacToe); $i++) {
    // On itère sur les colonnes
    for ($j = 0; $j < count($ticTacToe[$i]); $j++) {
        // On affiche le contenu de la case - ici, nous sommes obligés de passer
        // par une concaténation à l'aide du point (.) pour afficher le contenu
        // de la case, car PHP ne permet pas d'afficher directement le contenu
        // d'une case d'un tableau à deux dimensions à l'aide de l'interpolation
        echo "Ligne $i, colonne $j : " . $ticTacToe[$i][$j] . "<br>";
    }
}

echo "<br>";

$i = 0;
while ($i < count($ticTacToe)) {
    $j = 0;
    while ($j < count($ticTacToe[$i])) {
        // On affiche le contenu de la case - ici, nous sommes obligés de passer
        // par une concaténation à l'aide du point (.) pour afficher le contenu
        // de la case, car PHP ne permet pas d'afficher directement le contenu
        // d'une case d'un tableau à deux dimensions à l'aide de l'interpolation
        echo "Ligne $i, colonne $j : " . $ticTacToe[$i][$j] . "<br>";
        $j++;
    }
    $i++;
}

echo "<br>";

$i = 0;
do {
    $j = 0;
    do {

        // On affiche le contenu de la case - ici, nous sommes obligés de passer
        // par une concaténation à l'aide du point (.) pour afficher le contenu
        // de la case, car PHP ne permet pas d'afficher directement le contenu
        // d'une case d'un tableau à deux dimensions à l'aide de l'interpolation
        echo "Ligne $i, colonne $j : " . $ticTacToe[$i][$j] . "<br>";
        $j++;
    } while ($j < count($ticTacToe[$i]));
    $i++;
} while ($i < count($ticTacToe));

echo "<br>";

foreach ($ticTacToe as $i => $line) {
    foreach ($line as $j => $value) {
        // Ici, nous pouvons afficher directement le contenu de la case, car la
        // conversion du tableau à l'aide du `foreach` permet de récupérer
        // directement la valeur de la case
        echo "Ligne $i, colonne $j : $value<br>";
    }
}
```

```text
Ligne 0, colonne 0 : X
Ligne 0, colonne 1 : O
Ligne 0, colonne 2 : X
Ligne 1, colonne 0 : O
Ligne 1, colonne 1 : X
Ligne 1, colonne 2 : O
Ligne 2, colonne 0 : X
Ligne 2, colonne 1 : O
Ligne 2, colonne 2 : X
(3x)
```

</details>

## Exercice 13

En utilisant une boucle `foreach`, affichez les éléments du tableau `$people` de l'[exercice 4](#exercice-4) un par un.

**Bonus** : faites de même avec les boucles `for`, `while` et `do...while`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$people = [
    [
        "name" => "John Doe",
        "age" => 30,
        "city" => "New York"
    ],
    [
        "name" => "Jane Doe",
        "age" => 25,
        "city" => "Los Angeles"
    ],
    [
        "name" => "Alice Smith",
        "age" => 35,
        "city" => "Chicago"
    ]
];

foreach ($people as $person) {
    echo "Nom : " . $person["name"] . "<br>";
    echo "Âge : " . $person["age"] . "<br>";
    echo "Ville : " . $person["city"] . "<br>";
    echo "<br>";
}

echo "<br>";

for ($i = 0; $i < count($people); $i++) {
    echo "Nom : " . $people[$i]["name"] . "<br>";
    echo "Âge : " . $people[$i]["age"] . "<br>";
    echo "Ville : " . $people[$i]["city"] . "<br>";
    echo "<br>";
}

echo "<br>";

$i = 0;
while ($i < count($people)) {
    echo "Nom : " . $people[$i]["name"] . "<br>";
    echo "Âge : " . $people[$i]["age"] . "<br>";
    echo "Ville : " . $people[$i]["city"] . "<br>";
    echo "<br>";
    $i++;
}

echo "<br>";

$i = 0;
do {
    echo "Nom : " . $people[$i]["name"] . "<br>";
    echo "Âge : " . $people[$i]["age"] . "<br>";
    echo "Ville : " . $people[$i]["city"] . "<br>";
    echo "<br>";
    $i++;
} while ($i < count($people));
```

```text
Nom : John Doe
Âge : 30
Ville : New York

Nom : Jane Doe
Âge : 25
Ville : Los Angeles

Nom : Alice Smith
Âge : 35
Ville : Chicago
(3x)
```

</details>

## Exercice 14

En utilisant la documentation officielle de PHP sur les fonctions `range` : <https://www.php.net/manual/fr/function.range.php> et `shuffle` : <https://www.php.net/manual/fr/function.shuffle.php>, déclarez une fonction `shuffleRange` qui prend deux paramètres `$start` et `$end` et retourne un tableau contenant les nombres de `$start` à `$end` inclus, mélangés.

Faites des tests avec les valeurs suivantes :

```php
<?php
$start = 1;
$end = 10;
```

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$start = 1;
$end = 10;

function shuffleRange($start, $end) {
    $range = range($start, $end);
    shuffle($range);
    return $range;
}

print_r(shuffleRange($start, $end));
```

```text
// Ceci est un exemple de résultat, le vôtre sera différent
Array ( [0] => 3 [1] => 6 [2] => 7 [3] => 9 [4] => 1 [5] => 10 [6] => 8 [7] => 5 [8] => 2 [9] => 4 )
```

</details>

## Exercice 15

En utilisant la documentation officielle de PHP sur la fonction `sort` : <https://www.php.net/manual/fr/function.sort.php>, utilisez la fonction `sort` pour trier le tableau `$fruits` de l'[exercice 1](#exercice-1) par ordre alphabétique.

Affichez le contenu du tableau avec la fonction `print_r`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$fruits = ["Pomme", "Poire", "Banane", "Cerise", "Fraise"];
sort($fruits);

print_r($fruits);
```

```text
Array ( [0] => Banane [1] => Cerise [2] => Fraise [3] => Poire [4] => Pomme )
```

</details>

## Exercice 16

En utilisant la documentation officielle de PHP sur la fonction `usort` : <https://www.php.net/manual/fr/function.usort.php>, utilisez la fonction `usort` pour trier le tableau `$people` de l'[exercice 4](#exercice-4) par ordre croissant de l'âge.

**Indice** : vous allez devoir déclarer une fonction de comparaison pour trier le tableau selon l'age. Cette fonction prend deux paramètres `$a` et `$b` et retourne un entier négatif si `$a` est plus petit que `$b`, un entier positif si `$a` est plus grand que `$b` et zéro si les deux sont égaux.

Affichez le contenu du tableau avec la fonction `print_r`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$people = [
    [
        "name" => "John Doe",
        "age" => 30,
        "city" => "New York"
    ],
    [
        "name" => "Jane Doe",
        "age" => 25,
        "city" => "Los Angeles"
    ],
    [
        "name" => "Alice Smith",
        "age" => 35,
        "city" => "Chicago"
    ]
];

function compareAge($a, $b) {
    if ($a["age"] > $b["age"]) {
        return 1;
    } else if ($a["age"] < $b["age"]) {
        return -1;
    } else {
        return 0;
    }
}

usort($people, "compareAge");

print_r($people);
```

## Exercice 17

En utilisant la documentation officielle de PHP sur les fonctions `usort` : <https://www.php.net/manual/fr/function.usort.php> et `strcmp` : <https://www.php.net/manual/fr/function.strcmp.php>, utilisez la fonction `usort` pour trier le tableau `$people` de l'[exercice 4](#exercice-4) par ordre alphabétique du nom.

**Indice** : vous allez devoir déclarer une fonction de comparaison pour trier le tableau selon le nom. Cette fonction prend deux paramètres `$a` et `$b` et utilise la fonction `strcmp` pour comparer les noms. La fonction `strcmp` retourne un entier négatif si `$a` est plus petit que `$b`, un entier positif si `$a` est plus grand que `$b` et zéro si les deux sont égaux.

Affichez le contenu du tableau avec la fonction `print_r`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$people = [
    [
        "name" => "John Doe",
        "age" => 30,
        "city" => "New York"
    ],
    [
        "name" => "Jane Doe",
        "age" => 25,
        "city" => "Los Angeles"
    ],
    [
        "name" => "Alice Smith",
        "age" => 35,
        "city" => "Chicago"
    ]
];

function compareName($a, $b) {
    return strcmp($a["name"], $b["name"]);
}

usort($people, "compareName");

print_r($people);
```

```text
Array ( [0] => Array ( [name] => Alice Smith [age] => 35 [city] => Chicago ) [1] => Array ( [name] => Jane Doe [age] => 25 [city] => Los Angeles ) [2] => Array ( [name] => John Doe [age] => 30 [city] => New York ) ) 
```

</details>

## Exercice 18

En utilisant la documentation officielle de PHP sur les fonctions `range` : <https://www.php.net/manual/fr/function.range.php> et `array_sum` : <https://www.php.net/manual/fr/function.array-sum.php>, déclarez une fonction `sumRange` qui prend deux paramètres `$start` et `$end` et retourne la somme des nombres de `$start` à `$end` inclus.

Faites des tests avec les valeurs suivantes :

```php
<?php
$start = 15;
$end = 30;
```

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$start = 15;
$end = 30;

function sumRange($start, $end) {
    $range = range($start, $end);
    return array_sum($range);
}

echo sumRange($start, $end);
```

```text
360
```

</details>

## Exercice 19

En utilisant la documentation officielle de PHP sur les fonctions `explode` :
<https://www.php.net/manual/fr/function.explode.php>, `array_reverse` :
<https://www.php.net/manual/fr/function.array-reverse.php>
 et `implode` :
<https://www.php.net/manual/fr/function.implode.php>, déclarez une fonction
`reverseWords` qui prend un paramètre `$string` et retourne la chaîne de
caractères `$string` avec les mots dans l'ordre inverse.

Faites des tests avec la chaîne suivante :

```php
<?php
$string = "Hello, world!";
```

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$string = "Hello, world!";
$words = explode(" ", $string);
$reversedWords = array_reverse($words);
$result = implode(" ", $reversedWords);

echo $result;
```

```text
world! Hello,
```

</details>

## Exercice 20

En utilisant la documentation officielle de PHP sur les fonctions `array_map` :
<https://www.php.net/manual/fr/function.array-map.php> et `strrev` :
<https://www.php.net/manual/fr/function.strrev.php>, déclarez une fonction
`reverseWords` qui prend un paramètre `$string` et retourne la chaîne de
caractères `$string` avec les mots dans l'ordre inverse.

Faites des tests avec la chaîne suivante :

```php
<?php
$string = "Hello, world!";
```

Le résultat sera le suivant : _"olleh, world!"_.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$string = "Hello, world!";
$words = explode(" ", $string);
$reversedWords = array_map('strrev', $words);

$result = implode(" ", $reversedWords);

echo $result;
```

```text
,olleH !dlrow
```
