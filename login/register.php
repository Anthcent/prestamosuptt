<!-- Archivo: register.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .custom-card {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: none;
        }
    </style>
</head>
<body>

<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card custom-card" style="width: 300px;">
        <div class="card-body">
            <h2 class="card-title text-center">Registro de Usuario</h2>

            <!-- Formulario de registro -->
            <form action="register_process.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rol:</label>
                    <select name="role" class="form-select" required>
                        <option value="administrador">Administrador</option>
                        <option value="operador">Operador</option>
                        <option value="usuario">Usuario</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                <button type="button" class="btn btn-primary btn-block" onclick="window.history.back();">Cancelar</button>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
