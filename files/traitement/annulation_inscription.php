<?php
Include('config.php') ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = $_POST['matricule'] ;

    // Supprimer l’étudiant de la base de données
    $sql = "DELETE FROM etudiants WHERE matricule='$matricule' " ;
    if ($conn->query($sql) === TRUE) {
    header("Location : ajout_etudiant.php ?message=Inscription annulée. ") ;
        exit() ;
    } else {
        echo " Erreur lors de l’annulation : "  . $conn->error ;
    }
}
?>
