<?php
// Archivo: devolver.php
session_start();
include '../db.php';
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

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Obtener la información del producto seleccionado
    $get_producto_query = "SELECT * FROM productos WHERE id = $producto_id";
    $producto_result = $conn->query($get_producto_query);

    if ($producto_result->num_rows > 0) {
        $producto = $producto_result->fetch_assoc();
    } else {
        // Redireccionar a la página principal si el producto no existe
        header("Location: ver_producto.php");
        exit();
    }
} else {
    // Redireccionar a la página principal si no se proporciona un ID válido
    header("Location: ver_producto.php");
    exit();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $categoria_id = $_POST['categoria_id'];
    $ubicacion_id = $_POST['ubicacion_id'];
    $marca_id = $_POST['marca_id'];

    // Actualizar el producto en la base de datos
    $update_producto_query = "UPDATE productos SET nombre = '$nombre', cantidad_disponible = $cantidad_disponible, categoria_id = $categoria_id, ubicacion_id = $ubicacion_id, marca_id = $marca_id WHERE id = $producto_id";
    $conn->query($update_producto_query);

    // Redireccionar a la página principal
    header("Location: ver_producto.php");
    exit();
}


include '../header/headernav.html';

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


<div class="container mt-5">
   
<!-- Formulario para registrar nuevo personal -->
    <form class="row g-3" action="actualizar_producto.php" method="post">
        
<div class="col-md-4">
    
     <label for="validationServer01" class="form-label">Nombre del Producto:</label>
    <input type="text" class="form-control " name="nombre" value="<?php echo $producto['nombre']; ?>" required>

</div>
<div class="col-md-4">
    
     <label for="validationServer01" class="form-label">Cantidad Disponible:</label>
        <input type="number" class="form-control " name="cantidad_disponible" value="<?php echo $producto['cantidad_disponible']; ?>" required>

</div>
<div class="col-md-4">


<label for="validationServer01" class="form-label">Categoría:</label>

            <select name="categoria_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <?php
            $categorias_result = $conn->query("SELECT id, nombre FROM categorias");
            while ($categoria = $categorias_result->fetch_assoc()) {
                $selected = ($producto['categoria_id'] == $categoria['id']) ? "selected" : "";
                echo "<option value='" . $categoria['id'] . "' $selected>" . $categoria['nombre'] . "</option>";
            }
            ?>
            </select>
        </div>

        <div class="col-md-4">
        <label for="validationServer01" class="form-label">Ubicación:</label>

            <select name="ubicacion_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <?php
            $ubicaciones_result = $conn->query("SELECT id, nombre FROM ubicaciones");
            while ($ubicacion = $ubicaciones_result->fetch_assoc()) {
                $selected = ($producto['ubicacion_id'] == $ubicacion['id']) ? "selected" : "";
                echo "<option value='" . $ubicacion['id'] . "' $selected>" . $ubicacion['nombre'] . "</option>";
            }
            ?>
            </select>
        </div>
        <div class="col-md-4">
        <label for="validationServer01" class="form-label">Marca</label>

            <select name="marca_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <?php
            $marcas_result = $conn->query("SELECT id, nombre FROM marcas");
            while ($marca = $marcas_result->fetch_assoc()) {
                $selected = ($producto['marca_id'] == $marca['id']) ? "selected" : "";
                echo "<option value='" . $marca['id'] . "' $selected>" . $marca['nombre'] . "</option>";
            }
            ?>
            </select>
        </div>     


        <button type="submit" class="btn btn-primary">Agregar Producto</button>
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