# Projet de Paiement des Frais Académiques à l'Université Philip Lemon

Ce projet est une application web développée en PHP pour gérer le paiement des frais académiques des étudiants de l'Université Philip Lemon. L'application permet aux étudiants de soumettre leurs paiements et de générer des rapports de paiement.

## Structure du Projet

```
univ-philip-lemon-paiement
├── public
│   ├── index.php
│   ├── paiement.php
│   ├── rapport.php
│   └── assets
│       ├── css
│       │   └── style.css
│       └── js
│           └── main.js
├── src
│   ├── controllers
│   │   ├── PaiementController.php
│   │   └── RapportController.php
│   ├── models
│   │   ├── Etudiant.php
│   │   ├── Paiement.php
│   │   └── Rapport.php
│   └── views
│       ├── header.php
│       ├── footer.php
│       ├── paiement_form.php
│       ├── paiement_success.php
│       └── rapport_liste.php
├── config
│   └── database.php
├── scripts
│   └── init_db.sql
├── .gitignore
└── README.md
```

## Installation

1. Clonez le dépôt sur votre machine locale.
2. Accédez au dossier du projet.
3. Configurez votre base de données en utilisant le fichier `scripts/init_db.sql`.
4. Modifiez le fichier `config/database.php` pour y insérer vos informations de connexion à la base de données.
5. Lancez un serveur web local (comme XAMPP ou MAMP) et accédez à `http://localhost/univ-philip-lemon-paiement/public/index.php`.

## Utilisation

- **Page de Paiement**: Accédez à `paiement.php` pour soumettre un paiement.
- **Rapports de Paiement**: Accédez à `rapport.php` pour générer et afficher les rapports de paiement.

## Technologies Utilisées

- PHP
- MySQL
- HTML/CSS
- JavaScript

## Contributeurs

- [Votre Nom] - Développeur principal

## License

Ce projet est sous licence MIT. Veuillez consulter le fichier LICENSE pour plus de détails.