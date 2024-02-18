<?php
require_once('../tcpdf/tcpdf.php');
include '../db.php';

// Crear nueva instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8', false);

// Establecer el título del documento
$pdf->SetTitle('Reporte de Productos');

// Agregar una página
$pdf->AddPage();
$pdf->ImageSVG('../logo.svg', $x = 180, $y = 10, $w = 15, $h = 0, '', $align='', $palign='', $border=0, $fitonpage=false);
// Encabezado
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Personal', 0, 1, 'C');
$pdf->Ln(10);

// Crear una tabla para mostrar los datos
$pdf->SetFont('times', '', 10); 


// Encabezados de la tabla
$pdf->SetFillColor(173, 216, 230); // Color de fondo del encabezado
$pdf->SetDrawColor(0); // Color del borde
$pdf->SetTextColor(0); // Color del texto
$pdf->Cell(15, 7, 'ID', 1, 0, 'C', true); // Agregar la propiedad 'true' para aplicar el color de fondo
$pdf->Cell(50, 7, 'Nombre del Producto', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'Cantidad Disponible', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'Categoría', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'Ubicación', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'Marca', 1, 1, 'C', true);

// Obtener y mostrar los productos de la base de datos
$result = $conn->query("SELECT * FROM productos");
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(15, 7, $row['id'], 1, 0, 'C');
    $pdf->Cell(50, 7, $row['nombre'], 1, 0, 'C');
    $pdf->Cell(30, 7, $row['cantidad_disponible'], 1, 0, 'C');

    // Obtener el nombre de la categoría a partir de su ID
    if (!empty($row['categoria_id'])) {
        $categoria_result = $conn->query("SELECT nombre FROM categorias WHERE id = " . $row['categoria_id']);
        if (!$categoria_result) {
            die("Error al obtener la categoría: " . $conn->error);
        }
        $categoria_nombre = $categoria_result->fetch_assoc()['nombre'];
    } else {
        $categoria_nombre = "N/A";
    }

    // Obtener el nombre de la ubicación a partir de su ID
    if (!empty($row['ubicacion_id'])) {
        $ubicacion_result = $conn->query("SELECT nombre FROM ubicaciones WHERE id = " . $row['ubicacion_id']);
        if (!$ubicacion_result) {
            die("Error al obtener la ubicación: " . $conn->error);
        }
        $ubicacion_nombre = $ubicacion_result->fetch_assoc()['nombre'];
    } else {
        $ubicacion_nombre = "N/A";
    }

    // Obtener el nombre de la marca a partir de su ID
    if (!empty($row['marca_id'])) {
        $marca_result = $conn->query("SELECT nombre FROM marcas WHERE id = " . $row['marca_id']);
        if (!$marca_result) {
            die("Error al obtener la marca: " . $conn->error);
        }
        $marca_nombre = $marca_result->fetch_assoc()['nombre'];
    } else {
        $marca_nombre = "N/A";
    }

    $pdf->Cell(30, 7, $categoria_nombre, 1, 0, 'C');
    $pdf->Cell(30, 7, $ubicacion_nombre, 1, 0, 'C');
    $pdf->Cell(30, 7, $marca_nombre, 1, 1, 'C');
}

// Salida del PDF con nombre personalizado
$fecha_actual = date('Y-m-d_H-i-s');
$nombre_pdf = 'reporte_productos_' . $fecha_actual . '.pdf';
$pdf->Output($nombre_pdf, 'I');
?>
