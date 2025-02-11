<?php
require_once 'vendor/autoload.php';

session_start();

if (!isset($_SESSION['access_token'])) {
    header('Location: index.php');
    exit();
}

$client = new Google\Client();
$client->setAccessToken($_SESSION['access_token']);

if ($client->isAccessTokenExpired()) {
    session_destroy();
    header('Location: index.php');
    exit();
}

$driveService = new Google\Service\Drive($client);
$files = $driveService->files->listFiles()->getFiles();

echo "<h1>Archivos en Google Drive:</h1>";
foreach ($files as $file) {
    echo $file->getName() . "<br>";
}

echo "<br><a href='logout.php'>Cerrar sesión</a>";
?>
