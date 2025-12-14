<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detall del producte: <?php echo htmlentities($producte['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8');?></title>
        <link rel="stylesheet" href="../css/detall_producte.css">
        <link rel="stylesheet" type="text/css" href="/css/inici.css" title="main"/>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="../js/user_menu.js"></script>
        <script src="/js/cistella.js"></script>
    </head>
    <body>
        <?php include __DIR__ .'/header_nav.php'; ?>           
        <div class="product-details">
            <div class="product-image">
                <?php if(!empty($producte['img'])):?>
                    <img src="/img/<?php echo htmlentities($producte['img'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>" 
                         alt="<?php echo htmlentities($producte['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>">
                <?php endif; ?>
            </div>
            <div class="product-info">
                <h1><?php echo htmlentities($producte['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></h1>
                <?php if (!empty($producte['descripcio'])): ?>
                    <p><?php echo htmlentities($producte['descripcio'], ENT_QUOTES | ENT_HTML5, 'UTF-8');?></p>
                <?php endif; ?>
                <p class="price">Preu: <?php echo number_format($producte['preu'], 2); ?> €</p>
                <button class="buy-button" onclick="afegirACistella(<?php echo $producte['id']; ?>, '<?php echo htmlentities($producte['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>', <?php echo $producte['preu']; ?>, '<?php echo htmlentities($producte['img'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>')">Afegir a la cistella</button>            </div>
        </div>
    </body>
</html>