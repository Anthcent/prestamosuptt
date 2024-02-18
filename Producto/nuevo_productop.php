<?php
// Archivo: devolver.php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene un rol asignado
if (!isset($_SESSION['user_role'])) {
    // Redirigir a la página de inicio de sesión si no se ha iniciado sesión
    header("Location: login/login.php");
    exit();
}

// Verificar el rol permitido para acceder a esta página
$allowed_roles = ['administrador'];  // Roles permitidos para esta página
$current_role = $_SESSION['user_role'];

if (!in_array($current_role, $allowed_roles)) {
    // Redirigir a una página de acceso no permitido si el rol no está permitido
    header("Location: access_denied.php");
    exit();
}
include '../header/headernav.html';
include '../db.php';
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
     
<div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="m-0 font-weight-bold text-primary">
                        <h4 class="card-title"><b>Nuevo Producto</b></h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="new-user-info">


   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-3" action="agregar_producto.php" method="post">
        
<div class="col-md-4">
    
     <label for="validationServer01" class="form-label">Nombre del Producto:</label>
    <input type="text" class="form-control " name="nombre" required>

</div>
<div class="col-md-4">
    
     <label for="validationServer01" class="form-label">Cantidad Disponible:</label>
        <input type="number" class="form-control " name="cantidad_disponible" required>

</div>
<div class="col-md-4">


<label for="validationServer01" class="form-label">Categoría:</label>

            <select name="categoria_id"  class="styled-select" aria-label=".form-select-sm example">
            <option value="" selected disabled>Seleccione..</option>
            <?php
            $result = $conn->query("SELECT id, nombre FROM categorias");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
            </select>
        </div>

        <div class="col-md-4">
        <label for="validationServer01" class="form-label">Ubicación:</label>

            <select name="ubicacion_id"  class="styled-select" aria-label=".form-select-sm example">
            <option value="" selected disabled>Seleccione..</option>
           <?php
            $result = $conn->query("SELECT id, nombre FROM ubicaciones");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
            </select>
        </div>
        <div class="col-md-4">
        <label for="validationServer01" class="form-label">Marca</label>

            <select name="marca_id"  class="styled-select" aria-label=".form-select-sm example">
            <option value="" selected disabled>Seleccione..</option>
            <?php
            $result = $conn->query("SELECT id, nombre FROM marcas");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
            </select>
        </div>     


        <button type="submit" class="btn btn-primary mt-4">Agregar Producto</button>
    </form>
</div>

</div>
                  </div>
   
            <div class="container-fluid mt-3">
            <div class="card shadow ">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registro de Producto</h6>
                            
                        </div>

                        <div class="card-body py-3">
                        <form action="reporte.php" method="post">
        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
                            
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="table" class="table table-bordered" data-toggle="data-table" width="100%" cellspacing="0">
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
                        <!-- Obtener y mostrar los préstamos de la base de datos -->
         <!-- Obtener y mostrar los registros de personal -->
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
            echo "<td><a href='editar_productop.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a> ";
            echo "<a href='eliminar_producto.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";

            echo "</tr>";
        }
        ?>
                     </tbody>
                     <tfoot>
                        <tr>
                        <th>ID</th>
            <th>Nombre del Producto</th>
            <th>Cantidad Disponible</th>
            <th>Categoría</th>
            <th>Ubicación</th>
            <th>Marca</th>
            <th>Acciones</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
      </div>


      <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<?php
// Archivo: devolver.php

include '../footer/footernav.html';
?>