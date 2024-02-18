<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    // Consulta utilizando una consulta preparada para evitar inyección SQL
    $query = "SELECT * FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña utilizando password_verify
        if (password_verify($password, $user['contrasena'])) {
            // Almacenar información del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_role'] = $user['rol'];

            // Redireccionar según el rol del usuario
            switch ($user['rol']) {
                case 'administrador':
                    header("Location: ../prestamo/prestamop.php");
                    break;
                case 'operador':
                    header("Location: ../prestamo/prestamop.php");
                    break;
                case 'usuario':
                    header("Location: ../prestamo/prestamopindex.php");
                    break;
                default:
                    // Redireccionar a una página predeterminada si el rol no coincide
                    header("Location: default_dashboard.php");
                    break;
            }
            exit();
        }
    }

    // Si las credenciales son incorrectas o la contraseña no coincide, redirigir al formulario de login con un mensaje de error
    header("Location: loginp.php?error=1");
    exit();
} else {
    // Si se intenta acceder directamente a este script sin enviar el formulario, redirigir al formulario de login
    header("Location: loginp.php");
    exit();
}
?>
