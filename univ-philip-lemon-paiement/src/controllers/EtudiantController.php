<?php
namespace Controllers;

require_once '../src/models/EtudiantModel.php'; 
require_once '../config/database.php';

use Models\EtudiantModel;

class EtudiantController {
    public function showForm() {
        // Affiche la notification si elle existe
        session_start();
        $notification = isset($_SESSION['notification']) ? $_SESSION['notification'] : '';
        $type = isset($_SESSION['notification_type']) ? $_SESSION['notification_type'] : '';
        // On efface la notification après affichage
        unset($_SESSION['notification'], $_SESSION['notification_type']);
        include '../src/views/inscription_form.php';
    }

    public function enregistrer() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            global $conn;
            // Récupération des données
            $nom = htmlspecialchars($_POST['nom']);
            $postnom = htmlspecialchars($_POST['postnom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $telephone = htmlspecialchars($_POST['telephone']);
            $niveau_etude = htmlspecialchars($_POST['niveau_etude']);

            // Vérification email ou téléphone déjà utilisé
            $stmt = $conn->prepare("SELECT id FROM etudiants WHERE email = ? OR telephone = ?");
            $stmt->bind_param("ss", $email, $telephone);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $_SESSION['notification'] = "L'adresse email ou le numéro de téléphone est déjà utilisé.";
                $_SESSION['notification_type'] = "error";
                header("Location: inscription.php");
                exit;
            }
            $stmt->close();

            // Gestion de l'upload du dossier
            $doc = '';
            if (isset($_FILES['doc']) && $_FILES['doc']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = uniqid() . '_' . basename($_FILES['doc']['name']);
                $uploadFile = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['doc']['tmp_name'], $uploadFile)) {
                    $doc = $fileName;
                } else {
                    $_SESSION['notification'] = "Erreur lors de l'upload du dossier.";
                    $_SESSION['notification_type'] = "error";
                    header("Location: inscription.php");
                    exit;
                }
            } else {
                $_SESSION['notification'] = "Veuillez sélectionner un dossier à uploader.";
                $_SESSION['notification_type'] = "error";
                header("Location: inscription.php");
                exit;
            }

            // Création du modèle et insertion
            $etudiant = new EtudiantModel($nom, $postnom, $prenom, $email, $telephone, $doc, $niveau_etude);
            if ($etudiant->enregistrer($conn)) {
                $_SESSION['notification'] = "L'enregistrement a réussi !";
                $_SESSION['notification_type'] = "success";
            } else {
                $_SESSION['notification'] = "Échec de l'enregistrement.";
                $_SESSION['notification_type'] = "error";
            }
            header("Location: inscription.php");
            exit;
        }
    }

    public function liste() {
        global $conn;
        $etudiants = EtudiantModel::getAllWithPaiement($conn);
        include '../src/views/etudiants_liste.php';
    }
}


