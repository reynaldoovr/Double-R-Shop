<?php

//Obtenemos todas las categorias de la BD
function getCategories($connexio): array {
    
    $sql = "SELECT * FROM categoria";
    $consulta = pg_query($connexio, $sql) or die("Error connexio a BD");

    $atributs = pg_fetch_all($consulta);
    pg_close($conn);
    return $atributs ? $atributs : [];
 }

 //Obtenemos el id de la categoria 
 function getCategoryById(int $categoryID, $connexio) : array {
    $sql = "SELECT id, nom FROM categoria WHERE id = $1";
    $consulta = pg_query_params($connexio, $sql, [$categoryID]) or die("Error connexio a BD");
    $resultat = pg_fetch_assoc($consulta);
    return $resultat ? $resultat : [];
 }

 ?>