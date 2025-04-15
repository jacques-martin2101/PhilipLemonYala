<?php

session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = $_POST['matricule'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM utilisateurs WHERE matricule = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$matricule]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur){
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])){
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['role'] = $utilisateur['role'];
            
            if ($_SESSION['role'] == 'admin'){
                header("Location: ../admin_dashboard.php");
                exit();
            }
            elseif ($_SESSION['role'] === 'etudiant') {
                header("Location: ../index.html");
                echo "Role detecte : " . $_SESSION['role'];
                exit();
            }else{
                echo "Role inconnu.";
            }
        }else {
            echo "Mot de passe incorrecte.";
            }
    }else {
        echo "Matricule introuvable.";
    }
}


?>