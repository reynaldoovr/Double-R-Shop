<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Empty the cart
$_SESSION['cistella'] = [];

// Send JSON response
header('Content-Type: application/json');
echo json_encode(['success' => true]);