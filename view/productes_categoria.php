<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <title>Productes de la categoria seleccionado</title>
    <link rel="stylesheet" href="../css/productes.css">
    <link rel="stylesheet" type="text/css" href="/css/inici.css" title="main"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="../js/user_menu.js" ></script>
    <script src="../js/productes_categoria.js" ></script>
</head>
<body>
<?php include __DIR__ .'/header_nav.php'; ?>
    <h1>Productes de la categoria: <?php echo htmlspecialchars($categoria['nom']); ?></h1>
    
    <section>
        <?php if(!empty($productes)): ?>
            <div class="product-list">            
                <?php foreach($productes as $producte): ?>   
                    <div class="product-item">
                        <img src="../img/<?php echo htmlentities($producte['img'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>" 
                            alt="<?php echo htmlentities($producte['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">                 
                        <h3><a href="../index.php?accio=detall-producte&product_id=<?php echo htmlentities($producte['id'], ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">
                            <?php echo htmlentities($producte['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></a></h3>
                        <?php if(!empty($producte['descripcio'])):?>
                            <p><?php echo htmlentities($producte['descripcio'], ENT_QUOTES | ENT_HTML5, 'UTF-8');?></p>
                        <?php endif;?>
                        <p class="price">Preu: <?php echo number_format($producte['preu'], 2);?> €</p>
                    </div>                                                                 
                <?php endforeach; ?>
            </div>    
        <?php else: ?>
            <p>No hi ha productes disponibles per a aquesta categoria.</p>
        <?php endif;?>
    </section>
</body>
</html>
