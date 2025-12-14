<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['product_id'];

foreach ($_SESSION['cistella'] as $key => $item) {
    if ($item['product_id'] === $productId) {
        unset($_SESSION['cistella'][$key]);
        break;
    }
}

$_SESSION['cistella'] = array_values($_SESSION['cistella']);
echo json_encode(['success' => true]);
?>c