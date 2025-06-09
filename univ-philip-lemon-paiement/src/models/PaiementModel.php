<?php
namespace Models;


class Paiement {
    private $id;
    private $etudiantId;
    private $montant;
    private $date;
    private $statut;

    public function __construct($etudiantId, $montant) {
        $this->etudiantId = $etudiantId;
        $this->montant = $montant;
        $this->date = date('Y-m-d H:i:s');
        $this->statut = 'en attente';
    }

    public function getId() {
        return $this->id;
    }

    public function getEtudiantId() {
        return $this->etudiantId;
    }

    public function getMontant() {
        return $this->montant;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    public function save() {
        // Logique pour enregistrer le paiement dans la base de données
    }

    public static function findById($id) {
        // Logique pour trouver un paiement par ID dans la base de données
    }

    public static function findByEtudiantId($etudiantId) {
        // Logique pour trouver tous les paiements d'un étudiant par ID
    }
}

class PaiementModel {
    public $etudiant_id;
    public $montant;

    public function __construct($etudiant_id, $montant) {
        $this->etudiant_id = $etudiant_id;
        $this->montant = $montant;
    }

    public function enregistrer($conn) {
        $stmt = $conn->prepare("INSERT INTO paiements (etudiant_id, montant) VALUES (?, ?)");
        $stmt->bind_param("id", $this->etudiant_id, $this->montant);
        return $stmt->execute();
    }
}
