<?php
// Ce fichier affiche la liste des rapports de paiement

// Inclusion des fichiers nécessaires
require_once '../controllers/RapportController.php';

// Création d'une instance du RapportController
$rapportController = new RapportController();

// Récupération des rapports
$rapports = $rapportController->getRapports();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Rapports de Paiement</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<h1>Liste des Rapports de Paiement</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Étudiant</th>
            <th>Montant</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rapports as $rapport): ?>
            <tr>
                <td><?php echo htmlspecialchars($rapport['id']); ?></td>
                <td><?php echo htmlspecialchars($rapport['etudiant']); ?></td>
                <td><?php echo htmlspecialchars($rapport['montant']); ?></td>
                <td><?php echo htmlspecialchars($rapport['date']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>

</body>
</html>