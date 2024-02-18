<?php
// Archivo: obtener_info_producto.php

include '../db.php';

if (isset($_GET['id'])) {
    $productoId = $_GET['id'];

    // Obtener información adicional del producto
    $info_query = "SELECT productos.id AS producto_id, productos.nombre AS producto_nombre, categorias.nombre AS categoria, ubicaciones.nombre AS ubicacion, marcas.nombre AS marca
                   FROM productos
                   LEFT JOIN categorias ON productos.categoria_id = categorias.id
                   LEFT JOIN ubicaciones ON productos.ubicacion_id = ubicaciones.id
                   LEFT JOIN marcas ON productos.marca_id = marcas.id
                   WHERE productos.id = $productoId";

    $result = $conn->query($info_query);

    if ($result->num_rows > 0) {
        $productoInfo = $result->fetch_assoc();
        echo json_encode($productoInfo);
    } else {
        echo json_encode(array("error" => "Producto no encontrado"));
    }
} else {
    echo json_encode(array("error" => "ID de producto no proporcionado"));
}
?>
