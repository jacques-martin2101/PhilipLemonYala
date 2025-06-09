<?php
// src/controllers/PaiementController.php
namespace App\Controllers;
namespace App\Models;
namespace Controllers;

require_once '../src/models/PaiementModel.php';
require_once '../src/models/EtudiantModel.php';
require_once '../config/database.php';

use Models\PaiementModel;
use Models\EtudiantModel;

class PaiementController {
    private $paiementModel;

    public function __construct($paiementModel) {
        $this->paiementModel = $paiementModel;
    }

    public function showForm($parametres = []) {
        include '../src/views/paiement_form.php';
    }

    public function showFormWithEtudiant($etudiant)
    {
        include '../src/views/paiement_form.php';
    }

    public function traiterPaiement()
    {
        session_start();
        global $conn;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['etudiant_id'])) {
            $etudiant_id = intval($_GET['etudiant_id']);
            $montant = floatval($_POST['montant']);
            

            $paiement = new PaiementModel($etudiant_id, $montant);
            if ($paiement->enregistrer($conn)) {
                $_SESSION['notification'] = "Paiement enregistré avec succès.";
                $_SESSION['notification_type'] = "success";
            } else {
                $_SESSION['notification'] = "Erreur lors de l'enregistrement du paiement.";
                $_SESSION['notification_type'] = "error";
            }
            header("Location: paiement.php?etudiant_id=" . $etudiant_id);
            exit;
        }
    }

    private function validerDonnees($data) {
        // Implémenter la logique de validation des données
        return true; // Placeholder pour la validation
    }
}