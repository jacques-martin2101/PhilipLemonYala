<?php
// Configuration de la base de données
$host = "localhost"; // Adresse du serveur de base de données
$user = "root"; // Nom d'utilisateur de la base de données
$pass = ""; // Mot de passe de la base de données
$dbname = "univ_philip_lemon"; // Nom de la base de données

// Création d'une nouvelle connexion MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>