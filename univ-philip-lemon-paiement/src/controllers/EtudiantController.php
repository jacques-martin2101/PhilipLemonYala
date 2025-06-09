<?php
namespace Controllers;

require_once '../src/models/EtudiantModel.php'; 
require_once '../src/models/PaiementModel.php'; 
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

// Génération automatique du matricule
$prefix = "04062025";
$query = "SELECT COUNT(*) AS total FROM etudiants";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$numero = str_pad($row['total'] + 1, 3, "0", STR_PAD_LEFT);
$matricule = $prefix . $numero;

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
            $etudiant = new EtudiantModel($matricule, $nom, $postnom, $prenom, $email, $telephone, $doc, $niveau_etude);
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

    public function enregistrerPaiement() {
        global $conn;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['etudiant_id']) && isset($_POST['montant'])) {
            $etudiant_id = intval($_POST['etudiant_id']);
            $montant = floatval($_POST['montant']);
            $paiement = new \Models\PaiementModel($etudiant_id, $montant);
            $paiement->enregistrer($conn);
            // Redirection ou message...
        }
    }
}


