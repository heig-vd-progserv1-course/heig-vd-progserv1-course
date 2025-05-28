<?php

class Pet {
    const SPECIES = [
        'dog' => 'Chien',
        'cat' => 'Chat',
        'lizard' => 'Lézard',
        'snake' => 'Serpent',
        'bird' => 'Oiseau',
        'rabbit' => 'Lapin',
        'other' => 'Autre'
    ];

    const SEX = [
        'male' => 'Mâle',
        'female' => 'Femelle'
    ];

    private $name;
    private $species;
    private $nickname;
    private $sex;
    private $age;
    private $color;
    private $personalities;
    private $size;
    private $notes;

    public function __construct(
        $name,
        $species,
        $nickname,
        $sex,
        $age,
        $color,
        $personalities,
        $size,
        $notes
    ) {
        $this->name = $name;
        $this->species = $species;
        $this->nickname = $nickname;
        $this->sex = $sex;
        $this->age = $age;
        $this->color = $color;
        $this->personalities = $personalities;
        $this->size = $size;
        $this->notes = $notes;
    }

    public function validate() {
        $errors = [];

        if (empty($this->name)) {
            array_push($errors, "Le nom est obligatoire.");
        }

        if (strlen($this->name) < 2) {
            array_push($errors, "Le nom doit contenir au moins 2 caractères.");
        }

        if (empty($this->species)) {
            array_push($errors, "L'espèce est obligatoire.");
        }

        if (!array_key_exists($this->species, self::SPECIES)) {
            array_push($errors, "L'espèce sélectionnée n'est pas valide.");
        }

        if (empty($this->sex)) {
            array_push($errors, "Le sexe est obligatoire.");
        }

        if (!array_key_exists($this->sex, self::SEX)) {
            array_push($errors, "Le sexe sélectionné n'est pas valide.");
        }

        if (empty($this->age)) {
            array_push($errors, "L'âge est obligatoire.");
        }

        if (!is_numeric($this->age) || $this->age < 0) {
            array_push($errors, "L'âge doit être un nombre entier positif.");
        }

        if (!empty($this->size) && (!is_numeric($this->size) || $this->size < 0)) {
            array_push($errors, "La taille doit être un nombre entier positif.");
        }

        return $errors;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSpecies() {
        return $this->species;
    }

    public function setSpecies($species) {
        $this->species = $species;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function getSex() {
        return $this->sex;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getPersonalities() {
        return $this->personalities;
    }

    public function setPersonalities($personalities) {
        $this->personalities = $personalities;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }
    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }
}
