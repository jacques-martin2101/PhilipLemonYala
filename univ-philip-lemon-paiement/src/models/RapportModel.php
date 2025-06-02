<?php

class Rapport {
    private $id;
    private $etudiantId;
    private $montant;
    private $date;
    private $statut;

    public function __construct($id, $etudiantId, $montant, $date, $statut) {
        $this->id = $id;
        $this->etudiantId = $etudiantId;
        $this->montant = $montant;
        $this->date = $date;
        $this->statut = $statut;
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

    public static function findByEtudiantId($etudiantId) {
        // Logique pour récupérer les rapports de paiement d'un étudiant à partir de la base de données
    }

    public static function findAll() {
        // Logique pour récupérer tous les rapports de paiement à partir de la base de données
    }
}