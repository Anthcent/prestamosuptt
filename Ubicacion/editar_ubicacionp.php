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
// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ubicacion_id = $_GET['id'];

    // Obtener la información de la ubicación seleccionada
    $get_ubicacion_query = "SELECT * FROM ubicaciones WHERE id = $ubicacion_id";
    $ubicacion_result = $conn->query($get_ubicacion_query);

    if ($ubicacion_result->num_rows > 0) {
        $ubicacion = $ubicacion_result->fetch_assoc();
    } else {
        // Redireccionar a la página principal si la ubicación no existe
        header("Location: nueva_ubicacion.php");
        exit();
    }
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: nueva_ubicacion.php");
    exit();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Actualizar la ubicación en la base de datos
    $update_ubicacion_query = "UPDATE ubicaciones SET nombre = '$nombre' WHERE id = $ubicacion_id";
    $conn->query($update_ubicacion_query);

    // Redireccionar a la página principal
    header("Location: nueva_ubicacion.php");
    exit();
}
?>
<div class="container mt-2">
<div class="bd-example">
     
     <div class="col-xl-12 col-lg-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Registro de Ubicación de  Articulos o Productos</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="new-user-info">

   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-1" action="actualizar_ubicacion.php" method="post">
        
<div class="col-md-12">
    
     <label for="validationServer01" class="form-label">Nombre de la Ubicación</label>
   
    <input type="text" class="form-control" name="nombre" value="<?php echo $ubicacion['nombre']; ?>" required>

</div>
  


        <button  type="submit" class="btn btn-primary">Editar Ubicacion</button>
    </form>
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