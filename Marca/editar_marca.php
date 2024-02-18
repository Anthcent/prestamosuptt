<?php
// Archivo: editar_marca.php

include '../db.php';

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $marca_id = $_GET['id'];

    // Obtener la información de la marca seleccionada
    $get_marca_query = "SELECT * FROM marcas WHERE id = $marca_id";
    $marca_result = $conn->query($get_marca_query);

    if ($marca_result->num_rows > 0) {
        $marca = $marca_result->fetch_assoc();
    } else {
        // Redireccionar a la página principal si la marca no existe
        header("Location: nueva_marca.php");
        exit();
    }
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: nueva_marca.php");
    exit();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Actualizar la marca en la base de datos
    $update_marca_query = "UPDATE marcas SET nombre = '$nombre' WHERE id = $marca_id";
    $conn->query($update_marca_query);

    // Redireccionar a la página principal
    header("Location: nueva_marca.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Marca</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Marca</h2>

    <!-- Formulario para editar la marca -->
    <form action="" method="post">
        <label for="nombre">Nombre de la Marca:</label>
        <input type="text" name="nombre" value="<?php echo $marca['nombre']; ?>" required>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
