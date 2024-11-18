<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "huellas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$usuario_id = $_POST['usuario_id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// Consulta de actualización
$sql = "UPDATE Usuarios SET nombre = ?, correo = ?, password = ?, rol = ? WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $correo, $password, $rol, $usuario_id);

if ($stmt->execute()) {
    echo "Usuario actualizado correctamente";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

