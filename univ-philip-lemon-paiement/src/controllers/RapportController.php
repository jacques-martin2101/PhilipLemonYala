<?php
namespace App\Controllers;
namespace App\Models;
namespace Controllers;

class RapportController {
    private $rapportModel;

    public function __construct($rapportModel) {
        $this->rapportModel = $rapportModel;
    }
    public function generateReport( )
    {
        // Implémentation de la génération du rapport
        echo "Rapport généré avec succès.";
    }

    public function afficherRapports() {
        $rapports = $this->rapportModel->getAllRapports();
        include '../views/rapport_liste.php';
    }

    public function genererRapport($etudiantId) {
        $rapport = $this->rapportModel->getRapportByEtudiantId($etudiantId);
        if ($rapport) {
            // Logique pour générer le rapport
            include '../views/rapport_detail.php'; // Assurez-vous d'avoir ce fichier pour afficher le rapport
        } else {
            // Gérer le cas où aucun rapport n'est trouvé
            echo "Aucun rapport trouvé pour cet étudiant.";
        }
    }
}