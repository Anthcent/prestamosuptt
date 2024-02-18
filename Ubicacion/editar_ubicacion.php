<?php
// Archivo: editar_ubicacion.php

include '../db.php';

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ubicacion_id = $_GET['id'];

    // Obtener la información de la ubicación seleccionada
    $get_ubicacion_query = "SELECT * FROM ubicaciones WHERE id = $ubicacion_id";
    $ubicacion_result = $conn->query($get_ubicacion_query);

    if ($ubicacion_result->num_rows > 0) {
        $ubicacion = $ubicacion_result->fetch_assoc();
    } else {
        // Redireccionar a la página principal si la ubicación no existe
        header("Location: nueva_ubicacion.php");
        exit();
    }
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: nueva_ubicacion.php");
    exit();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Actualizar la ubicación en la base de datos
    $update_ubicacion_query = "UPDATE ubicaciones SET nombre = '$nombre' WHERE id = $ubicacion_id";
    $conn->query($update_ubicacion_query);

    // Redireccionar a la página principal
    header("Location: nueva_ubicacion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ubicación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Ubicación</h2>

    <!-- Formulario para editar la ubicación -->
    <form action="" method="post">
        <label for="nombre">Nombre de la Ubicación:</label>
        <input type="text" name="nombre" value="<?php echo $ubicacion['nombre']; ?>" required>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
