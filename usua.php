<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "1234", "huellas");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$rol = $_POST['rol'];

$sql = "UPDATE Usuarios SET nombre='$nombre', correo='$correo', password='$password', rol='$rol' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Usuario actualizado correctamente";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>


