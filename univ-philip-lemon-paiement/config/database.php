<?php
// Configuration de la base de données
$host = 'localhost'; // Adresse du serveur de base de données
$dbname = 'univ_philip_lemon'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur de la base de données
$password = ''; // Mot de passe de la base de données

try {
    // Création d'une nouvelle connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur de PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
?>