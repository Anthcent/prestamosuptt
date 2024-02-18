<?php
session_start();

// Verificar si el usuario tiene permisos de usuario
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'usuario') {
    // Aquí va el contenido del dashboard del usuario
    echo "<h2>Dashboard del Usuario</h2>";
    echo "<p>Bienvenido, " . $_SESSION['user_name'] . "!</p>";
    // Agrega más contenido según sea necesario para el rol de usuario
} else {
    // Si el usuario no tiene permisos de usuario, redirigir a una página de acceso no autorizado
    header("Location: unauthorized.php");
    exit();
}
?>
