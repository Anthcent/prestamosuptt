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
    $categoria_id = $_GET['id'];

    // Obtener la información de la categoría seleccionada
    $get_categoria_query = "SELECT * FROM categorias WHERE id = $categoria_id";
    $categoria_result = $conn->query($get_categoria_query);

    if ($categoria_result->num_rows > 0) {
        $categoria = $categoria_result->fetch_assoc();
    } else {
        // Redireccionar a la página principal si la categoría no existe
        header("Location: ver_categorias.php");
        exit();
    }
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: ver_categorias.php");
    exit();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Actualizar la categoría en la base de datos
    $update_categoria_query = "UPDATE categorias SET nombre = '$nombre' WHERE id = $categoria_id";
    $conn->query($update_categoria_query);

    // Redireccionar a la página principal
    header("Location: ver_categorias.php");
    exit();
}
?>
<div class="container mt-2">
<div class="bd-example">
     
     <div class="col-xl-12 col-lg-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Registro de Categoría de  Articulos o Productos</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="new-user-info">

   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-1" action="actualizar_categoria.php" method="post">
        
<div class="col-md-12">
    
     <label for="validationServer01" class="form-label">Nombre de la Categoría</label>
   
    <input type="text" class="form-control" name="nombre" value="<?php echo $categoria['nombre']; ?>" required>

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