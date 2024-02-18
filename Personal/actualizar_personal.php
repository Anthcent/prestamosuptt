<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $telefono = $_POST['telefono'];
    $direccion_hogar = $_POST['direccion_hogar'];

    // Actualizar los datos en la base de datos
    $update_query = $conn->prepare("UPDATE personal SET nombre=?, apellido=?, cedula=?, cargo=?, departamento=?, telefono=?, direccion_hogar=? WHERE id=?");
    $update_query->bind_param("sssssssi", $nombre, $apellido, $cedula, $cargo, $departamento, $telefono, $direccion_hogar, $id);
    $update_query->execute();
    $update_query->close();

    // Redirigir a la página principal o a otra página
    header("Location: editar_personalp.php");
    exit();
} else {
    // Si se intenta acceder directamente a este script sin enviar el formulario, redirigir a la página principal
    header("Location: editar_personalp.php");
    exit();
}
?>
