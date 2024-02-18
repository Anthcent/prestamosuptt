<!-- Archivo: editar_categoria.php -->

<?php
// Incluir el archivo de conexión a la base de datos
include '../db.php';

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoria_id = $_GET['id'];

    // Obtener la información de la categoría seleccionada
    $get_categoria_query = "SELECT * FROM categorias WHERE id = $categoria_id";
    $categoria_result = $conn->query($get_categoria_query);

    if ($categoria_result->num_rows > 0) {
        $categoria = $categoria_result->fetch_assoc();
    } else {
        // Redireccionar a la página principal si la categoría no existe
        header("Location: ver_categorias.php");
        exit();
    }
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: ver_categorias.php");
    exit();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Actualizar la categoría en la base de datos
    $update_categoria_query = "UPDATE categorias SET nombre = '$nombre' WHERE id = $categoria_id";
    $conn->query($update_categoria_query);

    // Redireccionar a la página principal
    header("Location: ver_categorias.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Categoría</h2>

    <!-- Formulario para editar la categoría -->
    <form action="" method="post">
        <label for="nombre">Nombre de la Categoría:</label>
        <input type="text" name="nombre" value="<?php echo $categoria['nombre']; ?>" required>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
