<?php


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