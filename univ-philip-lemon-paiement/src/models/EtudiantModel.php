<?php

namespace Models;

class EtudiantModel
{
    private $nom, $postnom, $prenom, $email, $telephone, $doc, $niveau_etude;

    public function __construct($nom, $postnom, $prenom, $email, $telephone, $doc, $niveau_etude)
    {
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
        $stmt = $conn->prepare("INSERT INTO etudiants (nom, postnom, prenom, email, telephone, doc, niveau_etude) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $this->nom, $this->postnom, $this->prenom, $this->email, $this->telephone, $this->doc, $this->niveau_etude);
        return $stmt->execute();
    }

    public static function getAllWithPaiement($conn) {
        $sql = "SELECT e.id, e.nom, e.postnom, e.prenom, e.telephone, e.niveau_etude,
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
}