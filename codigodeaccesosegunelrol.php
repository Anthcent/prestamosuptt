session_start();

// Verificar si el usuario ha iniciado sesión y tiene un rol asignado
if (!isset($_SESSION['user_role'])) {
    // Redirigir a la página de inicio de sesión si no se ha iniciado sesión
    header("Location: login/login.php");
    exit();
}

// Verificar el rol permitido para acceder a esta página
$allowed_roles = ['administrador', 'operador'];  // Roles permitidos para esta página
$current_role = $_SESSION['user_role'];

if (!in_array($current_role, $allowed_roles)) {
    // Redirigir a una página de acceso no permitido si el rol no está permitido
    header("Location: access_denied.php");
    exit();
}

<?php
// Archivo: devolver.php

include '../header/header.html';
?>

<?php
// Archivo: devolver.php

include '../footer/footer.html';
?>
// Archivo: devolver.phpaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
<?php
// Archivo: devolver.php

include '../header/headernav.html';
?>

<?php
// Archivo: devolver.php

include '../footer/footernav.html';
?>