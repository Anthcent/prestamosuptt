<!-- Archivo: agregar_marca.php -->

<?php
// Archivo: agregar_marca.php

include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Insertar la nueva marca en la base de datos
    $insert_marca_query = "INSERT INTO marcas (nombre) VALUES ('$nombre')";
    $conn->query($insert_marca_query);

    // Redireccionar a la página principal
    header("Location: nueva_marcap.php");
    exit();
}
?>
