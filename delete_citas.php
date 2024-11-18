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

$sql = "DELETE FROM Citas WHERE cita_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cita_id);

if ($stmt->execute()) {
    echo "Cita eliminada correctamente";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
