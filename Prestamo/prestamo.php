<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene un rol asignado
if (!isset($_SESSION['user_role'])) {
    // Redirigir a la página de inicio de sesión si no se ha iniciado sesión
    header("Location: login/login.php");
    exit();
}

// Verificar el rol permitido para acceder a esta página
$allowed_roles = ['administrador', 'operador'];  // Roles permitidos para esta página
$current_role = $_SESSION['user_role'];

if (!in_array($current_role, $allowed_roles)) {
    // Redirigir a una página de acceso no permitido si el rol no está permitido
    header("Location: access_denied.php");
    exit();
}

include '../db.php';

// Obtener información del personal desde la base de datos
$get_personal_query = "SELECT * FROM personal";
$result = $conn->query($get_personal_query);

// Verificar si se obtuvieron resultados

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Préstamos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Préstamo de Productos</h2>
    <!-- Agregar un enlace en index.php para acceder al formulario -->
    <a href="nuevo_producto.php" class="btn btn-success">Agregar Nuevo Producto</a>
    <!-- Agregar enlaces en index.php para acceder a los formularios -->
    <a href="Categoria/nueva_categoria.php" class="btn btn-success">Agregar Nueva Categoría</a>
    <a href="nueva_ubicacion.php" class="btn btn-success">Agregar Nueva Ubicación</a>
    <a href="nueva_marca.php" class="btn btn-success">Agregar Nueva Marca</a>
    <a href="nuevo_personal.php" class="btn btn-red">Agregar Nueva Marca</a>
    <a href="reporte.php" class="btn btn-red">Reporte</a>
    <!-- Formulario para realizar un préstamo -->
    <form action="prestar.php" method="post">
        <!-- Agregar campos del formulario según tus necesidades -->
        <label for="persona_id">Persona:</label>
    <select name="persona_id" id="persona_id" required>
        <?php
        $result = $conn->query("SELECT id, nombre, cargo FROM personal");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "' data-cargo='" . $row['cargo'] . "'>" . $row['nombre'] . "</option>";
        }
        ?>
    </select>

    <label for="cargo">Cargo:</label>
    <input type="text" name="cargo" id="cargo" readonly>





        <!-- Sección del menú desplegable para seleccionar productos -->
        <label for="producto_id">Producto:</label>
        <select name="producto_id" id="producto_id" required>
            <?php
            // Obtener productos de la base de datos y mostrar en el menú desplegable
            $result = $conn->query("SELECT id, nombre, cantidad_disponible FROM productos");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "' data-disponible='" . $row['cantidad_disponible'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <span id="cantidad_disponible"></span>
        <span id="categoria_info"></span>
        <span id="ubicacion_info"></span>
        <span id="marca_info"></span>

        <label for="cantidad_prestada">Cantidad Prestada:</label>
        <input type="number" name="cantidad_prestada" required>

        <label for="fecha_entrega">Fecha de Entrega:</label>
        <input type="date" name="fecha_entrega" required>

        <label for="fecha_devolucion">Fecha de Devolución:</label>
        <input type="date" name="fecha_devolucion">

        <button type="submit" class="btn btn-primary">Realizar Préstamo</button>
    </form>

<!-- Mostrar la tabla de préstamos -->
<h3>Préstamos Realizados</h3>
<table class="table">
    <!-- Agregar encabezados de la tabla según tus necesidades -->
    <thead>
        <tr>
            <th>ID</th>
            <th>Persona</th>
            <th>Cargo</th>
            <th>Producto</th>
            <th>Cantidad Prestada</th>
            <th>Fecha de Entrega</th>
            <th>Fecha de Devolución</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- Obtener y mostrar los préstamos de la base de datos -->
        <?php
       
        $result = $conn->query("SELECT prestamos.id, prestamos.persona_nombre, personal.cargo, prestamos.producto_id, prestamos.cantidad_prestada, prestamos.fecha_entrega, prestamos.fecha_devolucion, prestamos.estado FROM prestamos INNER JOIN personal ON prestamos.persona_id = personal.id");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['persona_nombre'] . "</td>";
            echo "<td>" . $row['cargo'] . "</td>";

            // Obtener el nombre del producto a partir de su ID
            $producto_result = $conn->query("SELECT nombre FROM productos WHERE id = " . $row['producto_id']);
            $producto_nombre = $producto_result->fetch_assoc()['nombre'];

            echo "<td>" . $producto_nombre . "</td>";
            echo "<td>" . $row['cantidad_prestada'] . "</td>";
            echo "<td>" . $row['fecha_entrega'] . "</td>";
            echo "<td>" . $row['fecha_devolucion'] . "</td>";

            // Verificar el estado según la fecha actual
            $fechaEntrega = new DateTime($row['fecha_entrega']);
            $fechaDevolucion = new DateTime($row['fecha_devolucion']);
            $fechaActual = new DateTime();  // Fecha y hora actuales

            // Verificar si la fecha actual está entre la fecha de entrega y la fecha de devolución
            if ($fechaActual >= $fechaEntrega && $fechaActual <= $fechaDevolucion) {
                echo "<td>ACTIVO</td>";
            } elseif ($fechaActual > $fechaDevolucion) {
                echo "<td>CADUCADO</td>";
            } else {
                echo "<td>Préstamo en curso</td>";
            }

            echo "<td>" . $row['estado'] . "</td>";

            // Mostrar el botón de devolución solo si el estado es 'Prestado'
            if ($row['estado'] == 'Prestado') {
                echo "<td><a href='devolver.php?id=" . $row['id'] . "' class='btn btn-warning'>Devolver</a></td>";
            } else {
                echo "<td></td>";
            }

            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>    document.getElementById("producto_id").addEventListener("change", function () {
        var cantidadDisponible = this.options[this.selectedIndex].getAttribute('data-disponible');
        document.getElementById("cantidad_disponible").innerText = "Cantidad Disponible: " + cantidadDisponible;
    });
</script>
<script>
    document.getElementById("producto_id").addEventListener("change", function () {
        var productoId = this.value;

        // Realizar una solicitud AJAX para obtener información adicional del producto
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var productoInfo = JSON.parse(this.responseText);

                // Actualizar la información adicional en el formulario
                document.getElementById("categoria_info").innerText = "Categoría: " + productoInfo.categoria;
                document.getElementById("ubicacion_info").innerText = "Ubicación: " + productoInfo.ubicacion;
                document.getElementById("marca_info").innerText = "Marca: " + productoInfo.marca;
            }
        };
        xhr.open("GET", "obtener_info_producto.php?id=" + productoId, true);
        xhr.send();
    });
</script>
<script>
    // Script para actualizar automáticamente el campo de cargo al seleccionar una persona
document.getElementById("persona_id").addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var cargoField = document.getElementById("cargo");

    // Llenar el campo de cargo con el valor asociado al dato seleccionado
    cargoField.value = selectedOption.getAttribute("data-cargo");
});
</script>







</body>
</html>
