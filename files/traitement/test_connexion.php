<?php

$host = "localhost";

$user = "root";
$pass = "";
$dbname = "philip_lemon";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Errer de connection a la base de donnees: " . $conn->connect_errno);
}else {
    echo "connexion reussie a la base de donnees !";
}

$conn->close();
?>