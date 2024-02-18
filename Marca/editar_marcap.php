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
    $marca_id = $_GET['id'];

    // Obtener la información de la marca seleccionada
    $get_marca_query = "SELECT * FROM marcas WHERE id = $marca_id";
    $marca_result = $conn->query($get_marca_query);

    if ($marca_result->num_rows > 0) {
        $marca = $marca_result->fetch_assoc();
    } else {
        // Redireccionar a la página principal si la marca no existe
        header("Location: nueva_marca.php");
        exit();
    }
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: nueva_marca.php");
    exit();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Actualizar la marca en la base de datos
    $update_marca_query = "UPDATE marcas SET nombre = '$nombre' WHERE id = $marca_id";
    $conn->query($update_marca_query);

    // Redireccionar a la página principal
    header("Location: nueva_marca.php");
    exit();
}
?>
<div class="container mt-2">
<div class="bd-example">
     
     <div class="col-xl-12 col-lg-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Registro de Articulos o Productos</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="new-user-info">

   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-1" action="actualizar_marca.php" method="post">
        
<div class="col-md-12">
    
     <label for="validationServer01" class="form-label">Nombre de la Marca:</label>
    
    <input type="text" class="form-control name="nombre" value="<?php echo $marca['nombre']; ?>" required>

</div>
  


        <button  type="submit" class="btn btn-primary">Agregar Marca</button>
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