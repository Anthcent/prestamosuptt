<?php
// Archivo: eliminar_ubicacion.php

include '../db.php';

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ubicacion_id = $_GET['id'];

    // Eliminar la ubicación de la base de datos
    $delete_ubicacion_query = "DELETE FROM ubicaciones WHERE id = $ubicacion_id";
    $conn->query($delete_ubicacion_query);

    // Redireccionar a la página principal
    header("Location: nueva_ubicacion.php");
    exit();
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: nueva_ubicacion.php");
    exit();
}
?>
