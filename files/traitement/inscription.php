<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $matricule = htmlspecialchars($_POST["matricule"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlentities($_POST["email"]);
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST["role"]);

    $sql = "INSERT INTO utilisateurs (matricule, nom, email, mot_de_passe, role, date_inscription) VALUES (:matricule, :nom, :email, :mot_de_passe, :role, NOW())";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":matricule", $matricule);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":mot_de_passe", $mot_de_passe);
    $stmt->bindParam(":role", $role);

    if ($stmt->execute()) {
        echo "Inscription reussie !";
    }else{
        echo "Erreur lors de l'inscription.";
    }

    if (!headers_sent()){
        header("Location: connexion.php");
        exit();
    }else {
        echo "Redirection impossible, headers deja envoye.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

    <h2>Formulaire d'Inscription</h2>
    <form method="POST">
        <label >Matricule : </label>
        <input type="text" name="matricule" required><br>

        <label >Nom : </label>
        <input type="text" name="nom" required><br>

        <label >Email : </label>
        <input type="email" name="email" required><br>

        <label >Mot de passe : </label>
        <input type="password" name="mot_de_passe" required><br>

        <label>Rôle : </label>
        <select name="role" id="">
            <option value="etudiant">Etudiant</option>
            <option value="admin">Administrateur</option>
        </select><br>

        <button type="submit">Valider</button>
    </form>
    
</body>
</html>