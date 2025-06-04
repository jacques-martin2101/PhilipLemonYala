<?php
require_once '../src/controllers/EtudiantController.php';

use Controllers\EtudiantController;

$controller = new EtudiantController();
$controller->liste();