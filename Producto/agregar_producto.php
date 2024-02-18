<!-- Archivo: agregar_producto.php -->

<?php
// Archivo: agregar_producto.php

include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $categoria_id = $_POST['categoria_id'];
    $ubicacion_id = $_POST['ubicacion_id'];
    $marca_id = $_POST['marca_id'];

    // Insertar el nuevo producto en la base de datos
    $insert_producto_query = "INSERT INTO productos (nombre, cantidad_disponible, categoria_id, ubicacion_id, marca_id) VALUES ('$nombre', $cantidad_disponible, $categoria_id, $ubicacion_id, $marca_id)";
    $conn->query($insert_producto_query);

    // Redireccionar a la página principal
    header("Location: nuevo_productop.php");
    exit();
}
?>
