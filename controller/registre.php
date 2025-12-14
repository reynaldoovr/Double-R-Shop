<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../model/connectaBD.php';
require_once __DIR__ . '/../model/usuaris.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    
    // Aqui validamos las variables
    $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password'] ?? ''));
    $address = htmlspecialchars(trim($_POST['address'] ?? ''));
    $poblacio = htmlspecialchars(trim($_POST['poblacio'] ?? ''));
    $codi_postal = htmlspecialchars(trim($_POST['codi_postal'] ?? ''));

    
    if(!$nom) $errors[] = "El nom és obligatori";
    if(!$email) $errors[] = "El correu electronic no és valid";
    if(!$password) $errors[] = "La contrasenya és obligatoria";
    if(!$address) $errors[] = "L'adreça és obligatoria";
    if(!$poblacio) $errors[] = "La població és obligatoria";
    
    if(!preg_match('/^\d{5}$/', $codi_postal)) {
        $errors[] = "El codi postal ha de ser un numero de 5 digitos entre 00000 y 99999";
    }

    if(empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $connexio = connectaBD();
        if(!$connexio) {
            die("Error de connexio a la base de dates");
        }

        $checkEmailSql = "SELECT email FROM usuari WHERE email = $1";
        $result = pg_query_params($connexio, $checkEmailSql, array($email));
        
        if(pg_num_rows($result) > 0) {
            $errors[] = "Aquest correu electronic ja està registrat";
        } else {
            $resultat = registreUsuari($connexio, $nom, $email, $hashed_password, $address, $poblacio, $codi_postal);
            if($resultat) {
                header("Location: ../index.php?accio=login&register=success");
                exit();
            } else {
                $errors[] = "No s'ha pogut registrar l'usuari.";
            }
        }
    }
}

require_once __DIR__ . '/../view/registre.php';
?>