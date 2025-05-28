# Cours 02 - Fonctions - Exercices

Cette série d'exercices est conçue pour vous permettre de valider les concepts
théoriques et pratiques vus dans le cours
_[Cours 02 - Fonctions](../01-theorie/README.md)_.

## Ressources

- Théorie : [Support de cours](../01-theorie/README.md) ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/02-fonctions/01-theorie/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/02-fonctions/01-theorie/02-fonctions-presentation.pdf)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Exercices : [Énoncés et solutions](../03-exercices/README.md)

## Table des matières

- [Ressources](#ressources)
- [Table des matières](#table-des-matières)
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
- [Exercice 21](#exercice-21)
- [Exercice 22](#exercice-22)
- [Exercice 23](#exercice-23)
- [Exercice 24](#exercice-24)
- [Exercice 25](#exercice-25)
- [Exercice 26 - Exercice bonus](#exercice-26---exercice-bonus)

## Exercice 1

Déclarez une fonction `greet` qui prend un paramètre `$name` et affiche le
message _"Hello, [name]!"_. Appelez cette fonction avec votre prénom comme
argument.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function greet($name) {
    echo "Hello, $name!<br>";
}

greet("Alice");
```

```text
Hello, Alice!
```

</details>

## Exercice 2

Déclarez une fonction square qui prend un paramètre `$number` et retourne le
carré de ce nombre. Appelez cette fonction avec le nombre `4` et affichez le
résultat.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function square($number) {
    return $number * $number;
}

$result = square(4);

echo $result;
```

```text
16
```

</details>

## Exercice 3

Déclarez une fonction multiply qui prend deux paramètres `$a` et `$b` et
retourne leur produit. Appelez cette fonction avec les nombres 6 et 7, puis
affichez le résultat.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function multiply($a, $b) {
    return $a * $b;
}

$result = multiply(6, 7);

echo $result;
```

```text
42
```

</details>

## Exercice 4

Déclarez une fonction divide qui prend deux paramètres `$a` et `$b` et retourne
le résultat de la division de `$a` par `$b`. Si `$b` est égal à 0, la fonction
doit retourner le message _"Division by zero is not allowed."_.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function divide($a, $b) {
    if ($b == 0) {
        return "Division by zero is not allowed.";
    } else {
        return $a / $b;
    }
}

$result = divide(6, 3);

echo $result . "<br>";
```

```text
2
```

</details>

## Exercice 5

Déclarez une fonction `absoluteValue` qui prend un paramètre `$number` et
retourne sa valeur absolue. Utilisez cette fonction pour afficher la valeur
absolue de `-15`.

Pour rappel, la valeur absolue d'un nombre est sa valeur numérique considérée
sans tenir compte de son signe ou encore sa distance à zéro .[^valeur-absolue]
Par exemple, la valeur absolue de `-15` est `15`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function absoluteValue($number) {
    if ($number < 0) {
        return -$number;
    } else {
        return $number;
    }
}

$result = absoluteValue(-15);

echo $result;
```

```text
15
```

</details>

## Exercice 6

Déclarez une fonction `maxOfTwo` qui prend deux paramètres `$a` et `$b` et
retourne le plus grand des deux. Appelez cette fonction avec les nombres `12` et
`8`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function maxOfTwo($a, $b) {
    if ($a > $b) {
        return $a;
    } else {
        return $b;
    }
}

$result = maxOfTwo(12, 8);

echo $result;
```

```text
12
```

</details>

## Exercice 7

Déclarez une fonction isEven qui prend un paramètre `$number` et retourne `true`
si le nombre est pair, ou `false` sinon. Utilisez cette fonction pour vérifier
si le nombre `10` est pair, puis affichez _"Even"_ ou _"Odd"_ en conséquence.

**Astuce** : un nombre est pair s'il est divisible par 2 sans reste (modulo
`%`).

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function isEven($number) {
    return $number % 2 == 0;
}

$result = isEven(10);

if ($result) {
    echo "Even<br>";
} else {
    echo "Odd<br>";
}
```

```text
Even
```

</details>

## Exercice 8

Déclarez une fonction `grade` qui calcule la note finale d'un.e étudiant.e en
fonction du barème fédéral suisse (voir ci-dessous). La fonction prend deux
paramètres : le nombre de points obtenus et le nombre de points maximum. La
fonction doit retourner la note finale.

Pour rappel, le barème fédéral suisse est le suivant :

$$
\text{note finale} = \frac{\text{nombre de points obtenus}}{\text{nombre de points maximum}} * 5.0 + 1.0
$$

Appelez cette fonction avec les points obtenus `47` et les points maximum `66`,
puis affichez le résultat.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function grade($points, $maxPoints) {
    return $points / $maxPoints * 5.0 + 1.0;
}

$result = grade(47, 66);

echo $result;
```

```text
4.5606060606061
```

</details>

## Exercice 9

Déclarez une fonction `isPassing` qui prend un paramètre `$grade` et retourne
`true` si la note est supérieure ou égale à 4.0, ou `false` sinon. Utilisez
cette fonction pour vérifier si la note précédente est suffisante pour passer
l'examen, puis affichez _"Passing"_ ou _"Failing"_ en conséquence.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function isPassing($grade) {
    return $grade >= 4.0;
}

$result = isPassing(4.5606060606061);

if ($result) {
    echo "Passing<br>";
} else {
    echo "Failing<br>";
}
```

```text
Passing
```

</details>

## Exercice 10

Déclarez une fonction `isLeapYear` qui prend un paramètre `$year` et retourne
`true` si l'année est bissextile (voir ci-dessous), ou `false` sinon.

Une année est bissextile si elle est divisible par 4 mais pas par 100, ou si
elle est divisible par 400[^annee-bissextile].

Utilisez cette fonction pour vérifier si les années 1900, 2000, 2024 et 2025
sont bissextiles. Affichez _"Bissextile"_ ou _"Non bissextile"_ en conséquence.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function isLeapYear($year) {
    return ($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0;
}

if (isLeapYear(1900)) {
    echo "Bissextile<br>";
} else {
    echo "Non bissextile<br>";
}

if (isLeapYear(2000)) {
    echo "Bissextile<br>";
} else {
    echo "Non bissextile<br>";
}

if (isLeapYear(2024)) {
    echo "Bissextile<br>";
} else {
    echo "Non bissextile<br>";
}

if (isLeapYear(2025)) {
    echo "Bissextile<br>";
} else {
    echo "Non bissextile<br>";
}
```

```text
Non bissextile
Bissextile
Bissextile
Non bissextile
```

</details>

## Exercice 11

En utilisant la documentation officielle de PHP sur la fonction `round` :
<https://www.php.net/manual/fr/function.round.php>, utilisez cette fonction pour
arrondir le nombre `4.5606060606061` à une décimale.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$number = 4.5606060606061;
$roundedNumber = round($number, 1);

echo $roundedNumber;
```

```text
4.6
```

</details>

## Exercice 12

En utilisant la documentation officielle de PHP sur la fonction `ceil` :
<https://www.php.net/manual/fr/function.ceil.php>, utilisez cette fonction pour
arrondir le nombre `4.5606060606061` à l'entier supérieur.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$number = 4.5606060606061;
$roundedNumber = ceil($number);

echo $roundedNumber;
```

```text
5
```

</details>

## Exercice 13

En utilisant la documentation officielle de PHP sur la fonction `floor` :
<https://www.php.net/manual/fr/function.floor.php>, utilisez cette fonction pour
arrondir le nombre `4.5606060606061` à l'entier inférieur.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$number = 4.5606060606061;
$roundedNumber = floor($number);

echo $roundedNumber;
```

```text
4
```

</details>

## Exercice 14

En reprenant l'[exercice 5](#exercice-5) et la documentation officielle de PHP
sur la fonction `abs` : <https://www.php.net/manual/fr/function.abs.php>,
déclarez une fonction `absoluteValue` qui calcule la valeur absolue d'un nombre
en utilisant la fonction `abs` de PHP.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function absoluteValue($number) {
    return abs($number);
}

$result = absoluteValue(-15);

echo $result;
```

```text
15
```

</details>

## Exercice 15

En utilisant la documentation officielle de PHP sur la fonction `pow` :
<https://www.php.net/manual/fr/function.pow.php>, déclarez une fonction `power`
qui prend deux paramètres `$base` et `$exponent` et retourne la puissance de
`$base` à la puissance `$exponent`.

Utilisez cette fonction pour calculer la puissance de `2` à la puissance `8`.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function power($base, $exponent) {
    return pow($base, $exponent);
}

$result = power(2, 8);

echo $result;
```

```text
256
```

</details>

## Exercice 16

En utilisant la documentation officielle de PHP sur la fonction `str_replace` :
<https://www.php.net/manual/fr/function.str-replace.php>, utilisez cette
fonction pour remplacer le mot _"world"_ par _"PHP"_ dans la chaîne de
caractères _"Hello, world!"_.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$string = "Hello, world!";
$newString = str_replace("world", "PHP", $string);

echo $newString;
```

```text
Hello, PHP!
```

</details>

## Exercice 17

En utilisant la documentation officielle de PHP sur la fonction `str_word_count`
: <https://www.php.net/manual/fr/function.str-word-count.php>, utilisez cette
fonction pour compter le nombre de mots dans la chaîne de caractères _"Hello,
world!"_.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$string = "Hello, world!";
$wordCount = str_word_count($string);

echo $wordCount;
```

```text
2
```

</details>

## Exercice 18

En utilisant la documentation officielle de PHP sur la fonction
`str_starts_with` :
<https://www.php.net/manual/fr/function.str-starts-with.php>, utilisez cette
fonction pour vérifier si la chaîne de caractères _"Hello, world!"_ commence par
_"Hello"_.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$string = "Hello, world!";
$result = str_starts_with($string, "Hello");

if ($result) {
    echo "'$string' starts with 'Hello'<br>";
} else {
    echo "'$string' does not start with 'Hello'<br>";
}
```

```text
'Hello, world!' starts with 'Hello'
```

</details>

## Exercice 19

En utilisant la documentation officielle de PHP sur la fonction `str_repeat` :
<https://www.php.net/manual/fr/function.str-repeat.php>, utilisez cette fonction
pour répéter la chaîne de caractères _"Hello, world!"_ trois fois.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$string = "Hello, world!<br>";
$repeatedString = str_repeat($string, 3);

echo $repeatedString;
```

```text
Hello, world!
Hello, world!
Hello, world!
```

</details>

## Exercice 20

En utilisant la documentation officielle de PHP sur la fonction `strpos` :
<https://www.php.net/manual/fr/function.strpos.php>, utilisez cette fonction
pour trouver la position de début du mot _"world"_ dans la chaîne de caractères
_"Hello, world!"_.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$string = "Hello, world!";
$position = strpos($string, "world");

echo $position;
```

```text
7
```

</details>

## Exercice 21

En utilisant la documentation officielle de PHP sur les fonctions `is_string` :
<https://www.php.net/manual/fr/function.is-string.php> et `is_int` :
<https://www.php.net/manual/fr/function.is-int.php>, déclarez une fonction
`isStringOrInteger` qui prend un paramètre `$variable` et retourne _"String"_ si
la variable est une chaîne de caractères, _"Integer"_ si la variable est un
entier ou _"Unknown"_ sinon.

Faites des tests avec les variables suivantes :

```php
<?php
$variable1 = "Hello, world!";
$variable2 = 42;
$variable3 = 3.14;
$variable4 = true;
```

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$variable1 = "Hello, world!";
$variable2 = 42;
$variable3 = 3.14;
$variable4 = true;

function isStringOrInteger($variable) {
    if (is_string($variable)) {
        return "String";
    } elseif (is_int($variable)) {
        return "Integer";
    } else {
        return "Unknown";
    }
}

echo isStringOrInteger($variable1) . "<br>";
echo isStringOrInteger($variable2) . "<br>";
echo isStringOrInteger($variable3) . "<br>";
echo isStringOrInteger($variable4) . "<br>";
```

```text
String
Integer
Unknown
Unknown
```

</details>

## Exercice 22

En utilisant la documentation officielle de PHP sur les fonctions `isset` :
<https://www.php.net/manual/fr/function.isset.php> et `empty` :
<https://www.php.net/manual/fr/function.empty.php>, déclarez une fonction
`isSetAndNotEmpty` qui prend un paramètre `$variable` et retourne _"Set and not
empty"_ si la variable est définie et non vide, _"Set and empty"_ si la variable
est définie et vide, _"Not set"_ si la variable n'est pas définie.

Faites des tests avec les variables suivantes :

```php
<?php
$variable1 = "Hello, world!";
$variable2 = "";
$variable3 = 42;
$variable4 = null;
```

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$variable1 = "Hello, world!";
$variable2 = "";
$variable3 = 42;
$variable4 = null;

function isSetAndNotEmpty($variable) {
    if (isset($variable) && !empty($variable)) {
        return "Set and not empty";
    } elseif (isset($variable) && empty($variable)) {
        return "Set and empty";
    } else {
        return "Not set";
    }
}

echo isSetAndNotEmpty($variable1) . "<br>";
echo isSetAndNotEmpty($variable2) . "<br>";
echo isSetAndNotEmpty($variable3) . "<br>";
echo isSetAndNotEmpty($variable4) . "<br>";
```

```text
Set and not empty
Set and empty
Set and not empty
Not set
```

</details>

## Exercice 23

En utilisant la documentation officielle de PHP sur les fonctions `strlen` :
<https://www.php.net/manual/fr/function.strlen.php> et `substr` :
<https://www.php.net/manual/fr/function.substr.php>, déclarez une fonction
`truncate` qui prend un paramètre `$string` et un paramètre `$length` et
retourne une sous-chaîne de `$string` de longueur `$length` suivie de _"..."_ si
la chaîne est plus longue que `$length`.

Faites des tests avec la chaîne suivante :

```php
<?php
$string = "Hello, world!";
$length = 5;
```

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$string = "Hello, world!";
$length = 5;

function truncate($string, $length) {
    if (strlen($string) > $length) {
        return substr($string, 0, $length) . "...";
    } else {
        return $string;
    }
}

echo truncate($string, $length);
```

```text
Hello...
```

</details>

## Exercice 24

En utilisant la documentation officielle de PHP sur la fonction `var_dump` :
<https://www.php.net/manual/fr/function.var-dump.php>, déclarez une fonction
`debug` qui prend un paramètre `$variable` et affiche le type et la valeur de la
variable.

Faites des tests avec les variables suivantes :

```php
<?php
$variable1 = "Hello, world!";
$variable2 = 42;
$variable3 = 3.14;
$variable4 = true;
```

<details>
<summary>Afficher la réponse</summary>

```php
<?php
$variable1 = "Hello, world!";
$variable2 = 42;
$variable3 = 3.14;
$variable4 = true;

function debug($variable) {
    var_dump($variable);
}

debug($variable1);
echo "<br>";
debug($variable2);
echo "<br>";
debug($variable3);
echo "<br>";
debug($variable4);
echo "<br>";
```

```text
string(13) "Hello, world!"
int(42)
float(3.14)
bool(true)
```

</details>

## Exercice 25

Déclarez une fonction `isDivisibleBy` qui prend deux paramètres `$a` et `$b` et
retourne `true` si `$a` est divisible par `$b`, ou `false` sinon. Utilisez cette
fonction pour vérifier si `10` est divisible par `2` et si `10` est divisible
par `3`.

**Attention**: la fonction doit vérifier de ne pas diviser par zéro !

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function isDivisibleBy($a, $b) {
    return $b != 0 && $a % $b == 0;
}

if (isDivisibleBy(10, 2)) {
    echo "10 is divisible by 2<br>";
} else {
    echo "10 is not divisible by 2<br>";
}

if (isDivisibleBy(10, 3)) {
    echo "10 is divisible by 3<br>";
} else {
    echo "10 is not divisible by 3<br>";
}
```

```text
10 is divisible by 2
10 is not divisible by 3
```

</details>

## Exercice 26 - Exercice bonus

> [!NOTE]
>
> Cet exercice est un exercice bonus. Il est totalement optionnel.

Déclarez une fonction `factorial` qui prend un paramètre `$number` et retourne
la factorielle de ce nombre. Utilisez cette fonction pour calculer `5!`.

Pour rappel, la factorielle d'un nombre est le produit de tous les entiers
positifs inférieurs ou égaux à ce nombre[^factorielle] :

- $n! = n \times (n - 1)!$
- $0! = 1$

Par exemple, $5! = 5 * 4 * 3 * 2 * 1 = 120$.

Il est donc possible de définir la fonction `factorial` de manière récursive (la
fonction s'appelle elle-même) en utilisant ces propriétés.

<details>
<summary>Afficher la réponse</summary>

```php
<?php
function factorial($number) {
    if ($number == 0) {
        return 1;
    }

    return $number * factorial($number - 1);
}

$result = factorial(5);

echo $result;
```

```text
120
```

</details>

[^annee-bissextile]:
    Année bissextile
    [fr.wikipedia.org](https://fr.wikipedia.org/wiki/Ann%C3%A9e_bissextile), 23
    mars 2025

[^factorielle]:
    Factorielle [fr.wikipedia.org](https://fr.wikipedia.org/wiki/Factorielle),
    23 mars 2025

[^valeur-absolue]:
    Valeur absolue
    [fr.wikipedia.org](https://fr.wikipedia.org/wiki/Valeur_absolue), 23 mars
    2025
