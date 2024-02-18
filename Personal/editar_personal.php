

<?php
// Incluir el archivo de conexión a la base de datos
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar el registro de la tabla personal para el ID proporcionado
    $result = $conn->query("SELECT * FROM personal WHERE id = $id");
    $row = $result->fetch_assoc();

    // Verificar si el registro existe
    if ($row) {
        // Mostrar el formulario de edición con los datos actuales
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Personal</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        </head>
        <body>

        <div class="container mt-5">
            <h2>Editar Personal</h2>

            <!-- Formulario para editar personal -->
            <form action="actualizar_personal.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>" required>

                <label for="cedula">Cédula:</label>
                <input type="text" name="cedula" value="<?php echo $row['cedula']; ?>" required>

                <label for="cargo">Cargo:</label>
                <input type="text" name="cargo" value="<?php echo $row['cargo']; ?>" required>

                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" value="<?php echo $row['departamento']; ?>" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>">

                <label for="direccion_hogar">Dirección de Hogar:</label>
                <input type="text" name="direccion_hogar" value="<?php echo $row['direccion_hogar']; ?>">

                <button type="submit" class="btn btn-primary">Actualizar Personal</button>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        </body>
        </html>
        <?php
    } else {
        // Si el registro no existe, redirigir a index.php con un mensaje de alerta
        header("Location: nuevo_personal.php");
        exit();
    }
} else {
    // Si no se proporciona el ID, redirigir a index.php con un mensaje de alerta
    header("Location: nuevo_personal.php");
    exit();
}
?>
