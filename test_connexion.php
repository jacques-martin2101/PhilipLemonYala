<?php

require_once "config.php";

if ($pdo) {
    echo "Connexion réussie à la base de données !";
}
    else {
        echo "Echec de la connexion.";
    }
?>