<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $categoria_id = $_POST['categoria_id'];
    $ubicacion_id = $_POST['ubicacion_id'];
    $marca_id = $_POST['marca_id'];

    // Actualizar los datos en la base de datos
    $update_query = $conn->prepare("UPDATE productos SET nombre=?, cantidad_disponible=?, categoria_id=?, ubicacion_id=?, marca_id=? WHERE id=?");
    $update_query->bind_param("siiiii", $nombre, $cantidad_disponible, $categoria_id, $ubicacion_id, $marca_id, $id);
    $update_query->execute();
    $update_query->close();

    // Redirigir a la página principal o a otra página
    header("Location: editar_productop.php");
    exit();
} else {
    // Si se intenta acceder directamente a este script sin enviar el formulario, redirigir a la página principal
    header("Location: editar_productop.php");
    exit();
}
?>
