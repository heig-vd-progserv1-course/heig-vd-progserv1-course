<?php

class Database {
    // On définit la constante `DATABASE_FILE` pour le chemin vers le fichier de base de données SQLite
    const DATABASE_FILE = '../petsmanager.db';

    // On crée une instance de PDO pour se connecter à la base de données
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("sqlite:" . self::DATABASE_FILE);
    }

    public function getPdo() {
        return $this->pdo;
    }
}
