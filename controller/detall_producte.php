<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
require_once __DIR__ .'/../model/connectaBD.php';
require_once __DIR__ .'/../model/categories.php';
require_once __DIR__ .'/../model/productes.php';

$connexio = connectaBD();
$producteID = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
if ($producteID <= 0) {
    die("Error, no s'ha trobat el product o no existeix ID");
}

$producte = getDetallProducte($producteID , $connexio);
if(empty($producte)){
    die("No s'ha trobat cap producte amb la ID proporcionada.");

}

require_once __DIR__ .'/../view/detall_producte.php';
?>

