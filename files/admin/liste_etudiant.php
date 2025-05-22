<?php
// Connexion à la base
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "philip_lemon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Préparation de la requête pour récupérer tous les étudiants
$sql = "SELECT id_etudiant, utilisateurs.nom, utilisateurs.matricule, faculte FROM etudiants
        INNER JOIN utilisateurs ON etudiants.utilisateur_id = utilisateurs.utilisateur_id";
$result = $conn->query($sql);
?>

<h2>Liste des étudiants inscrits</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Matricule</th>
            <th>Faculté</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($etudiant = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                <td><?php echo htmlspecialchars($etudiant['matricule']); ?></td>
                <td><?php echo htmlspecialchars($etudiant['faculte']); ?></td>
                <td>
                    <a href="ajouter_document.php?id_etudiant=<?php echo $etudiant['id_etudiant']; ?>">Ajouter documents</a> |
                    <a href="annuler_inscription.php?id_etudiant=<?php echo $etudiant['id_etudiant']; ?>" style="color:red;">Annuler inscription</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$conn->close();
?>