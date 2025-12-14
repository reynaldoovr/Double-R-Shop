<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../model/connectaBD.php';
require_once __DIR__ . '/../model/comandes.php';

// Check if user is logged in
if (!isset($_SESSION['id_usuari'])) {
    header('Location: index.php?accio=login');
    exit;
}

$connexio = connectaBD();
$comandes = obtenirComandesUsuari($connexio, $_SESSION['id_usuari']);

// Load the view
require_once __DIR__ . '/../view/les_meves_compres.php';
?>