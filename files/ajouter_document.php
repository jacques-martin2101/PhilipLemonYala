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
    $sql = "SELECT * FROM etudiants WHERE id = ?";
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
            echo htmlspecialchars($etudiant['id']); ?> 
            (Matricule : <?php
            echo htmlspecialchars($etudiant['faculte']); ?>)</h2>
            
            <form action="traitement_ajout_document.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_etudiant" value="<?php echo $id_etudiant; ?>">
                
                <label for="document">Attestation de réussite :</label>
                <input type="file" name="document" id="document" required><br><br>

                <label for="photo">Photo d'identité :</label>
                <input type="file" name="photo" required><br>

                <button type="submit">Valider</button>
            </form>

            <!-- Bouton d'annulation -->
            <form action="traitement/annulation_inscription.php" method="POST" onsubmit="return confirm('Êtes-vous sûr d’annuler cette inscription ?');">
                <input type="hidden" name="matricule" value="<?= htmlspecialchars($matricule) ?>">
                <button type="submit" style="background-color:red; color:white;">Annuler l'inscription</button>
            </form>
        </body>
        </html>


?>