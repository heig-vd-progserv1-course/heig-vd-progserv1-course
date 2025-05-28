# Cours 07 - Programmation orientée objet - Exercices

Cette série d'exercices est conçue pour vous permettre de valider les concepts
théoriques et pratiques vus dans le cours
_[Cours 07 - Programmation orientée objet](../01-theorie/README.md)_.

## Ressources

- Théorie : [Support de cours](../01-theorie/README.md) ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/07-programmation-orientee-objet/01-theorie/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/07-programmation-orientee-objet/01-theorie/07-programmation-orientee-objet-presentation.pdf)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Exercices : [Énoncés et solutions](../03-exercices/README.md)

## Table des matières

- [Ressources](#ressources)
- [Table des matières](#table-des-matières)
- [Exercice 1a](#exercice-1a)
- [Exercice 1b](#exercice-1b)
- [Exercice 2a](#exercice-2a)
- [Exercice 2b](#exercice-2b)

## Exercice 1a

Réalisez une classe `Person` avec PHP qui représente une personne avec les
attributs `firstName`, `lastName`, `age` et `email`. Implémentez les méthodes
suivantes :

- `__construct($firstName, $lastName, $age, $email)` : constructeur pour
  initialiser les attributs.
- Tous les setters et getters pour les attributs `firstName`, `lastName`, `age`
  et `email`.
- `getFullName()` : retourne le nom complet de la personne (prénom + nom).
- `isAdult()` : retourne `true` si la personne est majeure (18 ans ou plus),
  `false` sinon.
- `getEmailDomain()` : retourne le domaine de l'email (par exemple, pour
  `jane.doe@example.com`, retourne `example.com`). Vous pouvez utiliser la
  fonction [`explode`](https://www.php.net/manual/fr/function.explode.php) de
  PHP pour séparer l'email par le caractère `@` et retourner la deuxième partie.
  Si l'email n'est pas valide, retournez une chaîne vide.

Contraintes :

- Utilisez la visibilité `private` pour les attributs.
- Utilisez la visibilité `public` pour les méthodes.

<details>
<summary>Afficher la solution</summary>

```php
<?php

class Person {
    private $firstName;
    private $lastName;
    private $age;
    private $email;

    public function __construct($firstName, $lastName, $age, $email) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    public function getFullName() {
        return "{$this->firstName} {$this->lastName}";
    }

    public function isAdult() {
        return $this->age >= 18;
    }

    public function getEmailDomain() {
        $parts = explode('@', $this->email);

        if (count($parts) == 2) {
            return $parts[1];
        }

        return '';
    }
}
```

</details>

## Exercice 1b

En utilisant la classe `Person` créée dans l'exercice précédent, instantiez deux
objets `Person` avec les données suivantes :

- Personne 1 :
  - Prénom : `Jane`
  - Nom : `Doe`
  - Âge : `25`
  - Email : `jane.doe@example.com`
- Personne 2 :
  - Prénom : `John`
  - Nom : `Smith`
  - Âge : `17`
  - Email : `john.smith`

Ensuite, effectuez les opérations suivantes :

- Affichez le nom complet de chaque personne en utilisant la méthode
  `getFullName()`.
- Vérifiez si chaque personne est majeure en utilisant la méthode `isAdult()`.
- Affichez le e-mail de chaque personne en utilisant la méthode `getEmail()`.
- Affichez le domaine de l'email de chaque personne en utilisant la méthode
  `getEmailDomain()`. Pour la personne avec un email invalide, affichez un
  message indiquant que l'email est invalide.

<details>
<summary>Afficher la solution</summary>

```php
<?php

class Person {
    private $firstName;
    private $lastName;
    private $age;
    private $email;

    public function __construct($firstName, $lastName, $age, $email) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    public function getFullName() {
        return "{$this->firstName} {$this->lastName}";
    }

    public function isAdult() {
        return $this->age >= 18;
    }

    public function getEmailDomain() {
        $parts = explode('@', $this->email);

        if (count($parts) == 2) {
            return $parts[1];
        }

        return '';
    }
}

$janeDoe = new Person('Jane', 'Doe', 25, 'jane.doe@example.com');
$johnSmith = new Person('John', 'Smith', 17, 'john.smith');

echo "Full Name: " . $janeDoe->getFullName() . "<br>";
echo "Is Adult: " . ($janeDoe->isAdult() ? 'Yes' : 'No') . "<br>";
echo "Email: " . $janeDoe->getEmail() . "<br>";

$janeDoeEmailDomain = $janeDoe->getEmailDomain();

if (empty($janeDoeEmailDomain)) {
    $janeDoeEmailDomain = 'Invalid';
}
echo "Email Domain: " . $janeDoeEmailDomain . "<br>";

echo "Full Name: " . $johnSmith->getFullName() . "<br>";
echo "Is Adult: " . ($johnSmith->isAdult() ? 'Yes' : 'No') . "<br>";
echo "Email: " . $johnSmith->getEmail() . "<br>";

$johnSmithEmailDomain = $johnSmith->getEmailDomain();

if (empty($johnSmithEmailDomain)) {
    $johnSmithEmailDomain = 'Invalid';
}
echo "Email Domain: " . $johnSmithEmailDomain . "<br>";
```

## Exercice 2a

Réalisez une classe `Vehicle` avec PHP qui représente un véhicule avec les
attributs `numberOfWheels`, `color`, `brand` et `model`.

Implémentez les méthodes suivantes :

- `__construct($numberOfWheels, $color, $brand, $model)` : constructeur pour
  initialiser les attributs.
- Tous les setters et getters pour les attributs `numberOfWheels`, `color`,
  `brand` et `model`.
- `getDescription()` : retourne une description du véhicule sous la forme
  `"Brand Model, Color, Number of wheels"`. Par exemple, pour un véhicule de
  marque `Toyota`, modèle `Corolla`, couleur `Red` et 4 roues, la méthode
  retourne `"Toyota Corolla, Red, 4 wheels"`.
- `type()` : retourne le type de véhicule en fonction du nombre de roues :
  - Si le nombre de roues est 2, retourne `"Motorcycle"`.
  - Si le nombre de roues est 4, retourne `"Car"`.
  - Si le nombre de roues est supérieur à 4, retourne `"Truck"`.
  - Sinon, retourne `"Unknown"`.

Contraintes :

- Utilisez la visibilité `private` pour les attributs.
- Utilisez la visibilité `public` pour les méthodes.

<details>
<summary>Afficher la solution</summary>

```php
<?php
class Vehicle {
    private $numberOfWheels;
    private $color;
    private $brand;
    private $model;

    public function __construct($numberOfWheels, $color, $brand, $model) {
        $this->numberOfWheels = $numberOfWheels;
        $this->color = $color;
        $this->brand = $brand;
        $this->model = $model;
    }

    public function getNumberOfWheels() {
        return $this->numberOfWheels;
    }

    public function setNumberOfWheels($numberOfWheels) {
        $this->numberOfWheels = $numberOfWheels;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getDescription() {
        return "$this->brand $this->model, $this->color, $this->numberOfWheels wheels";
    }

    public function type() {
        if ($this->numberOfWheels == 2) {
            return "Motorcycle";
        } elseif ($this->numberOfWheels == 4) {
            return "Car";
        } elseif ($this->numberOfWheels > 4) {
            return "Truck";
        } else {
            return "Unknown";
        }
    }
}
```

</details>

## Exercice 2b

En utilisant la classe `Vehicle` créée dans l'exercice précédent, instantiez
deux objets `Vehicle` avec les données suivantes :

- Véhicule 1 :
  - Nombre de roues : `4`
  - Couleur : `Red`
  - Marque : `Toyota`
  - Modèle : `Corolla`
- Véhicule 2 :
  - Nombre de roues : `2`
  - Couleur : `Black`
  - Marque : `Yamaha`
  - Modèle : `MT-07`
- Véhicule 3 :
  - Nombre de roues : `6`
  - Couleur : `Blue`
  - Marque : `Volvo`
  - Modèle : `FH16`
- Véhicule 4 :
  - Nombre de roues : `0`
  - Couleur : `Green`
  - Marque : `UFO`
  - Modèle : `X-2000`

Ensuite, effectuez les opérations suivantes :

- Affichez la description de chaque véhicule en utilisant la méthode
  `getDescription()`.
- Affichez le type de chaque véhicule en utilisant la méthode `type()`.

<details>
<summary>Afficher la solution</summary>

```php
<?php
class Vehicle {
    private $numberOfWheels;
    private $color;
    private $brand;
    private $model;

    public function __construct($numberOfWheels, $color, $brand, $model) {
        $this->numberOfWheels = $numberOfWheels;
        $this->color = $color;
        $this->brand = $brand;
        $this->model = $model;
    }

    public function getNumberOfWheels() {
        return $this->numberOfWheels;
    }

    public function setNumberOfWheels($numberOfWheels) {
        $this->numberOfWheels = $numberOfWheels;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getDescription() {
        return "$this->brand $this->model, $this->color, $this->numberOfWheels wheels";
    }

    public function type() {
        if ($this->numberOfWheels == 2) {
            return "Motorcycle";
        } elseif ($this->numberOfWheels == 4) {
            return "Car";
        } elseif ($this->numberOfWheels > 4) {
            return "Truck";
        } else {
            return "Unknown";
        }
    }
}

$toyota = new Vehicle(4, 'Red', 'Toyota', 'Corolla');
$yamaha = new Vehicle(2, 'Black', 'Yamaha', 'MT-07');
$volvo = new Vehicle(6, 'Blue', 'Volvo', 'FH16');
$ufo = new Vehicle(0, 'Green', 'UFO', 'X-2000');

echo $toyota->getDescription() . " - Type: " . $toyota->type() . "<br>";
echo $yamaha->getDescription() . " - Type: " . $yamaha->type() . "<br>";
echo $volvo->getDescription() . " - Type: " . $volvo->type() . "<br>";
echo $ufo->getDescription() . " - Type: " . $ufo->type() . "<br>";
```

</details>
