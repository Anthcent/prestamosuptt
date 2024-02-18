<!-- Archivo: agregar_categoria.php -->

<?php
// Archivo: agregar_categoria.php

include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Insertar la nueva categoría en la base de datos
    $insert_categoria_query = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
    $conn->query($insert_categoria_query);

    // Redireccionar a la página principal
    header("Location: nueva_categoriap.php");
    exit();
}
?>
