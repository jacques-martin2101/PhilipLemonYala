<?php

$host = "localhost";

$user = "root";
$pass = "";
$dbname = "philip_lemon";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Errer de connection a la base de donnees: " . $conn->connect_errno);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nom"], $_POST["matricule"], $_POST["email"], $_POST["faculte"], $_POST["niveau"])) {

        $nom = htmlspecialchars($_POST["nom"]);
        $matricule = htmlspecialchars($_POST["matricule"]);
        $email = htmlspecialchars($_POST["email"]);
        $faculte = htmlspecialchars($_POST["faculte"]);
        $niveau = $_POST["niveau"];
        $mot_de_passe = password_hash("123456", PASSWORD_BCRYPT);

        $check = $conn->prepare("SELECT id FROM utilisateurs WHERE matricule = ? OR email = ?");
        $check->bind_param("ss", $matricule, $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo " Matricule ou email déjà utilisé.";
        }else{
            $stmt1 = $conn->prepare("INSERT INTO utilisateurs (matricule, nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, 'etudiant')");
            if ($stmt1 === false) 
                die("Erreur de préparation : " . $conn->error);

                $stmt1->bind_param("ssss", $matricule, $nom, $email, $mot_de_passe);
                if ($stmt1->execute()) {
                    $utilisateur_id = $stmt1->insert_id;

                    $stmt2 = $conn->prepare("INSERT INTO etudiants (utilisateur_id, faculte, niveau, status) VALUES (?, ?, ?, 'inscrit')");
                
                    if ($stmt2 === false) 
                        die("Erreur de prepation : " . $conn->error);

                    $stmt2->bind_param("iss", $utilisateur_id, $faculte, $niveau);
                    if ($stmt2->execute()) {
                        $dernier_id = $conn->insert_id;
                        header("Location: ../ajouter_document.php?id_etudiant=" . $dernier_id);
                    exit() ;
                }else {
                    echo "Erreur lors de l'ajoute dans 'etudiants' : " . $stmt2->error;
                }
                $stmt2->close();
            }else{
                echo "Erreur lors de l'ajout 'utilisateurs' : " . $stmt1->error;
            }
            $stmt1->close();
        }

        $check->close();
    }else{
        echo "Tous les champs sont obligatoires.";
    }

    
}



$conn->close();
?>