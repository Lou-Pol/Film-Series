<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // charge Dotenv

use Dotenv\Dotenv;

// Charge les variables d’environnement
$dotenv = Dotenv::createImmutable(__DIR__ . '/../..'); // adapte si ton .env est à la racine du projet
$dotenv->load();

// Convertit le chemin relatif en absolu
$relativePath = $_ENV['DB_PATH'] ?? 'src/config/sql/Films_Series.db';
$absolutePath = realpath(__DIR__ . '/../../' . $relativePath);

if (!$absolutePath || !file_exists($absolutePath)) {
    die("Erreur : le fichier de base de données n'existe pas à l'emplacement : $absolutePath");
}

try {
    $db = new PDO("sqlite:$absolutePath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
