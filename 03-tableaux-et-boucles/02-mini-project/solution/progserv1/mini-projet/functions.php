<?php

// On crée un tableau vide pour stocker les animaux
// Il s'agit d'une variable globale - n'importe qui peut y accéder
// Même si c'est une mauvaise pratique, c'est nécessaire ici
$pets = [];

function getPets() {
    // On utilise le mot-clé `global` pour accéder à la variable `$pets`
    // Même si c'est une mauvaise pratique, c'est nécessaire ici
    global $pets;

    // On retourne tous les animaux
    return $pets;
}

function getPet($name) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pets`
    // Même si c'est une mauvaise pratique, c'est nécessaire ici
    global $pets;

    // On vérifie si l'animal existe bien
    if (array_key_exists($name, $pets)) {
        // Si l'animal existe, on le retourne
        return $pets[$name];
    } else {
        // Si l'animal n'existe pas, on retourne `false`
        return false;
    }
}

function addPet($name, $age) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pets`
    // Même si c'est une mauvaise pratique, c'est nécessaire ici
    global $pets;

    // On ajoute l'animal au tableau $pets
    // On utilise le nom de l'animal comme clé
    // et un tableau associatif comme valeur
    // contenant le nom et l'âge de l'animal
    $pets[$name] = [
        'name' => $name,
        'age' => $age
    ];

    // On retourne l'animal ajouté
    return $pets[$name];
}

function updatePet($name, $age) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pets`
    // Même si c'est une mauvaise pratique, c'est nécessaire ici
    global $pets;

    // On vérifie si l'animal existe bien
    if (array_key_exists($name, $pets)) {
        // Si l'animal existe, on le récupère
        $pet = $pets[$name];

        // On met à jour l'âge de l'animal
        $pet['age'] = $age;

        // On met à jour l'animal dans le tableau $pets
        $pets[$name] = $pet;

        // On retourne l'animal mis à jour
        return $pet;
    } else {
        // Si l'animal n'existe pas, on retourne `false`
        return false;
    }
}

function removePet($name) {
    // On utilise le mot-clé `global` pour accéder à la variable `$pets`
    // Même si c'est une mauvaise pratique, c'est nécessaire ici
    global $pets;

    // On récupère l'animal
    $pet = $pets[$name];

    // On vérifie si l'animal existe bien
    if (array_key_exists($name, $pets)) {
        // Si l'animal existe, on le supprime du tableau $pets
        unset($pets[$name]);

        // On retourne `true` pour indiquer que la suppression a réussi
        return true;
    } else {
        // Si l'animal n'existe pas, on retourne `false`
        return false;
    }
}
