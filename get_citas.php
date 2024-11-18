<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "huellas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT Citas.cita_id, Citas.fecha_cita, Citas.motivo, Citas.estado,
Citas.comentario, Usuarios.usuario_id, Usuarios.nombre, Usuarios.correo FROM Citas JOIN Usuarios ON Citas.id_usuario = Usuarios.usuario_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['usuario_id']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['correo']}</td>
            <td>{$row['fecha_cita']}</td>
            <td>{$row['motivo']}</td>
            <td>{$row['estado']}</td>
            <td>{$row['comentario']}</td>
            <td>
                <button class='btn btn-warning btn-sm' onclick=\"editarCita('{$row['cita_id']}', '{$row['usuario_id']}',
 '{$row['fecha_cita']}', '{$row['motivo']}', '{$row['estado']}', '{$row['comentario']}')\">Editar</button>
                <button class='btn btn-danger btn-sm' onclick=\"eliminarCita('{$row['cita_id']}')\">Eliminar</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>No hay citas registradas</td></tr>";
}

$conn->close();
?>

