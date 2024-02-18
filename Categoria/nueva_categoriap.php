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
<div class="container mt-2">
<div class="bd-example">
     
     <div class="col-xl-12 col-lg-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Registro de Categoria de  Articulos o Productos</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="new-user-info">

   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-1" action="agregar_categoria.php" method="post">
        
<div class="col-md-12">
    
     <label for="validationServer01" class="form-label">Nombre de la Categoría</label>
    <input type="text" class="form-control " name="nombre" required>

</div>
  


        <button  type="submit" class="btn btn-primary">Agregar Marca</button>
    </form>
</div>

</div>
                  </div>
               </div>
            </div>





            <div class="conatiner-fluid content-inner mt-1 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Lista de Categoria de  Articulos o Productos</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="table" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                        <th>ID</th>
            <th>Categoria</th>
            <th>Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        <!-- Obtener y mostrar los préstamos de la base de datos -->
         <!-- Obtener y mostrar los registros de personal -->
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
                echo "<a href='editar_categoriap.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>";
                echo " <a href='eliminar_categoria.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
                     </tbody>
                     <tfoot>
                        <tr>
                        <th>ID</th>
            <th>Categoria</th>
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