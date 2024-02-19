<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene un rol asignado
if (!isset($_SESSION['user_role'])) {
    // Redirigir a la página de inicio de sesión si no se ha iniciado sesión
    header("Location: login/login.php");
    exit();
}

// Verificar el rol permitido para acceder a esta página
$allowed_roles = ['usuario'];  // Roles permitidos para esta página
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
include '../header/header.html';
?>

<style>
        /* Estilo personalizado para el select */
        .styled-select {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        /* Estilo cuando se enfoca */
        .styled-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 .25rem rgba(0, 123, 255, .25);
            outline: 0;
        }

        /* Estilo cuando se pasa el mouse */
        .styled-select:hover {
            border-color: #b8c2cc;
        }
    </style>
    


            <div class="container-fluid">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registro de Prestamo</h6>
                        </div>
                        <div class="card-body py-3">
                        <form action="reporte.php" method="post">
                        <a href="../login/logout.php" class="btn btn-primary">Regresar/Cerrar sesión</a>
    </form>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                  <table id="table" class="table table-bordered" data-toggle="data-table" width="100%" cellspacing="0">
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
               echo "<td>Activo</td>";
           } elseif ($fechaActual > $fechaDevolucion) {
               echo "<td>Préstamo terminado</td>";
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
                     <tfoot>
                        <tr>
                        <th>ID</th>
            <th>Persona</th>
            <th>Cargo</th>
            <th>Producto</th>
            <th>Cantidad Prestada</th>
            <th>Fecha de Entrega</th>
            <th>Fecha de Devolución</th>
            <th>Estado</th>
            <th>Estado</th>
            <th>Acciones</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
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
   <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<?php
// Archivo: devolver.php

include '../footer/footernav.html';
?>

</body>

</html>