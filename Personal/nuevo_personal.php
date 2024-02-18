<!-- Archivo: nuevo_personal.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Personal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Nuevo Personal</h2>

    <!-- Formulario para registrar nuevo personal -->
    <form action="agregar_personal.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required>

        <label for="cedula">Cédula:</label>
        <input type="text" name="cedula" required>

        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" required>

        <label for="departamento">Departamento:</label>
        <input type="text" name="departamento" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono">

        <label for="direccion_hogar">Dirección de Hogar:</label>
        <input type="text" name="direccion_hogar">

        <button type="submit" class="btn btn-primary">Agregar Personal</button>
    </form>
</div>
<div class="container mt-5">
    <h2>Personal Registrado</h2>
    <form action="reporte.php" method="post">
        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
    <!-- Tabla para mostrar el personal registrado -->
    <table class="table">
        <!-- Encabezados de la tabla -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>Teléfono</th>
                <th>Dirección de Hogar</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <!-- Obtener y mostrar los registros de personal -->
            <?php
            // Incluir el archivo de conexión a la base de datos
            include '../db.php';

            // Consultar todos los registros de la tabla personal
            $result = $conn->query("SELECT * FROM personal");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['cedula'] . "</td>";
                echo "<td>" . $row['cargo'] . "</td>";
                echo "<td>" . $row['departamento'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "<td>" . $row['direccion_hogar'] . "</td>";
                echo "<td>";
                echo "<a href='editar_personal.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>";
                echo "<a href='eliminar_personal.php?id=" . $row['id'] . "' class='btn btn-danger ml-2'>Eliminar</a>";
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
