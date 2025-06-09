<?php

namespace Models;

class EtudiantModel
{
    private $matricule, $nom, $postnom, $prenom, $email, $telephone, $doc, $niveau_etude;

    public function __construct($matricule, $nom, $postnom, $prenom, $email, $telephone, $doc, $niveau_etude)
    {
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->postnom = $postnom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->doc = $doc;
        $this->niveau_etude = $niveau_etude;
    }

    public function enregistrer($conn)
    {
        $stmt = $conn->prepare("INSERT INTO etudiants (matricule, nom, postnom, prenom, email, telephone, doc, niveau_etude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $this->matricule, $this->nom, $this->postnom, $this->prenom, $this->email, $this->telephone, $this->doc, $this->niveau_etude);
        return $stmt->execute();
    }

    public static function getAllWithPaiement($conn) {
        $sql = "SELECT e.id, e.matricule, e.nom, e.postnom, e.prenom,e.email, e.telephone, e.niveau_etude,
                       CASE WHEN p.id IS NOT NULL THEN 'Payé' ELSE 'Non payé' END AS frais
                FROM etudiants e
                LEFT JOIN paiements p ON e.id = p.etudiant_id";
        $result = $conn->query($sql);
        $etudiants = [];
        while ($row = $result->fetch_assoc()) {
            $etudiants[] = $row;
        }
        return $etudiants;
    }

    public static function getById($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM etudiants WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}