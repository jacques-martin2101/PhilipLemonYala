<?php
include_once 'header.php'; ?>
<h2>Liste des étudiants</h2>
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Nom complet</th>
            <th>Matricule</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Niveau d'étude</th>
            <th>Frais</th>
            
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['postnom'] . ' ' . $etudiant['prenom']) ?></td>
                <td><?= htmlspecialchars($etudiant['matricule']) ?></td>
                <td><?= htmlspecialchars($etudiant['email']) ?></td>
                <td><?= htmlspecialchars($etudiant['telephone']) ?></td>
                <td><?= htmlspecialchars($etudiant['niveau_etude']) ?></td>
                <td>
                    <?= htmlspecialchars($etudiant['frais']) ?>
                </td>
                
                <td>
                    <?php if ($etudiant['frais'] === 'Non payé'): ?>
                        <a href="paiement.php?etudiant_id=<?= urlencode($etudiant['id']) ?>" class="btn btn-primary">Payer</a>
                    <?php endif; ?>
                    <a href="details_etudiant.php?id=<?= $etudiant['id'] ?>">Détails</a>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>