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
    <h2>Formulaire de Paiement</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="nom">Nom de l'Étudiant:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="montant">Montant:</label>
            <input type="number" class="form-control" id="montant" name="montant" required>
            <label for="mode_paiement">Mode de Paiement:</label>
            <select id="mode_paiement" name="mode_paiement" required>
                <option value="carte_bancaire">Carte Bancaire</option>
                <option value="paypal">PayPal</option>
                <option value="virement_bancaire">Virement Bancaire</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date de Paiement:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-primary">Payer</button>
    </form>
</div>

<?php
// Inclure le pied de page
include_once 'footer.php';
?>