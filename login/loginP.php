
<?php
session_start();



include '../db.php';

// Obtener información del personal desde la base de datos
$get_personal_query = "SELECT * FROM personal";
$result = $conn->query($get_personal_query);

// Verificar si se obtuvieron resultados
include '../header/header.html';
?>
                       

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                                <img src="../logouptt.png" alt="logo-uptt" class="w-100 p-2">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                                    </div>
                                    <form action="auth.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                            name="nombre" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Usuario...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Ingrese su Clave...">
                                        </div>
                                       
                                       
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Iniciar Sesión</button>
                                        <hr>
                                       
                                    </form>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>