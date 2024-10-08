<?php
require('../../backend/fpdf/fpdf.php');
date_default_timezone_set('America/El_Salvador');

// Definir ancho para facilitar futuros cambios
$ancho = 5;

// Ajustar tamaño de página
$pdf = new FPDF('P', 'mm', array(80, 130));
$pdf->AddPage(); 

// Agregar logo y ajustar su posición
$pdf->Image('../../backend/img/neu.png', 25, 2, 30); // Logo

// Encabezado
$pdf->SetFont('Arial', 'B', 8);   
$pdf->setY(25); // Posición del encabezado, más cerca del logo
$pdf->setX(15);
$pdf->Cell(50, $ancho, mb_convert_encoding('Enfermería QDL', 'ISO-8859-1', 'UTF-8'), 'B', 0, 'C');

// Fecha y hora
$pdf->Ln(5); // Espacio mayor entre el encabezado y la fecha
$pdf->SetFont('Arial', '', 7);
$pdf->setX(15);
$pdf->Cell(50, 5, mb_convert_encoding('Fecha: ', 'ISO-8859-1', 'UTF-8') . date('d/m/Y'), 0, 1, 'C');
$pdf->Cell(52, 5, mb_convert_encoding('Hora: ', 'ISO-8859-1', 'UTF-8') . date('H:i'), 0, 1, 'C');

// Encabezado de detalles
$pdf->Ln(3); // Espacio reducido entre la fecha y el inicio de los detalles
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(50, 5, mb_convert_encoding('Detalle de la Consulta', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

// Conectar a la base de datos y obtener datos
require '../../backend/bd/Conexion.php';
$id = $_GET['id'];
$stmt = $connect->prepare("SELECT events.id, events.title, patients.idpa, patients.numhs, patients.nompa, patients.apepa, doctor.idodc, doctor.ceddoc, doctor.nodoc, doctor.apdoc, laboratory.idlab, laboratory.nomlab, events.start, events.end, events.color, events.state, events.chec, events.monto FROM events INNER JOIN patients ON events.idpa = patients.idpa INNER JOIN doctor ON events.idodc = doctor.idodc INNER JOIN laboratory ON events.idlab = laboratory.idlab WHERE events.id= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while ($row = $stmt->fetch()) {
    // Paciente
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(50, 5, mb_convert_encoding('Paciente:', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(50, 4, mb_convert_encoding($row['nompa'] . " " . $row['apepa'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

    // Enfermero(a) (Doctor)
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(50, 5, mb_convert_encoding('Enfermero(a):', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(50, 4, mb_convert_encoding($row['nodoc'] . " " . $row['apdoc'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

    // Horario de la consulta
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(50, 5, mb_convert_encoding('Hora de inicio:', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(50, 4, mb_convert_encoding(date('H:i', strtotime($row['start'])), 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(50, 5, mb_convert_encoding('Hora de fin:', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(50, 4, mb_convert_encoding(date('H:i', strtotime($row['end'])), 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

    // Medicamento
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(50, 5, mb_convert_encoding('Medicamento:', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(50, 4, mb_convert_encoding($row['monto'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
}

// Espacio para la línea de firma y texto
$pdf->Ln(6); // Mayor espacio antes de la línea para firmar
$pdf->SetFont('Arial', 'B', 8);

// Dibujar línea horizontal para la firma
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY()); // Ajustar la posición de la línea según sea necesario
$pdf->Ln(4); // Espacio mayor entre la línea y el texto final

$pdf->setX(15);
$pdf->Cell(50, $ancho + 4, mb_convert_encoding('RESPONSABLE EN TURNO', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
//Construir el nombre del archivo
//$fileName = 'ticket_' . $row['nompa'] . ' ' . $row['apepa'] . '_' . $row['numhs'] . '.pdf';
// Generar el PDF
$pdf->Output("ticket.pdf", 'D');
?>
