<?php

class Database {
    const DATABASE_FILE = '../petsmanager.db';

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("sqlite:" . self::DATABASE_FILE);

        $sql = "CREATE TABLE IF NOT EXISTS pets (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            species TEXT NOT NULL,
            nickname TEXT,
            sex TEXT NOT NULL,
            age INTEGER NOT NULL,
            color TEXT,
            personalities TEXT,
            size FLOAT,
            notes TEXT
        );";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }

    public function getPdo() {
        return $this->pdo;
    }
}
