  <?php

  require_once __DIR__ .'/../model/connectaBD.php';
  require_once __DIR__ .'/../model/categories.php';
  require_once __DIR__ .'/../model/productes.php';

  $connexio = connectaBD();
  //Obtener el ID de la categoria si está presente en la solicitud
  $categoryID = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

  if ($categoryID <= 0) {
    die("Error, no s'ha trobat la categoria o no existeix ID de la categoria");
  }

  //Obtenemos la categoria 
  $categoria = getCategoryById($categoryID, $connexio);
  if (empty($categoria)) {
    die("No s'ha trobat res en categoria");
  } 

  //Imprimimos los productos de la categoira 
  $productes = getProductesByCategory($categoryID, $connexio);

  require_once __DIR__ .'/../view/productes_categoria.php';
  
?>

