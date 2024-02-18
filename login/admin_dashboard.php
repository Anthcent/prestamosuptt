<?php
session_start();

// Verificar si el usuario tiene permisos de administrador
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'administrador') {
    // Aquí va el contenido del dashboard del administrador
    echo "<h2>Dashboard del Administrador</h2>";
    echo "<p>Bienvenido, " . $_SESSION['user_name'] . "!</p>";
    // Agrega más contenido según sea necesario para el rol de administrador
} else {
    // Si el usuario no tiene permisos de administrador, redirigir a una página de acceso no autorizado
    header("Location: unauthorized.php");
    exit();
}
?>
