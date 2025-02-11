<?php
require_once 'vendor/autoload.php';

session_start();

// Cargar credenciales desde el archivo JSON
$client = new Google\Client();
$client->setAuthConfig('client_secret_804730364120-qe73mmjh8kp9bkiu6n6h5k0ntokc69mn.apps.googleusercontent.com.json');
$client->setRedirectUri('http://localhost/oauth2callback.php');
$client->addScope(Google\Service\Drive::DRIVE_METADATA_READONLY);

if (!isset($_SESSION['access_token'])) {
    $authUrl = $client->createAuthUrl();
    echo "<a href='$authUrl'>Iniciar sesión con Google</a>";
} else {
    header('Location: drive.php');
    exit();
}
?>
