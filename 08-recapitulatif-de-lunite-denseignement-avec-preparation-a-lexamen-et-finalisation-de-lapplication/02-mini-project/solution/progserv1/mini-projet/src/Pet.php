<?php

class Pet {
    private $name;
    private $species;
    private $nickname;
    private $sex;
    private $age;
    private $color;
    private $personalities;
    private $size;
    private $notes;

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

    const PERSONALITIES = [
        'gentil' => 'Gentil',
        'playful' => 'Joueur',
        'curious' => 'Curieux',
        'lazy' => 'Paresseux',
        'scared' => 'Peureux',
        'aggressive' => 'Agressif'
    ];

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
