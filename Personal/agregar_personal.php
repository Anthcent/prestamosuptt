<!-- Archivo: agregar_personal.php -->

<?php
// Archivo: agregar_personal.php

include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $telefono = $_POST['telefono'];
    $direccion_hogar = $_POST['direccion_hogar'];

    // Insertar nuevo personal en la base de datos
    $insert_personal_query = "INSERT INTO personal (nombre, apellido, cedula, cargo, departamento, telefono, direccion_hogar)
                             VALUES ('$nombre', '$apellido', '$cedula', '$cargo', '$departamento', '$telefono', '$direccion_hogar')";
    $conn->query($insert_personal_query);

    // Redireccionar a la página principal
    header("Location: editar_personalp.php");
    exit();
}
?>

