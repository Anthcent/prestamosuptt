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
?>
 <div class="col-xl-12 col-lg-12 ">
               <div class="card mb-4 py-3 border-left-primary">
               <div class="card-header d-flex justify-content-between">
                     <div class="m-0 font-weight-bold text-primary">
                        <h4 class="card-title"><b>Nueva Personal</b></h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="new-user-info">


<div class="container mt-5">
   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-3" action="agregar_personal.php" method="post">
        
     <div class="col-md-4">
    
     <label for="validationServer01" class="form-label">Nombre:</label>
        <input type="text" class="form-control " name="nombre" required>

</div>
<div class="col-md-4">
<label for="validationServer01" class="form-label">Apellido:</label>
        <input type="text" class="form-control " name="apellido" required>
        
</div>
<div class="col-md-4">
<label for="validationServer01" class="form-label">Cédula:</label>
        <input type="text" class="form-control " name="cedula" required>
        
</div>
<div class="col-md-4">
       
<label for="validationServer01" class="form-label">Cargo:</label>
        <input type="text" class="form-control " name="cargo" required>
   
</div>
<div class="col-md-4">
<label for="validationServer01" class="form-label">Departamento:</label>
        <input type="text" class="form-control " name="departamento" required>    
        
</div>
<div class="col-md-4">
<label for="validationServer01" class="form-label">Teléfono:</label>
        <input type="text" class="form-control " name="telefono">    
        
</div>
<div class="col-md-4">
       
<label for="validationServer01" class="form-label">Dirección de Hogar:</label>
        <input type="text" class="form-control " name="direccion_hogar">    
</div>

<div class="col-md-4 mt-4">
        <button type="submit" class="btn btn-primary">Agregar Personal</button>
        
                                    </div>
    </form>
</div>

</div>
                  </div>
                  </div>

                  <div class="container-fluid mt-3">
            <div class="card shadow mb-4 py-3 border-left-warning">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registro de Personal</h6>
                        </div>
                      
                        <div class="card-body py-3">
                        <form  action="reporte.php" method="post">
        <button type="submit" class="btn btn-primary ">Generar Reporte</button>
    </form>
                            <div class="table-responsive mt-3">
                  <table id="table" class="table table-striped" data-toggle="data-table">
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
                        <!-- Obtener y mostrar los préstamos de la base de datos -->
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
                echo "<a href='editar_personalp.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>";
                echo "<a href='eliminar_personal.php?id=" . $row['id'] . "' class='btn btn-danger ml-2'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
                     </tbody>
                     <tfoot>
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