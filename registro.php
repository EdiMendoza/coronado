<?php
require 'conexion.php';

class UserRegistration {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($nombre, $correo, $contrasena) {
        // Verifica si el correo ya existe
        $stmt = $this->pdo->prepare("SELECT * FROM Usuarios WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Este correo ya está registrado.";
        } else {
            // Inserta el nuevo usuario con la contraseña en texto plano
            $stmt = $this->pdo->prepare("INSERT INTO Usuarios (nombre, correo, password, rol) VALUES (:nombre, :correo, :password, 'cliente')");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $contrasena); // Guardar la contraseña en texto plano
            $stmt->execute();

            // Redirige al formulario de login después del registro
            header("Location: login.html");
            exit; // Asegura que no se ejecute más código después de la redirección
        }
    }
}
// Uso de la clase
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena']; // Contraseña en texto plano

    $userRegistration = new UserRegistration($pdo);
    $resultado = $userRegistration->register($nombre, $correo, $contrasena);

    if ($resultado) {
        echo $resultado; // Muestra errores como "Correo ya registrado"
    }
}
?>
