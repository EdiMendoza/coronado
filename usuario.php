<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "huellas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT usuario_id, nombre, correo, password, rol FROM Usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['usuario_id']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['correo']}</td>
            <td>{$row['password']}</td>
            <td>{$row['rol']}</td>
            <td>
                <button class='btn btn-warning btn-sm' onclick=\"editarUsuario('{$row['usuario_id']}', '{$row['nombre']}',
'{$row['correo']}', '{$row['rol']}')\">Editar</button>
                <button class='btn btn-danger btn-sm' onclick=\"eliminarUsuario('{$row['usuario_id']}')\">Eliminar</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No hay usuarios registrados</td></tr>";
}

$conn->close();
?>

