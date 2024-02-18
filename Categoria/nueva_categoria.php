<!-- Archivo: nueva_categoria.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Categoría</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Nueva Categoría</h2>

    <!-- Formulario para agregar una nueva categoría -->
    <form action="agregar_categoria.php" method="post">
        <label for="nombre">Nombre de la Categoría:</label>
        <input type="text" name="nombre" required>

        <button type="submit" class="btn btn-primary">Agregar Categoría</button>
    </form>
</div>
<div class="container mt-5">
    <h2>Ver Categorías</h2>

    <!-- Enlace para agregar una nueva categoría -->

    <!-- Tabla para mostrar las categorías -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Incluir el archivo de conexión a la base de datos
            include '../db.php';

            // Obtener y mostrar las categorías de la base de datos
            $result = $conn->query("SELECT * FROM categorias");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>";
                echo "<a href='editar_categoria.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>";
                echo " <a href='eliminar_categoria.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
