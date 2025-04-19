<?php
// Connexion a la base de donnees
$ser = "localhost";
$user = "root";
$pass = "";
$db = "philip_lemon";

// Creation d'une connexion
$conn = new mysqli($ser, $user, $pass, $db);


// Verification de la connexion
if ($conn->connect_error) {
    die ("Connection a echoue: " . $conn->connect_error);
}

//Verifier si l'id_etudiant est present dans l'URL
if (isset($_GET['id_etudiant'])){
    $id_etudiant = intval($_GET['id_etudiant']); //securisation avec intval

    // Preparation de la requete pour chercher l'etudiant
    $sql = "SELECT utilisateurs.nom, utilisateurs.matricule 
        FROM etudiants 
        INNER JOIN utilisateurs ON etudiants.utilisateur_id = utilisateurs.utilisateur_id 
        WHERE etudiants.id_etudiant = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_etudiant);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifier si l'etudiant existe
    if ($result->num_rows > 0) {
        $etudiant = $result->fetch_assoc();}

        else {
            echo "Matricule nom trouve.";
            exit();
        }

        $stmt->close();
    } else {
        echo "ID etudiant non specifie.";
        exit();
    }

    $conn->close();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Ajout de documents</title>
        </head>
        <body>
            <h2>Ajout de documents pour 
                <?php 
            echo htmlspecialchars($etudiant['nom']); ?> 
            (Matricule : <?php
            echo htmlspecialchars($etudiant['matricule']); ?>)</h2>
            
            <form action="traitement_ajout_document.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_etudiant" value="<?php echo $id_etudiant; ?>">
                
                <label for="document">Attestation de réussite :</label>
                <input type="file" name="document" id="document" required><br><br>

                <button type="submit">Valider</button>
            </form>

            <?php
            var_dump($id_etudiant);
            ?>
            <!-- Bouton d'annulation -->
            <form>
                <a href="traitement/annulation_inscription.php?id_etudiant=<?php echo $id_etudiant; ?>" name="id_etudiant"
                id="id_etudiant" style="color:red" onclick="return confirm('Etes-vous sûr de vouloir annuler l\'inscription de cet étudiant ?');">
                Annuler l'inscription</a>
            </form>

            <!-- Lien vers la page d'accueil -->
            <p><a href="ajout_etudiant.php">Retour à la page d'accueil</a></p>
            <p><a href="ajout_document.php">Ajouter un autre document</a></p>
        </body>
        </html>

<?php
// Fermer la connexion  
?>