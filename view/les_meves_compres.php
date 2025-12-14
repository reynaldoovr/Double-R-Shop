<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Meves Compres</title>
    <link rel="stylesheet" type="text/css" href="/css/inici.css" title="main"/>
    <link rel="stylesheet" href="../css/les_meves_compres.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/user_menu.js"></script>
</head>
<body>
    <?php include __DIR__ .'/header_nav.php'; ?>

    <div class="compres-container">
        <h1>Les Meves Compres</h1>
        
        <?php if (!empty($comandes)): ?>
            <div class="compres-list">
                <?php foreach($comandes as $comanda): ?>
                    <div class="compra-item">
                        <div class="compra-header">
                            <div class="compra-info">
                                <h3>Comanda #<?php echo htmlspecialchars($comanda['id']); ?></h3>
                                <p class="date">Data: <?php echo date('d/m/Y', strtotime($comanda['date'])); ?></p>
                                <p class="time">Hora: <?php echo date('H:i', strtotime($comanda['hora'])); ?></p>
                            </div>
                            <div class="compra-total">
                                <p class="price">Total: <?php echo number_format($comanda['preu_total'], 2); ?>€</p>
                                <p class="items">Total productes: <?php echo $comanda['productes_totals']; ?></p>
                            </div>
                        </div>
                        
                        <?php if (!empty($comanda['productes'])): ?>
                            <div class="productes-list">
                                <h4>Productes de la comanda:</h4>
                                <?php foreach($comanda['productes'] as $producte): ?>
                                    <div class="producte-item">
                                        <div class="producte-img">
                                            <?php if(!empty($producte['img'])): ?>
                                                <img src="/img/<?php echo htmlspecialchars($producte['img']); ?>" 
                                                     alt="<?php echo htmlspecialchars($producte['nom']); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="producte-info">
                                            <h5><?php echo htmlspecialchars($producte['nom']); ?></h5>
                                            <p>Quantitat: <?php echo htmlspecialchars($producte['quantitat']); ?></p>
                                            <p>Preu unitari: <?php echo number_format($producte['preu'], 2); ?>€</p>
                                            <p>Subtotal: <?php echo number_format($producte['preu'] * $producte['quantitat'], 2); ?>€</p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-compres">Encara no has fet cap compra</p>
        <?php endif; ?>
    </div>
</body>
</html>