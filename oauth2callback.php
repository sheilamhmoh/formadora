<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google\Client();
$client->setAuthConfig('client_secret_804730364120-qe73mmjh8kp9bkiu6n6h5k0ntokc69mn.apps.googleusercontent.com.json');
$client->setRedirectUri('http://localhost/oauth2callback.php');

if (!isset($_GET['code'])) {
    die('Error: No se recibió el código de autorización.');
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    die('Error al obtener el token: ' . $token['error']);
}

// Guardar token en sesión
$_SESSION['access_token'] = $token;
header('Location: drive.php');
exit();
?>
