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

// Get order ID from URL
$comanda_id = isset($_GET['comanda_id']) ? intval($_GET['comanda_id']) : 0;
if ($comanda_id <= 0) {
    header('Location: index.php');
    exit;
}

$connexio = connectaBD();

// Get order details
$comanda = obtenirComanda($connexio, $comanda_id, $_SESSION['id_usuari']);
if (!$comanda) {
    header('Location: index.php');
    exit;
}

// Get order products
$productes = obtenirProductesComanda($connexio, $comanda_id);

// Load confirmation view
require_once __DIR__ . '/../view/confirmacio_compra.php';
?>