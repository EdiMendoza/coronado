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

$sql = "DELETE FROM Usuarios WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario_id);

if ($stmt->execute()) {
    echo "Usuario eliminado correctamente";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

