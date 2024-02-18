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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar el registro de la tabla personal para el ID proporcionado
    $result = $conn->query("SELECT * FROM personal WHERE id = $id");
    $row = $result->fetch_assoc();

    // Verificar si el registro existe
    if ($row) {


?>

<div class="container mt-2">
<div class="bd-example">
     
     <div class="col-xl-12 col-lg-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Editar datos del personal</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="new-user-info">


<div class="container mt-5">
   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-3" action="actualizar_personal.php" method="post">
    <input type="hidden"  name="id" value="<?php echo $row['id']; ?>">
     <div class="col-md-4">
    
     <label for="validationServer01" class="form-label">Nombre:</label>
     <input type="text" class="form-control " name="nombre" value="<?php echo $row['nombre']; ?>" required>

</div>
<div class="col-md-4">
<label for="validationServer01" class="form-label">Apellido:</label>
<input type="text" class="form-control " name="apellido" value="<?php echo $row['apellido']; ?>" required>
        
</div>
<div class="col-md-4">
<label for="validationServer01" class="form-label">Cédula:</label>
<input type="text" class="form-control "  name="cedula" value="<?php echo $row['cedula']; ?>" required>
        
</div>
<div class="col-md-4">
       
<label for="validationServer01" class="form-label">Cargo:</label>
<input type="text" class="form-control " name="cargo" value="<?php echo $row['cargo']; ?>" required>
   
</div>
<div class="col-md-4">
<label for="validationServer01" class="form-label">Departamento:</label>
<input type="text" class="form-control " name="departamento" value="<?php echo $row['departamento']; ?>" required>
        
</div>
<div class="col-md-4">
<label for="validationServer01" class="form-label">Teléfono:</label>
<input type="text" class="form-control " name="telefono" value="<?php echo $row['telefono']; ?>">
        
</div>
<div class="col-md-4">
       
<label for="validationServer01" class="form-label">Dirección de Hogar:</label>
<input type="text" class="form-control " name="direccion_hogar" value="<?php echo $row['direccion_hogar']; ?>">
</div>

        
        <button type="submit" class="btn btn-primary">Agregar Personal</button>
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