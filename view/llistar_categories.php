<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset = "utf-8">
        <meta name ="llistar_categories" content="width=device-width, initial-scale=1.0">
        <title> LListar categories </title>
        <link rel="stylesheet" href="../css/llistar_categories.css">
        <link rel="stylesheet" type="text/css" href="/css/inici.css" title="main"/>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<script src="../js/user_menu.js" ></script>        
        <script src="../js/llistar_categories.js" defer></script>
    </head>
    <body>
    <?php include __DIR__ .'/header_nav.php'; ?>
        <!-- <h1> Llistat de categories</h1> -->
        <?php if (!empty($categories)): ?>
            <div class="category-list">
                <?php foreach ($categories as $categoria) : ?>
                    <div class="category-item">
                        <img src="../img/<?php echo htmlentities(strtolower($categoria['nom']), ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>.jpg" 
                            alt="Imatge de <?php echo htmlentities($categoria['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>">
                        <h3><a href="../index.php?accio=llistar-productes&category_id=<?php echo htmlentities($categoria['id'], ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">
                            <?php echo htmlentities($categoria['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></a></h3>
                        <!-- <p><?php echo htmlentities($categoria['descripcio'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p> -->
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p> No hi ha categories per mostrar o en la BBDD.</p>
        <?php endif; ?>    
    </body>
</html>