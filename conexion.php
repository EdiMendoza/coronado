<?php
$host = 'localhost'; // Cambia esto según la configuración de tu servidor
$dbname = 'huellas'; // Nombre de tu base de datos
$username = 'root'; // Usuario de la base de datos
$password = '1234'; // Contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

