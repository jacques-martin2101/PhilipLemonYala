<?php
require_once '../src/controllers/EtudiantController.php';
use Controllers\EtudiantController;

$controller = new EtudiantController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->enregistrer();
} else {
    $controller->showForm();
}
?>