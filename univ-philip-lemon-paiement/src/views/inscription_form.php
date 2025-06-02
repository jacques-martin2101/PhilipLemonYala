<?php
// Inclure l'en-tête
include_once 'header.php';


?>
<html>
<head>
    <title>Inscription Étudiant</title>
</head>
<body>
    <div class="container">
        <h1>Inscription Étudiant</h1>
        <p>Veuillez remplir le formulaire ci-dessous pour vous inscrire.</p>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div><br>
            <div class="form-group">
                <label for="postnom">Post-nom :</label>
                <input type="text" id="postnom" name="postnom" required>
            </div><br>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div><br>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div><br>
            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" required>
            </div><br>
            <div class="form-group">
                <label for="doc">Dossier :</label>
                <input type="file" id="doc" name="doc" required>
            </div><br>
            <div class="form-group">
                <label for="niveau_etude">Niveau d'Étude :</label>
                <select id="niveau_etude" name="niveau_etude" required>
                    <option value="licence">Licence</option>
                    <option value="master">Master</option>
                    <option value="doctorat">Doctorat</option>
                </select>
            </div><br>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
    <?php if (isset($notification) && $notification): ?>
        <div id="notif" class="notif <?= $type ?>">
            <?= htmlspecialchars($notification) ?>
        </div>
        <script>
            setTimeout(function() {
                var notif = document.getElementById('notif');
                if(notif) notif.style.display = 'none';
            }, 5000);
        </script>
        <style>
            .notif {padding:10px; margin:10px 0; border-radius:5px; font-weight:bold;}
            .notif.success {background:#d4edda; color:#155724;}
            .notif.error {background:#f8d7da; color:#721c24;}
        </style>
    <?php endif; ?>
</body>
</html>