<?php
require_once '../src/controllers/PaiementController.php';
require_once '../src/models/PaiementModel.php';

use Models\PaiementModel;
use Controllers\PaiementController;

$paiementModel = new PaiementModel();
$paiementController = new PaiementController($paiementModel);
$paiementController->showForm();
?>