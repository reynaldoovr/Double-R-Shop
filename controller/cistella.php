<?php
if(!isset($_SESSION['cistella'])) {
    $_SESSION['cistella'] = [];
}
require_once __DIR__ .'/../view/cistella.php';
?>