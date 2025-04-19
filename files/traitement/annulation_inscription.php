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

//Verifier si l'id_etudiant est transmis
if (isset($_GET['id_etudiant']) && !empty($_GET['id_etudiant']) && is_numeric($_GET['id_etudiant'])) {
    // Preparation de la requete pour chercher l'etudiant
    $id_etudiant = intval($_GET['id_etudiant']); //securisation avec intval

    //Recuperer les documents associes a l'etudiant
    $sql_docs = "SELECT chemin_document FROM documents WHERE id_etudiant = ?";
    $stmt_docs = $conn->prepare($sql_docs);
    $stmt_docs->bind_param("i", $id_etudiant);
    $stmt_docs->execute();
    $result_docs = $stmt_docs->get_result();

    while ($doc = $result_docs->fetch_assoc()) {
        echo "<a href='" . htmlspecialchars($doc['chemin_document']) . "'>" . htmlspecialchars($doc['chemin_document']) . "</a><br>";
    
        // Suppression du document de la base de donnees
        if (!empty($row['chemin_document']) && file_exists($row['chemin_document'])) {
            unlink($row['chemin_document']); // Suppression du fichier
        }
    }
    $stmt_docs->close();

    //Supprimer les documents associes
    $sql_delete_docs = "DELETE FROM documents WHERE id_etudiant = ?";
    $stmt_delete_docs = $conn->prepare($sql_delete_docs);
    $stmt_delete_docs->bind_param("i", $id_etudiant);
    $stmt_delete_docs->execute();
    $stmt_delete_docs->close();

    // Suppression de l'etudiant de la base de donnees
    $sql_delete_etudiant = "DELETE FROM etudiants WHERE id_etudiant = ?";
    $stmt_delete_etudiant = $conn->prepare($sql_delete_etudiant);
    $stmt_delete_etudiant->bind_param("i", $id_etudiant);
    
    if ($stmt_delete_etudiant->execute()) {
        // Redirection vers la page d'ajout d'etudiant avec un message de confirmation
        header("Location: ../ajouter_etudiant.php?message=Inscription annulée.");
        exit();
    } else {
        echo "Erreur lors de l'annulation de l'inscription : " . $stmt_delete_etudiant->error;
    }
    $stmt_delete_etudiant->close();
} else {
    var_dump($_GET);
    echo "ID etudiant non spécifié.";
    exit();
}
var_dump($_GET);
// Fermer la connexion
$conn->close();
?>
