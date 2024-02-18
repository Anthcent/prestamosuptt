<?php
// Archivo: prestar.php

include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $persona_id = $_POST['persona_id'];
    $producto_id = $_POST['producto_id'];
    $cantidad_prestada = $_POST['cantidad_prestada'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    // Obtener información de la persona (nombre y cargo)
    $get_persona_info_query = "SELECT nombre, cargo FROM personal WHERE id = $persona_id";
    $persona_result = $conn->query($get_persona_info_query);
    $persona_row = $persona_result->fetch_assoc();
    $persona_nombre = $persona_row['nombre'];
    $persona_cargo = $persona_row['cargo'];

    // Verificar si hay suficiente cantidad disponible
    $check_stock_query = "SELECT cantidad_disponible FROM productos WHERE id = $producto_id";
    $result = $conn->query($check_stock_query);
    $row = $result->fetch_assoc();
    $cantidad_disponible = $row['cantidad_disponible'];

    if ($cantidad_disponible >= $cantidad_prestada) {
        // Actualizar la cantidad disponible en la tabla de productos
        $update_stock_query = "UPDATE productos SET cantidad_disponible = cantidad_disponible - $cantidad_prestada WHERE id = $producto_id";
        $conn->query($update_stock_query);

        // Insertar el préstamo en la tabla de préstamos
        $insert_prestamo_query = "INSERT INTO prestamos (persona_id, producto_id, cantidad_prestada, fecha_entrega, fecha_devolucion, persona_nombre, persona_cargo) VALUES ($persona_id, $producto_id, $cantidad_prestada, '$fecha_entrega', '$fecha_devolucion', '$persona_nombre', '$persona_cargo')";
        $conn->query($insert_prestamo_query);

        // Redireccionar a la página principal
        header("Location: prestamop.php");
        exit();
    } else {
        // Manejar el caso en el que no hay suficiente stock disponible
        echo "No hay suficiente stock disponible.";
    }
}
?>
