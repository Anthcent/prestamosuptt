<?php
session_start();

// Verificar si el usuario tiene permisos de operador
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'operador') {
    // Aquí va el contenido del dashboard del operador
    echo "<h2>Dashboard del Operador</h2>";
    echo "<p>Bienvenido, " . $_SESSION['user_name'] . "!</p>";
    // Agrega más contenido según sea necesario para el rol de operador
} else {
    // Si el usuario no tiene permisos de operador, redirigir a una página de acceso no autorizado
    header("Location: unauthorized.php");
    exit();
}
?>
