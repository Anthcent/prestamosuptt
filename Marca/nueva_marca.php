<!-- Archivo: nueva_marca.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Marca</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Nueva Marca</h2>

    <!-- Formulario para agregar una nueva marca -->
    <form action="agregar_marca.php" method="post">
        <label for="nombre">Nombre de la Marca:</label>
        <input type="text" name="nombre" required>

        <button type="submit" class="btn btn-primary">Agregar Marca</button>
    </form>
</div>
<div class="container mt-5">
    <h2>Marcas Registradas</h2>

    <!-- Agregar enlace para agregar nueva marca -->
   

    <!-- Mostrar la tabla de marcas -->
    <table class="table">
        <!-- Agregar encabezados de la tabla según tus necesidades -->
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de la Marca</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <!-- Obtener y mostrar las marcas de la base de datos -->
        <?php
        include '../db.php';
        $result = $conn->query("SELECT * FROM marcas");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            
            // Agregar enlaces para editar y eliminar cada marca
            echo "<td><a href='editar_marca.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a> ";
            echo "<a href='eliminar_marca.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";
            
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
