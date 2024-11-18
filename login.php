<?php
require 'conexion.php';

class Auth {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($correo, $contrasena) {
        // Verifica si el correo existe en la base de datos
        $stmt = $this->pdo->prepare("SELECT * FROM Usuarios WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        // Si el correo está registrado
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica la contraseña (sin encriptación, según tu implementación actual)
            if ($contrasena === $usuario['password']) {
                session_start();

                // Guarda los datos del usuario en la sesión
                $_SESSION['usuario_id'] = $usuario['usuario_id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['rol'] = $usuario['rol'];

                // Redirige según el rol del usuario
                if ($usuario['rol'] === 'administrador') {
                    header("Location: admin.html");
                } else {
                    header("Location: clientes.html");
                }
                exit;
            } else {
                // Contraseña incorrecta
                return "Contraseña incorrecta.";
            }
        } else {
     // Usuario no encontrado
            return "Usuario no encontrado.";
        }
    }
}

// Uso de la clase
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $auth = new Auth($pdo);
    $resultado = $auth->login($correo, $contrasena);

    if ($resultado) {
        echo $resultado; // Muestra errores como "Contraseña incorrecta" o "Usuario no encontrado"
    }
}
?>
