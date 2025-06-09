<?php
// Formulaire de paiement pour l'Université Philip Lemon

// Inclure l'en-tête
include_once 'header.php';


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement du paiement ici
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $montant = $_POST['montant'];
    $date = $_POST['date'];

    // Logique de traitement du paiement (à implémenter)
    // ...

    // Redirection vers la page de succès après traitement
    header("Location: paiement_success.php");
    exit();
}
?>

<div class="container">
    <h2>Paiement des frais</h2>
    <?php if (isset($etudiant)): ?>
        <h3>Paiement pour : <?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['postnom'] . ' ' . $etudiant['prenom']) ?></h3>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="montant">Montant :</label>
            <select id="montant" name="montant" required>
                <option value="120">120 $</option>
                <option value="200">200 $</option>
                <option value="350">350 $</option>
            </select>
        </div><br>
        
        <button type="submit">Valider le paiement</button>
    </form>
</div>

<?php
// Inclure le pied de page
include_once 'footer.php';
?>