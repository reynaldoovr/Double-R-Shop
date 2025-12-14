<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmació de compra</title>
    <link rel="stylesheet" type="text/css" href="/css/inici.css" title="main"/>
    <link rel="stylesheet" href="../css/confirmacio_compra.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/user_menu.js"></script>
</head>
<body>
    <?php include __DIR__ .'/header_nav.php'; ?>
    
    <div class="confirmacio-container">
        <div class="confirmacio-content">
            <div class="confirmacio-header">
                <h1>¡Gràcies per la teva compra!</h1>
                <p class="order-number">Comanda #<?php echo htmlentities($comanda['id']); ?></p>
            </div>
            
            <div class="order-details">
                <div class="order-info">
                    <h2>Detalls de la comanda</h2>
                    <p><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($comanda['date'])); ?></p>
                    <p><strong>Hora:</strong> <?php echo date('H:i', strtotime($comanda['hora'])); ?></p>
                </div>
                
                <div class="order-items">
                    <h2>Articles comprats</h2>
                    <?php foreach($productes as $producte): ?>
                        <div class="order-item">
                            <div class="item-image">
                                <?php if(!empty($producte['img'])): ?>
                                    <img src="/img/<?php echo htmlentities($producte['img']); ?>" 
                                         alt="<?php echo htmlentities($producte['nom_producte']); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="item-details">
                                <h3><?php echo htmlentities($producte['nom_producte']); ?></h3>
                                <p>Quantitat: <?php echo $producte['quantitat']; ?></p>
                                <p>Preu unitari: <?php echo number_format($producte['preu_unitari'], 2); ?>€</p>
                                <p>Subtotal: <?php echo number_format($producte['preu_total'], 2); ?>€</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="order-total">
                    <h3>Total: <?php echo number_format($comanda['preu_total'], 2); ?>€</h3>
                </div>
            </div>
            
            <div class="confirmacio-actions">
                <a href="index.php?accio=llistar-categories" class="continue-shopping">Continuar comprant</a>
            </div>
        </div>
    </div>
</body>
</html>