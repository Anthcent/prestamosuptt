<?php
// Archivo: devolver.php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene un rol asignado
if (!isset($_SESSION['user_role'])) {
    // Redirigir a la página de inicio de sesión si no se ha iniciado sesión
    header("Location: login/loginp.php");
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
<div class="container mt-2">
    

<div class="bd-example">
     

    <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Nuevo Usuario</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="new-user-info">
                       
                     <form action="register_process.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="username" >
               
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
            <select name="role" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option value="administrador">Administrador</option>
                <option value="operador">Operador</option>
                <option value="usuario">Usuario</option>
            </select>
        </div>
           

            
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

                     
                     </div>
                  </div>
               </div>
            </div>

<?php
// Archivo: devolver.php

include '../footer/footernav.html';
?>