<?php
function crearComanda($connexio, $id_usuari, $preu_total, $productes_totals) {
    try {
        error_log("Creating order with: id_usuari=$id_usuari, preu_total=$preu_total, productes_totals=$productes_totals");
        
        $sql = "INSERT INTO comanda (id_usuari, date, preu_total, hora, productes_totals) 
                VALUES ($1, CURRENT_DATE, $2, CURRENT_TIMESTAMP, $3) 
                RETURNING id";
                
        $consulta = pg_query_params($connexio, $sql, array(
            $id_usuari, 
            $preu_total, 
            $productes_totals
        ));
        
        if(!$consulta) {
            error_log("SQL Error: " . pg_last_error($connexio));
            return false;
        }
        
        $resultat = pg_fetch_assoc($consulta);
        error_log("Order created with ID: " . ($resultat['id'] ?? 'null'));
        return $resultat['id'];
        
    } catch (Exception $e) {
        error_log("Error in crearComanda: " . $e->getMessage());
        return false;
    }
}

function crearLiniaComanda($connexio, $id_comanda, $id_producte, $quantitat) {
    try {
        // Insert into details_comanda
        $sql = "INSERT INTO detalls_comanda (id_comanda, id_producte, quantitat) 
                VALUES ($1, $2, $3)";
        
        $consulta = pg_query_params($connexio, $sql, array(
            $id_comanda,
            $id_producte,
            $quantitat
        ));

        if(!$consulta) {
            error_log("SQL Error: " . pg_last_error($connexio));
            return false;
        }

        return true;
        
    } catch (Exception $e) {
        error_log("Error in crearLiniaComanda: " . $e->getMessage());
        return false;
    }
}



function obtenirProductesComanda($connexio, $id_comanda) {
    try {
        $sql = "SELECT d.*, p.nom, p.img, p.preu 
                FROM detalls_comanda d 
                JOIN producte p ON d.id_producte = p.id 
                WHERE d.id_comanda = $1";
        
        $consulta = pg_query_params($connexio, $sql, array($id_comanda));
        
        if(!$consulta) {
            error_log("Error getting order products: " . pg_last_error($connexio));
            return array();
        }
        
        return pg_fetch_all($consulta);
    } catch (Exception $e) {
        error_log("Error in obtenirProductesComanda: " . $e->getMessage());
        return array();
    }
}

function afegirProducteComanda($connexio, $comanda_id, $producte_id, $quantitat, $preu_unitari) {
    try {
        $sql = "INSERT INTO comanda_producte (comanda_id, producte_id, quantitat, preu_unitari) 
                VALUES ($1, $2, $3, $4)";
        
        $consulta = pg_query_params($connexio, $sql, array($comanda_id, $producte_id, $quantitat, $preu_unitari));
        return $consulta !== false;
    } catch (Exception $e) {
        return false;
    }
}

function obtenirComanda($connexio, $comanda_id, $usuari_id) {
    $sql = "SELECT c.*, u.nom as nom_usuari 
            FROM comanda c 
            JOIN usuari u ON c.usuari_id = u.id 
            WHERE c.id = $1 AND c.usuari_id = $2";
            
    $consulta = pg_query_params($connexio, $sql, array($comanda_id, $usuari_id));
    
    if($consulta) {
        return pg_fetch_assoc($consulta);
    }
    return false;
}



function obtenirComandesUsuari($connexio, $id_usuari) {
    try {
        $sql = "SELECT c.* 
                FROM comanda c 
                WHERE c.id_usuari = $1 
                ORDER BY c.date DESC, c.hora DESC";
        
        $consulta = pg_query_params($connexio, $sql, array($id_usuari));
        
        if(!$consulta) {
            error_log("Error getting user orders: " . pg_last_error($connexio));
            return array();
        }
        
        $comandes = pg_fetch_all($consulta);
        
        // Get details for each order
        if ($comandes) {
            foreach ($comandes as &$comanda) {
                // Get products for this order
                $sql_products = "SELECT p.*, d.quantitat 
                               FROM detalls_comanda d 
                               JOIN producte p ON d.id_producte = p.id 
                               WHERE d.id_comanda = $1";
                               
                $products_consulta = pg_query_params($connexio, $sql_products, array($comanda['id']));
                
                if ($products_consulta) {
                    $comanda['productes'] = pg_fetch_all($products_consulta);
                } else {
                    $comanda['productes'] = array();
                }
            }
        }
        
        return $comandes;
    } catch (Exception $e) {
        error_log("Error in obtenirComandesUsuari: " . $e->getMessage());
        return array();
    }
}

function obtenirDetallsComanda($connexio, $id_comanda) {
    try {
        $sql = "SELECT d.*, p.nom as nom_producte, p.img 
                FROM detalls_comanda d 
                JOIN producte p ON d.id_producte = p.id 
                WHERE d.id_comanda = $1";
        
        $consulta = pg_query_params($connexio, $sql, array($id_comanda));
        
        if(!$consulta) {
            error_log("Error getting order detalls: " . pg_last_error($connexio));
            return array();
        }
        
        return pg_fetch_all($consulta);
    } catch (Exception $e) {
        error_log("Error in obtenirDetallsComanda: " . $e->getMessage());
        return array();
    }
}

?>