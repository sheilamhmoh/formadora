<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->setRedirectUri('http://localhost/oauth2callback.php');
$client->addScope(Google_Service_Drive::DRIVE_READONLY);

if (isset($_GET['code'])) {
    // Intercambia el código por un token de acceso
    $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $accessToken;

    // Redirige a la página principal
    header('Location: index.php');
    exit;
}

// Si no hay token de acceso, redirige al usuario para que se autentique
if (!isset($_SESSION['access_token']) || $_SESSION['access_token'] === null) {
    header('Location: index.php');
    exit;
}

$client->setAccessToken($_SESSION['access_token']);

// Ahora podemos acceder a la API de Google Drive
$driveService = new Google_Service_Drive($client);
$files = $driveService->files->listFiles();

echo "<h1>Archivos en tu Google Drive</h1>";
foreach ($files->getItems() as $file) {
    echo $file->getTitle() . "<br />";
}
?>

