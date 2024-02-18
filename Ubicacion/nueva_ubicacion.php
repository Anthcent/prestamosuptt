<!-- Archivo: nueva_ubicacion.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Ubicación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Nueva Ubicación</h2>

    <!-- Formulario para agregar una nueva ubicación -->
    <form action="agregar_ubicacion.php" method="post">
        <label for="nombre">Nombre de la Ubicación:</label>
        <input type="text" name="nombre" required>

        <button type="submit" class="btn btn-primary">Agregar Ubicación</button>
    </form>

    <!-- Tabla para mostrar las ubicaciones existentes -->
    <h3>Ubicaciones Existente</h3>
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
            // Obtener y mostrar las ubicaciones existentes
            include '../db.php';
            $result = $conn->query("SELECT * FROM ubicaciones");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td><a href='editar_ubicacion.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>
                      <a href='eliminar_ubicacion.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
