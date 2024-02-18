<!-- Archivo: agregar_ubicacion.php -->

<?php
// Archivo: agregar_ubicacion.php

include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Insertar la nueva ubicación en la base de datos
    $insert_ubicacion_query = "INSERT INTO ubicaciones (nombre) VALUES ('$nombre')";
    $conn->query($insert_ubicacion_query);

    // Redireccionar a la página principal
    header("Location: nueva_ubicacionp.php");
    exit();
}
?>
