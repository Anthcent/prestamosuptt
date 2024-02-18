<?php
// Archivo: eliminar_marca.php

include '../db.php';

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $marca_id = $_GET['id'];

    // Eliminar la marca de la base de datos
    $delete_marca_query = "DELETE FROM marcas WHERE id = $marca_id";
    $conn->query($delete_marca_query);

    // Redireccionar a la página principal
    header("Location: nueva_marca.php");
    exit();
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: nueva_marca.php");
    exit();
}
?>
