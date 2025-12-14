<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../model/connectaBD.php';
require_once __DIR__ . '/../model/comandes.php';

// Always set JSON header first
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['id_usuari'])) {
    error_log("User not logged in");
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

// Check if cart is not empty
if (empty($_SESSION['cistella'])) {
    error_log("Cart is empty");
    echo json_encode(['success' => false, 'error' => 'Cart is empty']);
    exit;
}

try {
    $connexio = connectaBD();
    error_log("Database connected");
    
    // Calculate totals
    $preu_total = 0;
    $productes_totals = 0;
    foreach ($_SESSION['cistella'] as $item) {
        $preu_total += $item['preu'] * $item['quantitat'];
        $productes_totals += $item['quantitat'];
    }
    
    error_log("Totals calculated: price = $preu_total, products = $productes_totals");
    
    // Create main order
    $comanda_id = crearComanda($connexio, $_SESSION['id_usuari'], $preu_total, $productes_totals);
    error_log("Order ID returned: " . ($comanda_id ? $comanda_id : "FAILED"));
    
    if ($comanda_id) {
        error_log("Successfully created order with ID: $comanda_id");
        
        // Add each product to the order
        foreach ($_SESSION['cistella'] as $item) {
            error_log("Adding product to order. Product data: " . print_r($item, true));
            
            try {
                $result = crearLiniaComanda(
                    $connexio, 
                    $comanda_id,
                    $item['product_id'],
                    $item['quantitat'],
                    $item['preu'],
                    $item['nom']
                );
                
                error_log("Result of adding product {$item['nom']}: " . ($result ? 'Success' : 'Failed'));
                
                if (!$result) {
                    error_log("Failed to add product. DB Error: " . pg_last_error($connexio));
                    throw new Exception("Failed to add product {$item['nom']} to order");
                }
            } catch (Exception $e) {
                error_log("Exception adding product: " . $e->getMessage());
                throw $e; // Re-throw to be caught by outer try-catch
            }
        }
        
        // If we get here, all products were added successfully
        $_SESSION['cistella'] = [];
        echo json_encode(['success' => true, 'comanda_id' => $comanda_id]);
        
    } else {
        error_log("Failed to create main order");
        throw new Exception("Failed to create order");
    }
    
} catch (Exception $e) {
    error_log("Error in processar_compra: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'error' => $e->getMessage(),
        'debug_info' => [
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]
    ]);
}