<?php

    // Registrar nuevo usuario
    // Recordar uso de pg_query_params cuando usamos parametros
    function registreUsuari($connexio, $nom, $email, $password, $address, $poblacio, $codi_postal) {
        try {
            $sql = "INSERT INTO usuari (nom,email,password, address, poblacio, codi_postal) 
                    VALUES ($1, $2, $3, $4, $5, $6)";
            $parametres = [$nom, $email, $password, $address, $poblacio, $codi_postal];

            $resultat = pg_query_params($connexio, $sql, $parametres);
            return $resultat !== false;
        } catch (Exception $e){
            return false;
        }
    }

    function loginUsuari($connexio, $email) {
        $sql = "SELECT * FROM usuari WHERE email = $1";
        $consulta = pg_query_params($connexio, $sql, array($email));

        if($consulta) {
            return pg_fetch_assoc($consulta);
        } else {
            return false;
        }
    }

    function getUsuariById($id, $connexio) {
        $sql = "SELECT * FROM usuari WHERE id = $1";
        $result = pg_query_params($connexio, $sql, array($id));
        return pg_fetch_assoc($result);
    }
    
    function updateUsuari($connexio, $id, $nom, $email, $address, $poblacio, $codi_postal, $profile_image = null) {
        $params = [$nom, $email, $address, $poblacio, $codi_postal, $id];
        $sql = "UPDATE usuari SET nom = $1, email = $2, address = $3, poblacio = $4, codi_postal = $5";
        
        if ($profile_image) {
            $sql .= ", profile_image = $7";
            $params[] = $profile_image;
        }
        
        $sql .= " WHERE id = $6";
        
        return pg_query_params($connexio, $sql, $params);
    }
?>