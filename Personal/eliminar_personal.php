

<?php
// Incluir el archivo de conexión a la base de datos
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro de la tabla personal para el ID proporcionado
    $delete_query = "DELETE FROM personal WHERE id = $id";
    $conn->query($delete_query);

    // Redirigir a index.php con un mensaje de alerta
    header("Location: index.php?mensaje=Registro eliminado");
    exit();
} else {
    // Si no se proporciona el ID, redirigir a index.php con un mensaje de alerta
    header("Location: nuevo_personal.php");
    exit();
}
?>
