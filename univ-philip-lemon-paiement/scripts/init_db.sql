CREATE TABLE etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    postnom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telephone VARCHAR(30) NOT NULL,
    doc VARCHAR(255) NOT NULL,
    niveau_etude ENUM('licence', 'master', 'doctorat') NOT NULL,
    date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE paiements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    date_paiement DATETIME NOT NULL,
    FOREIGN KEY (etudiant_id) REFERENCES etudiants(id)
);

CREATE TABLE rapports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    montant_total DECIMAL(10, 2) NOT NULL,
    date_rapport DATETIME NOT NULL,
    FOREIGN KEY (etudiant_id) REFERENCES etudiants(id)
);