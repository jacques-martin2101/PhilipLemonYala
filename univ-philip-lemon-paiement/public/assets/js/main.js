// main.js - Ce fichier contient le code JavaScript pour les interactions côté client.

document.addEventListener('DOMContentLoaded', function() {
    const paiementForm = document.getElementById('paiement-form');
    
    if (paiementForm) {
        paiementForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // Logique de validation et soumission du formulaire
            const formData = new FormData(paiementForm);
            fetch('paiement.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'paiement_success.php';
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    }
});