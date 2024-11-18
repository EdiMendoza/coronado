<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "huellas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$cita_id = $_POST['cita_id'];
$id_usuario = $_POST['usuario_id'];
$fecha_cita = $_POST['fecha_cita'];
$motivo = $_POST['motivo'];
$estado = $_POST['estado'];
$comentario = $_POST['comentario'];

// Consulta de actualización
$sql = "UPDATE Citas SET fecha_cita = ?, motivo = ?, estado = ?, comentario = ? WHERE cita_id = ? AND id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $fecha_cita, $motivo, $estado, $comentario, $cita_id, $id_usuario);

if ($stmt->execute()) {
    echo "Cita actualizada correctamente";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
