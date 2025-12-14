<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['cistella'])) {
    $_SESSION['cistella'] = [];
}

$productId = $data['product_id'];
$existeix = false;

foreach ($_SESSION['cistella'] as &$item) {
    if ($item['product_id'] === $productId) {
        $item['quantitat']++;
        $existeix = true;
        break;
    }
}

if (!$existeix) {
    $_SESSION['cistella'][] = [
        'product_id' => $productId,
        'nom' => $data['nom'],
        'preu' => $data['preu'],
        'quantitat' => 1,
        'img' => $data['img']
    ];
}

echo json_encode(['success' => true]);
?>