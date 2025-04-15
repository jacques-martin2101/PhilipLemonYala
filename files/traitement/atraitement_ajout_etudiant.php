<?php
include('config.php');//On a inclu le fichier de connexion a la base de donnees

// print_r($_POST);
// exit;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $matricule = $_POST['matricule'];
    $email = $_POST['email'];
    $faculte = $_POST['faculte'];
    $niveau = $_POST['niveau'];
    $status = "en attente"; //par defaut, l'etudiant est en attente

    //Verification si le matricule existe deja
    // var_dump($pdo);
    // echo $pdo;

    $sql = "SELECT * FROM utilisateurs WHERE matricule = ?";

    $check = $pdo->prepare($sql);
    $check->bindParam("s", $matricule);
    $check->execute([$matricule]);
    $result = $check->fetch();
    // var_dump($check);
    // if (!$check->execute()) {
    //     die ("Erreur lors de l'execution de la reauete :" . $check->error);
    // }

   
    // $result = $check->fetch(PDO::FETCH_ASSOC);

    if ($result->num_rows > 0) {
        echo "<script> alert('Ce matricule existe deja !');</script>";
    } else{
        
        $sqls = 
        //insersion de l'utilisateur dans la table 'utilisateurs'
        $insert_user = $pdo->prepare("INSERT INTO utilisateurs (matricule, nom, email, 
        role, date_inscription) VALUES (?, ?, ?, 'etudiant', NOW())");
        $insert_user->bindParam("sss", $matricule, $nom, $email);

        if ($insert_user->execute()) {
            $user_id = $pdo->insert_id;

            //insersion de l'etudiant dans la table 'etudiants'
            $insert_etudiant = $pdo->prepare("INSERT INTO etudiants (utilisateur_id, faculte, niveau, status) VALUES (?, ?, ?, ?)");

            $insert_etudiant->bindParam("isss", $user_id, $faculte, $niveau, $status);

            if ($insert_etudiant->execute()) {
                echo "<script>alert('Etudiant ajoute avec succes !'); </script>";
            }else{
                echo "<script>alert('Erreur lors de l\'ajout de l\'etudiant.'); </script>";
            }
        }else{
            echo "<script>alert('Erreur lors de l\'ajout de l\'utilisateur.'); </script>";
        }
    }
}


?>








<?php

$host = "localhost";

$user = " root";
$pass = "";
$dbname = "philip_lemon";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Errer de connection a la base de donnees: " . $conn->connect_errno);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nom"], $_POST["matricule"], $_POST["email"], $_POST["telephone"], $_POST["date_maissance"])) {

        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $email = htmlspecialchars($_POST["email"]);
        $telephone = htmlspecialchars($_POST["telephone"]);
        $date_naissance = $_POST["date_naissance"];

        $check = $conn->prepare("SELECT id FROM etudiants WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->rum_rows > 0) {
            echo " Un étudiant avec cet email existe déjà.";
        }else{
            $stmt = $conn->prepare("SELECT INTO etudiants (nom, prenom, email, telephone, date_naissance) VALUES (?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("Erreur de préparation : " . $conn->error);
            }

            $stmt->bind_param("sssss", $nom, $prenom, $email, $telephone, $date_naissance);

            if ($stmt->execute()) {
                echo " Etudiant ajouté avec succès.";
            }else{
                echo "Erreur lors de l'ajout : " . $stmt->error;
            }
            $stmt->close();
        }

        $check->close();
    }else{
        echo "Tous les champs sont obligatoires.";
    }

    
}

?>





header("Location : ../ajouter_etudiant.php") ;
            exit() ;

header("Location : ../ajouter_document.php ?matricule=$matricule ") ;
                    exit() ;