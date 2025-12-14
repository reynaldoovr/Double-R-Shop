<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>La meva cistella</title>
   <link rel="stylesheet" href="../css/cistella.css">
   <link rel="stylesheet" type="text/css" href="/css/inici.css" title="main"/>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="../js/user_menu.js"></script>
   <script src="../js/cistella.js"></script>
</head>
<body>
   <?php include __DIR__ .'/header_nav.php'; ?>
   <div class="cistella-container">
       <h1>La meva cistella</h1>
       <?php if (!empty($_SESSION['cistella'])): ?>
           <?php 
               $total = 0;
               foreach($_SESSION['cistella'] as $item) {
                   $total += $item['preu'] * $item['quantitat'];
               }
           ?>
           <div class="cistella-items">
               <?php foreach($_SESSION['cistella'] as $item): ?>
                   <div class="cistella-item">
                       <div class="cistella-content">
                           <div class="cistella-item-image">
                               <?php if(!empty($item['img'])): ?>
                                   <img src="/img/<?php echo htmlentities($item['img'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>" 
                                       alt="<?php echo htmlentities($item['nom'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>">
                               <?php endif; ?>
                           </div>
                           <div class="cistella-item-details">
                               <h3><?php echo htmlentities($item['nom'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></h3>
                               <p class="price">Preu: <?php echo number_format((float)$item['preu'], 2); ?>€</p>
                               <p class="quantity">Quantitat: <?php echo $item['quantitat']; ?></p>
                               <p class="subtotal">Total: <?php echo number_format((float)($item['preu'] * $item['quantitat']), 2); ?>€</p>
                           </div>
                       </div>
                       <!-- <button onclick="eliminarDeCistella(<?php echo $item['product_id']; ?>)" class="delete-button">
                           <span class="delete-icon">×</span>
                           Eliminar
                       </button> -->
                   </div>
               <?php endforeach; ?>
               <div class="cistella-total">
                    <h3>Total: <?php echo number_format((float)$total, 2); ?>€</h3>
                    <div class="cistella-buttons">
                        <button onclick="buidarCistella()" class="delete-button">
                            <span class="delete-icon">×</span>
                            Buidar Cistella
                        </button>
                        <?php if(isset($_SESSION['id_usuari'])): ?>
                            <button id="finalitzar-btn" class="purchase-button">
                                Finalitzar Compra
                            </button>
                        <?php else: ?>
                            <p class="login-warning">Has d'iniciar sessió per finalitzar la compra</p>
                            <a href="index.php?accio=login" class="login-button">Iniciar Sessió</a>
                        <?php endif; ?>
                    </div>
                </div>
       <?php else: ?>
           <p class="empty-cart">La teva cistella està buida</p>
       <?php endif; ?>
   </div>
</body>
<?php
error_log("Current cart contents:");
error_log(print_r($_SESSION['cistella'], true));
?>
</html>