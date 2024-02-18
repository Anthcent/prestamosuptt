<?php
include '../db.php';
include '../header/headernav.html';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Registrados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

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

    <!-- Mostrar la tabla de productos -->
    <table class="table">
        <!-- Agregar encabezados de la tabla según tus necesidades -->
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Producto</th>
            <th>Cantidad Disponible</th>
            <th>Categoría</th>
            <th>Ubicación</th>
            <th>Marca</th>
           
        </tr>
        </thead>
        <tbody>
        <!-- Obtener y mostrar los productos de la base de datos -->
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
           
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="../login/logout.php">Logout</a>
    </div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../css/startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js"></script>
<script src="../css/startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../css/startbootstrap-sb-admin-2-gh-pages/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../css/startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../css/startbootstrap-sb-admin-2-gh-pages/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../css/startbootstrap-sb-admin-2-gh-pages/js/demo/chart-area-demo.js"></script>
<script src="../css/startbootstrap-sb-admin-2-gh-pages/js/demo/chart-pie-demo.js"></script>
<script src="../css/startbootstrap-sb-admin-2-gh-pages/js/demo/chart-bar-demo.js"></script>
<script src="../css/startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Agrega jQuery -->
    <script src="../css/startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js"></script>
    <!-- Agrega DataTables -->
    <script src="../css/startbootstrap-sb-admin-2-gh-pages/vendor/datatables/jquery.dataTables.min.js"></script>
    <script>
        // Inicializa DataTables en la tabla
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

</body>


</html>
