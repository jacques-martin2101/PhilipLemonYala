<?php
// Point d'entrée de l'application

require_once '../config/database.php';
require_once '../src/controllers/PaiementController.php';
require_once '../src/controllers/RapportController.php';
require_once '../src/models/PaiementModel.php';
require_once '../src/models/RapportModel.php';
require_once '../src/controllers/EtudiantController.php';
require_once '../src/models/EtudiantModel.php';
use Controllers\EtudiantController;
use Models\EtudiantModel;

use Controllers\PaiementController;
use Controllers\RapportController;
use Models\PaiementModel;
use Models\RapportModel;

// Récupération du chemin de la requête
$request = basename($_SERVER['SCRIPT_NAME']);

// Gestion des routes
switch ($request) {
    case 'index.php':
    case '': // Page d'accueil
        // Redirection vers la page d'accueil
        header('Location: inscription.php');
        exit;
    case 'paiement.php':       
        $paiementController = new PaiementController( new PaiementModel($montant, $etudiantId));
        $paiementController->showForm();
        break;
    case 'inscription.php':
        // Redirection vers la page d'inscription
        header('Location: inscription_form.php');
        exit;
        $inscriptionController = new EtudiantController( new EtudiantModel($matricule, $nom, $postnom, $prenom, $email, $telephone, $doc, $niveau_etude));
        $inscriptionController->showForm();
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