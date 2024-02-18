<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Login</h2>

    <form action="auth.php" method="post">
        <label for="nombre">Nombre de Usuario:</label>
        <input type="text" name="nombre" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
