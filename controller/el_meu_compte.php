<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuari'])) {
    header("Location: index.php?accio=login");
    exit();
}

require_once __DIR__ . '/../model/connectaBD.php';
require_once __DIR__ . '/../model/usuaris.php';

$connexio = connectaBD();
$usuari = getUsuariById($_SESSION['id_usuari'], $connexio);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $address = htmlspecialchars($_POST['address']);
    $poblacio = htmlspecialchars($_POST['poblacio']);
    $codi_postal = $_POST['codi_postal'];
    
    // Handle file upload
    $profile_image = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        error_log('Starting file upload process...');
        
        // Validate file size (2MB max)
        if ($_FILES['profile_image']['size'] > 2 * 1024 * 1024) {
            $_SESSION['error'] = "La imatge és massa gran. Mida màxima: 2MB";
            error_log('File too large: ' . $_FILES['profile_image']['size'] . ' bytes');
            header("Location: index.php?accio=el_meu_compte");
            exit();
        }

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $_FILES['profile_image']['tmp_name']);
        finfo_close($fileInfo);

        error_log('File MIME type: ' . $mimeType);

        if (!in_array($mimeType, $allowedTypes)) {
            $_SESSION['error'] = "Format d'arxiu no permès. Formats acceptats: JPG, JPEG, PNG, GIF";
            error_log('Invalid file type: ' . $mimeType);
            header("Location: index.php?accio=el_meu_compte");
            exit();
        }

        $uploadDir = __DIR__ . '/../uploadedFiles/';
        
        // Check if directory exists, if not create it
        if (!is_dir($uploadDir)) {
            error_log('Upload directory does not exist. Creating...');
            if (!mkdir($uploadDir, 0775, true)) {
                error_log('Failed to create upload directory');
                $_SESSION['error'] = "Error creating upload directory";
                header("Location: index.php?accio=el_meu_compte");
                exit();
            }
        }

        // Check directory permissions
        if (!is_writable($uploadDir)) {
            error_log('Upload directory is not writable: ' . $uploadDir);
            $_SESSION['error'] = "Error de permisos al directori";
            header("Location: index.php?accio=el_meu_compte");
            exit();
        }

        $fileExtension = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
        $fileName = 'profile_' . $_SESSION['id_usuari'] . '_' . time() . '.' . $fileExtension;
        $targetPath = $uploadDir . $fileName;
        
        error_log('Attempting to move file to: ' . $targetPath);
        
        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
            error_log('Failed to move uploaded file. PHP Error: ' . error_get_last()['message']);
            $_SESSION['error'] = "Error al pujar l'arxiu";
            header("Location: index.php?accio=el_meu_compte");
            exit();
        }
        
        error_log('File successfully moved to target location');
        $profile_image = $fileName;
    }

    if ($nom && $email && $address && $poblacio && preg_match('/^\d{5}$/', $codi_postal)) {
        $result = updateUsuari(
            $connexio, 
            $_SESSION['id_usuari'], 
            $nom, 
            $email, 
            $address, 
            $poblacio, 
            $codi_postal,
            $profile_image
        );
        
        if ($result) {
            $_SESSION['nom_usuari'] = $nom;
            header("Location: index.php?accio=el_meu_compte&success=true");
            exit();
        }
    }
}

require_once __DIR__ . '/../view/el_meu_compte.php';
?>