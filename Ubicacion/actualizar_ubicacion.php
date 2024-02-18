<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    // Actualizar los datos en la base de datos
    $update_query = $conn->prepare("UPDATE ubicaciones SET nombre=? WHERE id=?");
    $update_query->bind_param("si", $nombre, $id);
    $update_query->execute();
    $update_query->close();

    // Redirigir a la página principal o a otra página
    header("Location: editar_ubicacionp.php");
    exit();
} else {
    // Si se intenta acceder directamente a este script sin enviar el formulario, redirigir a la página principal
    header("Location: ubicaciones.php");
    exit();
}
?>
