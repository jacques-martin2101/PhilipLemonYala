<?php
require_once '../src/controllers/RapportController.php';
// Adjust the namespace below to match the actual namespace in RapportController.php
use Controllers\RapportController;

$rapportController = new RapportController( $rapportModel );

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateDebut = $_POST['date_debut'] ?? '';
    $dateFin = $_POST['date_fin'] ?? '';
    $rapports = $rapportController->genererRapport($dateDebut, $dateFin);
} else {
    $rapports = [];
}

include '../src/views/header.php';
?>

<h1>Rapports de Paiement</h1>

<form method="POST" action="rapport.php">
    <label for="date_debut">Date de début:</label>
    <input type="date" id="date_debut" name="date_debut" required>
    
    <label for="date_fin">Date de fin:</label>
    <input type="date" id="date_fin" name="date_fin" required>
    
    <button type="submit">Générer le rapport</button>
</form>

<?php if (!empty($rapports)): ?>
    <h2>Liste des Rapports</h2>
    <table>
        <thead>
            <tr>
                <th>ID Étudiant</th>
                <th>Nom</th>
                <th>Montant</th>
                <th>Date de Paiement</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rapports as $rapport): ?>
                <tr>
                    <td><?php echo htmlspecialchars($rapport['id_etudiant']); ?></td>
                    <td><?php echo htmlspecialchars($rapport['nom']); ?></td>
                    <td><?php echo htmlspecialchars($rapport['montant']); ?></td>
                    <td><?php echo htmlspecialchars($rapport['date_paiement']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include '../src/views/footer.php'; ?>