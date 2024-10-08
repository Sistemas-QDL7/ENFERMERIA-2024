<?php 
session_start();
require '../../backend/fpdf/fpdf.php';
date_default_timezone_set('America/Lima');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Texto del encabezado
        $this->setY(12);
        $this->setX(10);
        $this->SetFont('times', 'B', 13);
        $this->Text(25, 15, mb_convert_encoding('Enfermería QDL', 'ISO-8859-1', 'UTF-8'));

        // Teléfono
        $this->Text(25, 20, mb_convert_encoding('Tel: 625 581 9191 ext. 290', 'ISO-8859-1', 'UTF-8'));

        // Imagen
        $this->Image('../../backend/img/neu.png', 130, 1, 70);

        // Fecha
        $this->SetFont('Arial', 'B', 10);    
        $this->Text(10, 48, mb_convert_encoding('Fecha:', 'ISO-8859-1', 'UTF-8'));
        $this->SetFont('Arial', '', 10);
        $this->Text(25, 48, date('d/m/Y'));

        // Responsable de la consulta (se completa en el cuerpo del PDF)
        $this->SetFont('Arial', 'B', 10);    
        $this->Text(10, 54, mb_convert_encoding('Responsable:     ', 'ISO-8859-1', 'UTF-8'));
    }

    // Pie de página
    function Footer()
    {
        $this->SetFont('helvetica', 'B', 8);
        $this->SetY(265);
        $this->Cell(95, 5, mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8').$this->PageNo().' / {nb}', 0, 0, 'L');
        $this->Cell(95, 5, date('d/m/Y | g:i:a') , 0, 1, 'R');
        $this->Line(10, 287, 200, 287);
        
        // Añadir los datos que quitamos del encabezado
        $this->Cell(0, 5, mb_convert_encoding("QUESERÍA DOS LAGUNAS S.A. de C.V.", 'ISO-8859-1', 'UTF-8'), 0, 1, "C");
        $this->Cell(0, 5, mb_convert_encoding('Imprimió: ' . $_SESSION['name'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $this->Cell(0, 5, mb_convert_encoding('Correo: ' . $_SESSION['email'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetAutoPageBreak(true, 30);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

$pdf->setY(60);
$pdf->setX(135);
$pdf->Ln();

// Encabezados de la tabla principal
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 7, mb_convert_encoding('Motivo', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->Cell(55, 7, mb_convert_encoding('Paciente', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->Cell(70, 7, mb_convert_encoding('Fecha', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);

$pdf->SetFont('Arial', '', 10);

// Conectar a la base de datos y obtener los datos
require '../../backend/bd/Conexion.php';
$id = $_GET['id'];
$stmt = $connect->prepare("SELECT events.id, events.title, patients.idpa, patients.numhs, patients.nompa, patients.apepa, doctor.idodc, doctor.ceddoc, doctor.nodoc, doctor.apdoc, laboratory.idlab, laboratory.nomlab, events.start, events.end, events.color, events.state, events.chec, events.monto FROM events INNER JOIN patients ON events.idpa = patients.idpa INNER JOIN doctor ON events.idodc = doctor.idodc INNER JOIN laboratory ON events.idlab = laboratory.idlab WHERE events.id= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while ($row = $stmt->fetch()) {
    // Llenar la tabla con los datos obtenidos
    $pdf->Cell(70, 7, mb_convert_encoding($row['title'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->Cell(55, 7, mb_convert_encoding($row['nompa'] . " " . $row['apepa'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->Cell(70, 7, mb_convert_encoding($row['start'] ."\n".  $row['end'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'R', 0);

    // Agregar responsable (doctor/enfermero) debajo de la fecha
    $pdf->SetFont('Arial', '', 10);    
    $pdf->Text(30, 54, mb_convert_encoding('    '.$row['nodoc'] . ' ' . $row['apdoc'], 'ISO-8859-1', 'UTF-8'));

    // Nueva tabla para el monto
    $pdf->Ln(10); // Salto de línea antes de la nueva tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(100, 7, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(50, 7, mb_convert_encoding('Medicamentos', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);

    // Datos de la tabla del monto
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(100, 7, mb_convert_encoding('Consulta médica', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0); 
    $pdf->Cell(50, 7,  mb_convert_encoding($row['monto'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'R', 0);

    // Construir el nombre del archivo usando nompa, apepa y numhs
    $fileName = 'receta_' . $row['nompa'] . ' ' . $row['apepa'] . '_' . $row['numhs'] . '.pdf';
}

// Guardar el archivo PDF con el nombre generado
$pdf->Output($fileName, 'D');
?>

