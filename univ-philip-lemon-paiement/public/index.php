<?php
// Point d'entrée de l'application

require_once '../config/database.php';
require_once '../src/controllers/PaiementController.php';
require_once '../src/controllers/RapportController.php';
require_once '../src/models/PaiementModel.php';
require_once '../src/models/RapportModel.php';

use Controllers\PaiementController;
use Controllers\RapportController;
use Models\PaiementModel;
use Models\RapportModel;

// Récupération du chemin de la requête
$request = basename($_SERVER['SCRIPT_NAME']);

// Gestion des routes
switch ($request) {
    case 'index.php':
    case '':
        // Redirection vers la page de paiement
        header('Location: paiement.php');
        exit;
        $paiementController = new PaiementController( new PaiementModel($montant, $etudiantId));
        $paiementController->showForm();
        break;
    case 'paiement.php':
        $paiementController = new PaiementController( new PaiementModel($montant, $etudiantId));
        $paiementController->showForm();
        break;
    case 'rapport.php':
        $rapportController = new RapportController( new Rapport( $id, $etudiantId, $montant, $date, $status));
        $rapportController->generateReport();
        break;
    default:
        // Page 404
        http_response_code(404);
        echo "404 Not Found";
        break;
}
var_dump($request);
?>