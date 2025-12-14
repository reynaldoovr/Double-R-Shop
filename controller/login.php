<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Aqui se crea la sesion de usuario_id para todos archivos
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ .'/../model/connectaBD.php';
require_once __DIR__ .'/../model/usuaris.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars($_POST['password']);

    if($email && $password) {
        $connexio = connectaBD();
        if(!$connexio) {
            die("Error de connexió a la base de dades");
        }

        $usuari = loginUsuari($connexio, $email);
        if($usuari) {
            if(password_verify($password, $usuari['password'])) {
                $_SESSION['id_usuari'] = $usuari['id'];
                $_SESSION['nom_usuari'] = $usuari['nom'];

                error_log('Session variable set in login.php : ' . print_r($_SESSION, true));
                header("Location: ../index.php");
                exit();
            } else {
                echo "El correu electrònic o la contrasenya no són correctes";
            }
        } else {
            echo "El correu electrònic o la contrasenya no són correctes.";
        }
    } else {
        echo "Tots els camps són obligatoris.";
    }
}

require_once __DIR__ .'/../view/login.php';
?>