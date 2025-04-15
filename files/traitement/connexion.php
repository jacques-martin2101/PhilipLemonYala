<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

    <h2>Formulaire de connexion</h2>
    <form method="POST" action="traitement_connexion.php">
        <label >Matricule : </label>
        <input type="text" name="matricule" required><br>

        <label >Mot de passe : </label>
        <input type="password" name="mot_de_passe" required><br>

        <button type="submit">Se connecter</button>
    </form>
    
</body>
</html>