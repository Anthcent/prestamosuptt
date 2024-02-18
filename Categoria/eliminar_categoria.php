<!-- Archivo: eliminar_categoria.php -->

<?php
// Incluir el archivo de conexión a la base de datos
include '../db.php';

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoria_id = $_GET['id'];

    // Eliminar la categoría de la base de datos
    $delete_categoria_query = "DELETE FROM categorias WHERE id = $categoria_id";
    $conn->query($delete_categoria_query);

    // Redireccionar a la página principal
    header("Location: ver_categorias.php");
    exit();
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: ver_categorias.php");
    exit();
}
?>
