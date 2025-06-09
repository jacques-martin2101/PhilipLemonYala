<?php
require_once '../src/controllers/PaiementController.php';
require_once '../src/models/EtudiantModel.php';
require_once '../config/database.php';

use Models\PaiementModel;
use Controllers\PaiementController;
use Models\EtudiantModel;

$paiementController = new PaiementController( $paiementModel = new PaiementModel( $etudiant_id = null, $montant = 0.0 ) );

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['etudiant_id'])) {
    $paiementController->traiterPaiement();
} elseif (isset($_GET['etudiant_id'])) {
    $etudiant = EtudiantModel::getById($conn, $_GET['etudiant_id']);
    if ($etudiant) {
        $paiementController->showFormWithEtudiant($etudiant);
    } else {
        echo "Étudiant introuvable.";
    }
} else {
    echo "Aucun étudiant sélectionné.";
}
?>