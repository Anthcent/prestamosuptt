<?php
// Incluir el archivo de conexión a la base de datos
include '../db.php';
// Incluir la biblioteca TCPDF
require_once('../tcpdf/tcpdf.php');

// Crear nueva instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8', false);

// Establecer el título del documento
$pdf->SetTitle('Reporte de Personal');

// Agregar una página
$pdf->AddPage();
$pdf->ImageSVG('../logo.svg', $x = 180, $y = 10, $w = 15, $h = 0, '', $align='', $palign='', $border=0, $fitonpage=false);
// Encabezado
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Personal', 0, 1, 'C');
$pdf->Ln(10);

// Crear una tabla para mostrar los datos
$pdf->SetFont('times', '', 10); // Reducir el tamaño de la fuente

// Encabezados de la tabla
$pdf->SetFillColor(173, 216, 230); // Color de fondo del encabezado
$pdf->SetDrawColor(0); // Color del borde
$pdf->SetTextColor(0);
$pdf->Cell(7, 7, 'ID', 1, 0, 'C', true);
$pdf->Cell(23, 7, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(23, 7, 'Apellido', 1, 0, 'C', true);
$pdf->Cell(23, 7, 'Cédula', 1, 0, 'C', true);
$pdf->Cell(23, 7, 'Cargo', 1, 0, 'C', true);
$pdf->Cell(23, 7, 'Departamento', 1, 0, 'C', true);
$pdf->Cell(23, 7, 'Teléfono', 1, 0, 'C', true);
$pdf->Cell(45, 7, 'Dirección de Hogar', 1, 1, 'C', true);

// Obtener y mostrar los registros de personal de la base de datos
$result = $conn->query("SELECT * FROM personal");
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(7, 7, $row['id'], 1, 0, 'C');
    $pdf->Cell(23, 7, $row['nombre'], 1, 0, 'C');
    $pdf->Cell(23, 7, $row['apellido'], 1, 0, 'C');
    $pdf->Cell(23, 7, $row['cedula'], 1, 0, 'C');
    $pdf->Cell(23, 7, $row['cargo'], 1, 0, 'C');
    $pdf->Cell(23, 7, $row['departamento'], 1, 0, 'C');
    $pdf->Cell(23, 7, $row['telefono'], 1, 0, 'C');
    $pdf->Cell(45, 7, $row['direccion_hogar'], 1, 1, 'C');
}

// Salida del PDF con el nombre de archivo basado en la fecha actual
$nombre_archivo = 'reporte_personal_' . date('Y-m-d') . '.pdf';
$pdf->Output($nombre_archivo, 'I');
?>
