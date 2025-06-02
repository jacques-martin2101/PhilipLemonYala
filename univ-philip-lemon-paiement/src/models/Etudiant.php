<?php

class Etudiant {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $dateInscription;

    public function __construct($id, $nom, $prenom, $email, $dateInscription) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->dateInscription = $dateInscription;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDateInscription() {
        return $this->dateInscription;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDateInscription($dateInscription) {
        $this->dateInscription = $dateInscription;
    }
}