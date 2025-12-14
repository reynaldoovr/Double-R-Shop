<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Contacte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }
        label {
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="http://localhost/index.php?action=contacte" method="POST">
        <h2>Formulari de Contacte</h2>
        
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" pattern="[a-z]+" maxlength="30" required>
        
        <label for="comentari">Comentari:</label>
        <textarea id="comentari" name="comentari" pattern="[a-z]+" required></textarea>
        
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

<?php
// Controlador per a afegir productes a la sessió
session_start();
require_once "../model/productes.php";

if ($_GET['action'] == 'allin') {
    $_SESSION['productes'] = carregaTotsElsProductes(); // Funció del model per carregar productes
    $_SESSION['cabas'] = []; // Buidar la variable de sessió 'cabas'
    header("Location: ../view/carret.php"); // Redirigir a la vista del carret
    exit();
}
?>

<?php


// Model: Funció per carregar tots els productes
require_once "../model/connectaBD.php";

function carregaTotsElsProductes() {
    $conn = connectaBD();
    if (!$conn) {
        return [];
    }
    
    $query = "SELECT * FROM productes";
    $result = pg_query($conn, $query);
    
    if (!$result) {
        return [];
    }
    
    $productes = pg_fetch_all($result);
    return $productes ? $productes : [];
}
?>

<?php
//Vista
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carret de la Compra</title>
</head>
<body>
    <h2>Carret de la compra</h2>
    <?php session_start(); ?>
    <?php if (!empty($_SESSION['productes'])): ?>
        <ul>
            <?php foreach ($_SESSION['productes'] as $producte): ?>
                <li><?php echo htmlspecialchars($producte['nom']); ?> - <?php echo number_format($producte['preu'], 2); ?>€</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hi ha productes al carret.</p>
    <?php endif; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Contacte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }
        label {
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid red;
            border-radius: 4px;
            background-color: #ffcccc;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="http://localhost/index.php?action=contacte" method="POST">
        <h2>Formulari de Contacte</h2>
        
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        
        <label for="comentari">Comentari:</label>
        <textarea id="comentari" name="comentari" required></textarea>
        
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

<!DOCTYPE html>
<?php 
//Sin validacion del servidor 
?>
<input type="text" id="nom" name="nom" required>
<textarea id="comentari" name="comentari" required></textarea>

</html>

<?php

// Controlador per comprovar i redirigir segons l'existència de l'usuari
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    
    if (usuariExisteix($email)) {
        header("Location: ../view/usuari_existeix.php");
        exit();
    } else {
        header("Location: ../view/usuari_no_existeix.php");
        exit();
    }
}

?>

<?php
// Aqui validacion del servidor, pero debe estar dentro del controller

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"]);
    $comentari = trim($_POST["comentari"]);

    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]{1,30}$/", $nom)) {
        $_SESSION['missatge'] = "El nom no és vàlid.";
        header("Location: ../view/registre.php");
        exit();
    }

    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $comentari)) {
        $_SESSION['missatge'] = "El comentari no és vàlid.";
        header("Location: ../view/registre.php");
        exit();
    }

    $_SESSION['missatge'] = "Formulari enviat correctament!";
    header("Location: ../view/registre.php");
    exit();
}
?>


<?php
//Comprovar si un usuari existeix en la BD
function usuariExisteix($email) {
    $conn = connectaBD();
    if (!$conn) {
        return false;
    }
    
    $query = "SELECT * FROM usuaris WHERE email = $1";
    $result = pg_query_params($conn, $query, array($email));
    
    if (!$result) {
        return false;
    }
    
    return pg_num_rows($result) > 0;
}

// Funció per comprovar si un usuari existeix a la BD
function usuariExisteix($email) {
    $conn = connectaBD();
    if (!$conn) {
        return false;
    }
    
    $query = "SELECT * FROM usuaris WHERE email = $1";
    $result = pg_query_params($conn, $query, array($email));
    
    if (!$result) {
        return false;
    }
    
    return pg_num_rows($result) > 0;
}

// Funció per comprovar si un producte existeix a la BD
function producteExisteix($id_producte) {
    $conn = connectaBD();
    if (!$conn) {
        return false;
    }
    
    $query = "SELECT * FROM productes WHERE id = $1";
    $result = pg_query_params($conn, $query, array($id_producte));
    
    if (!$result) {
        return false;
    }
    
    return pg_num_rows($result) > 0;
}

// Funció per comprovar si una categoria existeix a la BD
function categoriaExisteix($id_categoria) {
    $conn = connectaBD();
    if (!$conn) {
        return false;
    }
    
    $query = "SELECT * FROM categories WHERE id = $1";
    $result = pg_query_params($conn, $query, array($id_categoria));
    
    if (!$result) {
        return false;
    }
    
    return pg_num_rows($result) > 0;
}
?>

<?php
// Aqui todo dentro de codigo PHP y que no esté dentro de HTML
?>

<?php if (true): ?>
<?php endif; ?>