<?php
include '../db.php';  // Asegúrate de incluir tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash de la contraseña
    $role = $_POST['role'];

    // Utilizar consultas preparadas para evitar inyección de SQL
    $check_username_query = $conn->prepare("SELECT * FROM usuarios WHERE nombre = ?");
    $check_username_query->bind_param("s", $username);
    $check_username_query->execute();
    $result = $check_username_query->get_result();

    if ($result->num_rows == 0) {
        // El nombre de usuario no existe, proceder con el registro
        $insert_user_query = $conn->prepare("INSERT INTO usuarios (nombre, contrasena, rol) VALUES (?, ?, ?)");
        $insert_user_query->bind_param("sss", $username, $password, $role);
        $insert_user_query->execute();

        // Redireccionar a la página de login u otra página principal
        header("Location: loginp.php");
        exit();
    } else {
        // El nombre de usuario ya existe, manejar el caso en consecuencia
        echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
    }

    // Cerrar las consultas preparadas
    $check_username_query->close();
    $insert_user_query->close();
}
?>
