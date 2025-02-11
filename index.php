<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->setRedirectUri('http://localhost/oauth2callback.php');
$client->addScope(Google_Service_Drive::DRIVE_READONLY);

if (!isset($_GET['code'])) {
    // Si no hay código, redirige al usuario para autenticarlo
    $authUrl = $client->createAuthUrl();
    echo "<a href='" . $authUrl . "'>Accede con tu cuenta de Google</a>";
    exit;
}
?>
