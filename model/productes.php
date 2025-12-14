<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

    // Obtenemos productos mediante su categoria
    // En la consulta sql tenemos categoria_id=$1
    // Esto cambiara cuando hagamos la consulta
    function getProductesByCategory(int $categoryID, $connexio) : array {
        $sql = "SELECT * FROM producte 
                WHERE categoria_id = $1";
        // Aqui define el valor de la categoria id mediante $categoryID
        
        // pg_query_params envia la consulta junto con los valores
        // de los parametros
        $consulta = pg_query_params($connexio, $sql, [$categoryID]);
        if(!$consulta){
            echo "Error en la consulta a la BBDD per obtenir els productes";
        }
        
        // obtener los resultados y convertirlos en Array, formato API
        $productes = pg_fetch_all($consulta);
        return $productes ? $productes : [];
    }

    //Funcion para obtener los detalles del producto mediante ID
    function getDetallProducte(int $producteID, $connexio): array {
        $sql = "SELECT * FROM producte WHERE id = $1";
        $consulta = pg_query_params($connexio, $sql, [$producteID]);
        $producte = pg_fetch_assoc($consulta);
        return $producte ? $producte : [];
    }

    function getProductes($connexio): array {
        $sql = "SELECT * FROM producte";
        $consult = pg_query($connexio, $sql);

        $resultat = pg_fetch_all($result);

        return $resultat ? $resultat : [];
    }

?>