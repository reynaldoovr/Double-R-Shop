<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8">
        <meta name = "login" content = "width=device-width, initial-scale=1.0">
        <title>Inici de Sessió</title>
        <link rel="stylesheet" href="../css/login.css">
        <script src="../js/login.js" defer></script>
    </head>
    <body>
        <div class="wrapper">
            <h2>Inici de sessió</h2>
            <?php if(isset($_GET['register']) && $_GET['register'] === 'success'): ?>
                <div class="success-message">
                    Usuari registrat amb èxit. Ja pots iniciar sessió.
                </div>
            <?php endif; ?>
            <form action="resource_login.php" method = "POST">
                <div class="input-field">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Correu electronic</label>
                </div>
                <div class="input-field">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Contrasenya</label>
                </div>   
                <div class="register">
                    <p>No tens una compte?<a href="resource_registre.php">Registra't</a></p>
                </div>
                <button type="submit">Inicia sessió</button>
        </div>
    </body>
</html> 