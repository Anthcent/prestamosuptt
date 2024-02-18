<?php
require_once('../tcpdf/tcpdf.php');
include '../db.php';

// Crear nueva instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8', false);

// Establecer el título del documento
$pdf->SetTitle('UPTT - Reporte de Préstamos');

// Agregar una página
$pdf->AddPage();
// Agregar logo en formato SVG
// Agregar logo en formato SVG
$pdf->ImageSVG('../logo.svg', $x = 180, $y = 10, $w = 15, $h = 0, '', $align='', $palign='', $border=0, $fitonpage=false);
// Encabezado
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Personal', 0, 1, 'C');
$pdf->Ln(10);

// Crear una tabla para mostrar los datos

// Crear una tabla para mostrar los datos
$pdf->SetFont('times', '', 10); // Reducir el tamaño de la fuente

// Encabezados de la tabla
$pdf->SetFillColor(173, 216, 230); // Color de fondo del encabezado
$pdf->SetDrawColor(0); // Color del borde
$pdf->SetTextColor(0); // Color del texto
$pdf->Cell(9, 7, 'ID', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'Persona', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'Cargo', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'Producto', 1, 0, 'C', true);
$pdf->Cell(18, 7, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'Fecha Entrega', 1, 0, 'C', true);
$pdf->Cell(28, 7, 'Fecha Devolucion', 1, 0, 'C', true);
$pdf->Cell(24, 7, 'Estado', 1, 1, 'C', true);

// Obtener y mostrar los préstamos de la base de datos
$result = $conn->query("SELECT prestamos.id, prestamos.persona_nombre, personal.cargo, prestamos.producto_id, prestamos.cantidad_prestada, prestamos.fecha_entrega, prestamos.fecha_devolucion, prestamos.estado FROM prestamos INNER JOIN personal ON prestamos.persona_id = personal.id");
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(9, 7, $row['id'], 1, 0, 'C');
    $pdf->Cell(25, 7, $row['persona_nombre'], 1, 0, 'C');
    $pdf->Cell(25, 7, $row['cargo'], 1, 0, 'C');

    // Obtener el nombre del producto a partir de su ID
    $producto_result = $conn->query("SELECT nombre FROM productos WHERE id = " . $row['producto_id']);
    $producto_nombre = $producto_result->fetch_assoc()['nombre'];

    $pdf->Cell(35, 7, $producto_nombre, 1, 0, 'C');
    $pdf->SetFont('times', 'B', 10); // Establecer la fuente en negrita
    $pdf->Cell(18, 7, $row['cantidad_prestada'], 1, 0, 'C');
    $pdf->SetFont('times', '', 10); // Restaurar la fuente a la normal
    $pdf->Cell(25, 7, $row['fecha_entrega'], 1, 0, 'C');
    $pdf->Cell(28, 7, $row['fecha_devolucion'], 1, 0, 'C');

    // Verificar el estado según la fecha actual
    $fechaEntrega = new DateTime($row['fecha_entrega']);
    $fechaDevolucion = new DateTime($row['fecha_devolucion']);
    $fechaActual = new DateTime();  // Fecha y hora actuales

    $estado = '';
    if ($fechaActual >= $fechaEntrega && $fechaActual <= $fechaDevolucion) {
        $estado = 'ACTIVO';
    } elseif ($fechaActual > $fechaDevolucion) {
        $estado = 'CADUCADO';
    } else {
        $estado = 'Préstamo en curso';
    }

    $pdf->Cell(24, 7, $estado, 1, 1, 'C');

    // Agregar nueva página si la tabla llega al final de la página
    if ($pdf->GetY() > 250) {
        $pdf->AddPage();
    }
}

// Obtener la fecha actual en el formato deseado
$fecha_actual = date('Y-m-d'); // Por ejemplo: 2024-02-20_12-30-15

// Nombre del archivo PDF
$nombre_pdf = 'reporte_prestamo_' . $fecha_actual . '.pdf';

// Salida del PDF con el nombre personalizado
$pdf->Output($nombre_pdf, 'I');

?>
