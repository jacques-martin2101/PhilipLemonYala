<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Réussi</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php 
    include 'header.php'; 
    include_once '../src/controllers/PaiementController.php';
    include_once '../src/models/PaiementModel.php';
    include_once 'header.php';
?>
    
    <div class="container">
        <h1>Paiement Réussi</h1>
        <p>Merci pour votre paiement. Votre transaction a été traitée avec succès.</p>
        <a href="paiement.php">Retourner au formulaire de paiement</a>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>