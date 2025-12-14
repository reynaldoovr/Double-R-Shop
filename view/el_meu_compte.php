<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Meu Compte</title>
    <link rel="stylesheet" href="../css/el_meu_compte.css">
    <link rel="stylesheet" type="text/css" href="/css/inici.css" title="main"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/user_menu.js"></script>
    <script src="../js/el_meu_compte.js" defer></script>
</head>
<body>
    <?php include __DIR__ .'/header_nav.php'; ?>
    <div class="wrapper">
        <h2>El Meu Compte</h2>
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">Perfil actualitzat correctament!</div>
        <?php endif; ?>
        <form action="index.php?accio=el_meu_compte" method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($usuari['nom']); ?>" required>
                <label for="nom">Nom</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuari['email']); ?>" required>
                <label for="email">Correu electronic</label>
            </div>
            <div class="input-field">
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($usuari['address']); ?>" required>
                <label for="address">Adreça</label>
            </div>
            <div class="input-field">
                <input type="text" id="poblacio" name="poblacio" value="<?php echo htmlspecialchars($usuari['poblacio']); ?>" required>
                <label for="poblacio">Poblacio</label>
            </div>
            <div class="input-field">
                <input type="text" id="codi_postal" name="codi_postal" value="<?php echo htmlspecialchars($usuari['codi_postal']); ?>" pattern="\d{5}" required>
                <label for="codi_postal">Codi postal</label>
            </div>
            <div class="input-field">
                <input type="file" id="profile_image" name="profile_image" accept=".jpg,.jpeg,.png,.gif">
                <label for="profile_image">Imatge de perfil</label>
                <small class="format-help">Formats acceptats: JPG, JPEG, PNG, GIF. Mida màxima: 2MB</small>
            </div>
            <?php if (!empty($usuari['profile_image'])): ?>
                <div class="current-image">
                    <img src="/uploadedFiles/<?php echo htmlspecialchars($usuari['profile_image']); ?>" alt="Imatge de perfil actual">
                </div>
            <?php endif; ?>
            <button type="submit">Actualitzar Perfil</button>
        </form>
    </div>
</body>
</html>