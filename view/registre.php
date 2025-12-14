<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset = "utf-8">
        <meta name ="registre" content="width=device-width, initial-scale=1.0">
        <title> Registre d'usuari </title>
        <link rel="stylesheet" href="../css/registre.css">
        <script src="../js/registre.js" defer></script>
    </head>
    <body>
        <div class="wrapper">
            <h2> Registre </h2>
            <form action = "resource_registre.php" method="POST">
                <div class = "input-field">
                    <input type="text" id="nom" name="nom" required>
                    <label for="nom">Nom</label>
                </div>
                <div class = "input-field">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Correu electronic</label>
                </div>
                <div class = "input-field">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Contrasenya</label>
                </div>
                <div class = "input-field">
                    <input type="text" id="address" name="address" required>
                    <label for="address">Adreça</label>
                </div>
                <div class = "input-field">
                    <input type="text" id="poblacio" name="poblacio" required>
                    <label for="poblacio">Poblacio</label>
                </div>
                <div class = "input-field">
                    <input type="text" id="codi_postal" name="codi_postal" pattern="\d{5}" required>
                    <label for="codi_postal">Codi postal</label>
                </div>

                <button type="submit">Registra't</button>
            </form>
            <div class="register">
                <p>Ja tens una compte? <a href="resource_login.php">Inicia sesio</a></p>
            </div>
            
        </div>
</body>
</html>