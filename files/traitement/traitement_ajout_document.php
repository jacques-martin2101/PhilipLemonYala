<?php

// Connexion a la base de donnees
$ser = "localhost";
$user = "root";
$pass = "";
$db = "philip_lemon";

// Creation d'une connexion
$conn = new mysqli($ser, $user, $pass, $db);


// Verification de la connexion
if ($conn->connect_error) {
    die ("Connection a echoue: " . $conn->connect_error);
}


// Verifier que le formulaire a bien ete soumis et qu'un fichier est present
if (isset($_POST['id_etudiant']) && isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
    $id_etudiant = intval($_POST['id_etudiant']);

    // Dossier ou stocker les fichiers
    $dossier_upload = "uploads/";
    if (!is_dir($dossier_upload)) {
        mkdir($dossier_upload, 0777, true);
    }
    
    // Recuperation des infos du fichier
    $nom_fichier = basename($_FILES['document']['name']);
    $chemin_fichier = $dossier_upload . $nom_fichier;

    // Deplacement du fichier uploade
    if (move_uploaded_file($_FILES['document']['tmp_name'], $chemin_fichier)) {
        // Insertion dans la base de donnees
        $stmt = $conn->prepare("INSERT INTO documents (id_etudiant, chemin_document) VALUES (?, ?)");
        $stmt->bind_param("is", $id_etudiant, $chemin_fichier);
        
        if ($stmt->execute()) {
            echo "Document ajoute avec succes !";
        } else {
            echo "Erreur lors de l'enregistrement en base de donnees.";
        }

        $stmt->close();
    } else {
        echo "Erreur lors du telechargement du fichier.";
    }
} else {
    echo "Aucun fichier selectionne ou donnees incompletes.";
}

?>