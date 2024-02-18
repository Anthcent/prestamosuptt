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
 <div class="col-xl-12 col-lg-12">
               <div class="card">
               <div class="card-header d-flex justify-content-between">
                     <div class="m-0 font-weight-bold text-primary">
                        <h4 class="card-title"><b>Nueva Ubicación de Producto</b></h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="new-user-info">

   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-1" action="agregar_ubicacion.php" method="post">
        
<div class="col-md-12">
    
     <label for="validationServer01" class="form-label">Nombre de la Ubicación</label>
    <input type="text" class="form-control " name="nombre" required>

</div>
  


        <button  type="submit" class="btn btn-primary mt-3">Agregar Marca</button>
    </form>
</div>

</div>
                  </div>
              




            <div class="container-fluid mt-3">
            <div class="card shadow mb-2">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registro de Ubicación</h6>
                        </div>
                      
                        <div class="card-body">
                            <div class="table-responsive">
                  <table id="table" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                        <th>ID</th>
            <th>Ubicación</th>
            <th>Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        <!-- Obtener y mostrar los préstamos de la base de datos -->
         <!-- Obtener y mostrar los registros de personal -->
         <?php
            // Obtener y mostrar las ubicaciones existentes
            include '../db.php';
            $result = $conn->query("SELECT * FROM ubicaciones");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td><a href='editar_ubicacionp.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>
                      <a href='eliminar_ubicacion.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
                echo "</tr>";
            }
            ?>
                     </tbody>
                     <tfoot>
                        <tr>
                        <th>ID</th>
            <th>ubicación</th>
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