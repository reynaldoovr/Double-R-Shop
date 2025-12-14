<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../model/categories.php';
require_once __DIR__ . '/../model/connectaBD.php';

$connexio = connectaBD();
$categories = getCategories($connexio);

require_once __DIR__ . '/../view/llistar_categories.php';
?>