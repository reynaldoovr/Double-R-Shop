<?php session_start(); ?>
<?php 
// View
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Registre</title>
</head>
<body>
    <?php if (isset($_SESSION['missatge'])): ?>
        <p><?php echo $_SESSION['missatge']; unset($_SESSION['missatge']); ?></p>
    <?php endif; ?>
    
    <form action="../controller/registre_usuari.php" method="POST">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" pattern="[A-Za-zÀ-ÿ\s]+" required>
        
        <label for="email">Adreça electrònica:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Contrasenya:</label>
        <input type="password" id="password" name="password" pattern="[A-Za-z0-9]+" required>
        
        <label for="adreca">Adreça:</label>
        <input type="text" id="adreca" name="adreca" maxlength="30" pattern="[A-Za-z0-9À-ÿ\s]+" required>
        
        <label for="poblacio">Població:</label>
        <input type="text" id="poblacio" name="poblacio" maxlength="30" pattern="[A-Za-zÀ-ÿ\s]+" required>
        
        <label for="codi_postal">Codi Postal:</label>
        <input type="text" id="codi_postal" name="codi_postal" pattern="^\d{5}$" required>
        
        <button type="submit">Registrar-se</button>
    </form>
</body>
</html>
<?php 
// Controller
?>

<?php
session_start();
require_once "../model/connectaBD.php";
require_once "../model/usuari.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $adreca = trim($_POST["adreca"]);
    $poblacio = trim($_POST["poblacio"]);
    $codi_postal = trim($_POST["codi_postal"]);

    // Validació bàsica en el servidor
    if (!preg_match("/^[A-Za-zÀ-ÿ\s]+$/", $nom)) {
        $_SESSION['missatge'] = "Nom no vàlid.";
        header("Location: ../view/registre.php");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['missatge'] = "Correu electrònic no vàlid.";
        header("Location: ../view/registre.php");
        exit();
    }
    if (!preg_match("/^[A-Za-z0-9]+$/", $password)) {
        $_SESSION['missatge'] = "La contrasenya ha de ser alfanumèrica.";
        header("Location: ../view/registre.php");
        exit();
    }
    if (!preg_match("/^\d{5}$/", $codi_postal)) {
        $_SESSION['missatge'] = "El codi postal ha de tenir 5 dígits.";
        header("Location: ../view/registre.php");
        exit();
    }

    // Connexió a la base de dades
    $conn = connectaBD();

    // Hash de la contrasenya
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Inserció a la BD
    if (afegeixUsuari($conn, $nom, $email, $passwordHash, $adreca, $poblacio, $codi_postal)) {
        $_SESSION['missatge'] = "Usuari registrat correctament!";
        header("Location: ../view/registre.php");
    } else {
        $_SESSION['missatge'] = "Error en el registre.";
        header("Location: ../view/registre.php");
    }
    exit();
} else {
    header("Location: ../view/registre.php");
    exit();
}
?>

<?php 
// Model
?>

<?php
function connectaBD() {
    $servidor = "localhost";
    $usuari = "root";
    $contrasenya = "";
    $bd = "botiga_virtual";

    try {
        $conn = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $usuari, $contrasenya);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error de connexió: " . $e->getMessage());
    }
}

function afegeixUsuari($conn, $nom, $email, $password, $adreca, $poblacio, $codi_postal) {
    try {
        $sql = "INSERT INTO usuari (nom, email, password, adreca, poblacio, codi_postal) VALUES (:nom, :email, :password, :adreca, :poblacio, :codi_postal)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':adreca', $adreca);
        $stmt->bindParam(':poblacio', $poblacio);
        $stmt->bindParam(':codi_postal', $codi_postal);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
?>
