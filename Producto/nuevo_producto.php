<!-- Archivo: nuevo_producto.php -->
<?php
include '../db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Nuevo Producto</h2>

    <!-- Formulario para agregar un nuevo producto -->
    <form action="agregar_producto.php" method="post">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required>

        <label for="cantidad_disponible">Cantidad Disponible:</label>
        <input type="number" name="cantidad_disponible" required>

        <!-- Menú desplegable para seleccionar la categoría -->
        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id" required>
            <?php
            $result = $conn->query("SELECT id, nombre FROM categorias");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select>

        <!-- Menú desplegable para seleccionar la ubicación -->
        <label for="ubicacion_id">Ubicación:</label>
        <select name="ubicacion_id" required>
            <?php
            $result = $conn->query("SELECT id, nombre FROM ubicaciones");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select>

        <!-- Menú desplegable para seleccionar la marca -->
        <label for="marca_id">Marca:</label>
        <select name="marca_id" required>
            <?php
            $result = $conn->query("SELECT id, nombre FROM marcas");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>
</div>
<div class="container mt-5">
    <h2>Productos Registrados</h2>
    <form action="reporte.php" method="post">
        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
    <!-- Mostrar la tabla de productos -->
    <table class="table">
        <!-- Agregar encabezados de la tabla según tus necesidades -->
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Producto</th>
            <th>Cantidad Disponible</th>
            <th>Categoría</th>
            <th>Ubicación</th>
            <th>Marca</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <!-- Obtener y mostrar los productos de la base de datos -->
        <?php
        $result = $conn->query("SELECT * FROM productos");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['cantidad_disponible'] . "</td>";

            // Obtener el nombre de la categoría a partir de su ID
            if (!empty($row['categoria_id'])) {
                $categoria_result = $conn->query("SELECT nombre FROM categorias WHERE id = " . $row['categoria_id']);
                if (!$categoria_result) {
                    die("Error al obtener la categoría: " . $conn->error);
                }
                $categoria_nombre = $categoria_result->fetch_assoc()['nombre'];
            } else {
                $categoria_nombre = "N/A"; // Otra forma de manejar el caso sin categoría
            }

            // Obtener el nombre de la ubicación a partir de su ID
            if (!empty($row['ubicacion_id'])) {
                $ubicacion_result = $conn->query("SELECT nombre FROM ubicaciones WHERE id = " . $row['ubicacion_id']);
                if (!$ubicacion_result) {
                    die("Error al obtener la ubicación: " . $conn->error);
                }
                $ubicacion_nombre = $ubicacion_result->fetch_assoc()['nombre'];
            } else {
                $ubicacion_nombre = "N/A"; // Otra forma de manejar el caso sin ubicación
            }

            // Obtener el nombre de la marca a partir de su ID
            if (!empty($row['marca_id'])) {
                $marca_result = $conn->query("SELECT nombre FROM marcas WHERE id = " . $row['marca_id']);
                if (!$marca_result) {
                    die("Error al obtener la marca: " . $conn->error);
                }
                $marca_nombre = $marca_result->fetch_assoc()['nombre'];
            } else {
                $marca_nombre = "N/A"; // Otra forma de manejar el caso sin marca
            }

            echo "<td>" . $categoria_nombre . "</td>";
            echo "<td>" . $ubicacion_nombre . "</td>";
            echo "<td>" . $marca_nombre . "</td>";

            // Agregar enlaces para editar y eliminar cada producto
            echo "<td><a href='editar_producto.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a> ";
            echo "<a href='eliminar_producto.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";

            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
