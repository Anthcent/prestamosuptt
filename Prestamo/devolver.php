<?php
// Archivo: devolver.php

include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $prestamo_id = $_GET['id'];

    // Obtener información del préstamo
    $prestamo_result = $conn->query("SELECT * FROM prestamos WHERE id = $prestamo_id");
    $prestamo_row = $prestamo_result->fetch_assoc();

    // Incrementar el stock del producto devuelto
    $producto_id = $prestamo_row['producto_id'];
    $cantidad_devuelta = $prestamo_row['cantidad_prestada'];

    $update_stock_query = "UPDATE productos SET cantidad_disponible = cantidad_disponible + $cantidad_devuelta WHERE id = $producto_id";
    $conn->query($update_stock_query);

    // Actualizar el estado del préstamo a 'Devuelto'
    $update_prestamo_query = "UPDATE prestamos SET estado = 'Devuelto' WHERE id = $prestamo_id";
    $conn->query($update_prestamo_query);

    // Redireccionar a la página principal
    header("Location: prestamop.php");
    exit();
}
?>
