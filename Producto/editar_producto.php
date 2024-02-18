<?php
// Incluir el archivo de conexión a la base de datos
include '../db.php';

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Obtener la información del producto seleccionado
    $get_producto_query = "SELECT * FROM productos WHERE id = $producto_id";
    $producto_result = $conn->query($get_producto_query);

    if ($producto_result->num_rows > 0) {
        $producto = $producto_result->fetch_assoc();
    } else {
        // Redireccionar a la página principal si el producto no existe
        header("Location: ver_producto.php");
        exit();
    }
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: ver_producto.php");
    exit();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $categoria_id = $_POST['categoria_id'];
    $ubicacion_id = $_POST['ubicacion_id'];
    $marca_id = $_POST['marca_id'];

    // Actualizar el producto en la base de datos
    $update_producto_query = "UPDATE productos SET nombre = '$nombre', cantidad_disponible = $cantidad_disponible, categoria_id = $categoria_id, ubicacion_id = $ubicacion_id, marca_id = $marca_id WHERE id = $producto_id";
    $conn->query($update_producto_query);

    // Redireccionar a la página principal
    header("Location: ver_producto.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Producto</h2>

    <!-- Formulario para editar el producto -->
    <form action="" method="post">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

        <label for="cantidad_disponible">Cantidad Disponible:</label>
        <input type="number" name="cantidad_disponible" value="<?php echo $producto['cantidad_disponible']; ?>" required>

        <!-- Menú desplegable para seleccionar la categoría -->
        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id" required>
            <?php
            $categorias_result = $conn->query("SELECT id, nombre FROM categorias");
            while ($categoria = $categorias_result->fetch_assoc()) {
                $selected = ($producto['categoria_id'] == $categoria['id']) ? "selected" : "";
                echo "<option value='" . $categoria['id'] . "' $selected>" . $categoria['nombre'] . "</option>";
            }
            ?>
        </select>

        <!-- Menú desplegable para seleccionar la ubicación -->
        <label for="ubicacion_id">Ubicación:</label>
        <select name="ubicacion_id" required>
            <?php
            $ubicaciones_result = $conn->query("SELECT id, nombre FROM ubicaciones");
            while ($ubicacion = $ubicaciones_result->fetch_assoc()) {
                $selected = ($producto['ubicacion_id'] == $ubicacion['id']) ? "selected" : "";
                echo "<option value='" . $ubicacion['id'] . "' $selected>" . $ubicacion['nombre'] . "</option>";
            }
            ?>
        </select>

        <!-- Menú desplegable para seleccionar la marca -->
        <label for="marca_id">Marca:</label>
        <select name="marca_id" required>
            <?php
            $marcas_result = $conn->query("SELECT id, nombre FROM marcas");
            while ($marca = $marcas_result->fetch_assoc()) {
                $selected = ($producto['marca_id'] == $marca['id']) ? "selected" : "";
                echo "<option value='" . $marca['id'] . "' $selected>" . $marca['nombre'] . "</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
