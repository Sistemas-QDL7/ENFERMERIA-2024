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
        $this->Text(25, 15, utf8_decode('Enfermería QDL'));

        // Teléfono
        $this->Text(25, 20, utf8_decode('Tel: 625 581 9191 ext. 290'));

        // Imagen
        $this->Image('../../backend/img/neu.png', 130, 1, 70);

        // Fecha
        $this->SetFont('Arial', 'B', 10);    
        $this->Text(10, 48, utf8_decode('Fecha:'));
        $this->SetFont('Arial', '', 10);    
        $this->Text(25, 48, date('d/m/Y'));

        // Responsable de la consulta (se completa en el cuerpo del PDF)
        $this->SetFont('Arial', 'B', 10);    
        $this->Text(10, 54, utf8_decode('Responsable:     '));
    }

    // Pie de página
    function Footer()
    {
        $this->SetFont('helvetica', 'B', 8);
        $this->SetY(265);
        $this->Cell(95, 5, utf8_decode('Página ').$this->PageNo().' / {nb}', 0, 0, 'L');
        $this->Cell(95, 5, date('d/m/Y | g:i:a') , 0, 1, 'R');
        $this->Line(10, 287, 200, 287);
        
        // Añadir los datos que quitamos del encabezado
        $this->Cell(0, 5, utf8_decode("QUESERÍA DOS LAGUNAS S.A. de C.V."), 0, 1, "C");
        $this->Cell(0, 5, utf8_decode('Imprimió: ' . $_SESSION['name']), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('Correo: ' . $_SESSION['email']), 0, 0, 'C');
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
$pdf->Cell(70, 7, utf8_decode('Motivo'), 1, 0, 'C', 0);
$pdf->Cell(55, 7, utf8_decode('Paciente'), 1, 0, 'C', 0);
$pdf->Cell(70, 7, utf8_decode('Fecha'), 1, 1, 'C', 0);

$pdf->SetFont('Arial', '', 10);

// Conectar a la base de datos y obtener los datos
require '../../backend/bd/Conexion.php';
$id = $_GET['id'];
$stmt = $connect->prepare("SELECT events.id, events.title, patients.idpa, patients.numhs, patients.nompa, patients.apepa, doctor.idodc, doctor.ceddoc, doctor.nodoc, doctor.apdoc, laboratory.idlab, laboratory.nomlab, events.start, events.end, events.color, events.state, events.chec, events.monto FROM events INNER JOIN patients ON events.idpa = patients.idpa INNER JOIN doctor ON events.idodc = doctor.idodc INNER JOIN laboratory ON events.idlab = laboratory.idlab WHERE events.id= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while ($row = $stmt->fetch()) {
    // Llenar la tabla con los datos obtenidos
    $pdf->Cell(70, 7, utf8_decode($row['title']), 1, 0, 'L', 0);
    $pdf->Cell(55, 7, utf8_decode($row['nompa'] . " " . $row['apepa']), 1, 0, 'L', 0);
    $pdf->Cell(70, 7, utf8_decode($row['start'] ."\n".  $row['end']), 1, 1, 'R', 0);

    // Agregar responsable (doctor/enfermero) debajo de la fecha
    $pdf->SetFont('Arial', '', 10);    
    $pdf->Text(30, 54, utf8_decode('    '.$row['nodoc'] . ' ' . $row['apdoc']));

    // Nueva tabla para el monto
    $pdf->Ln(10); // Salto de línea antes de la nueva tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(100, 7, utf8_decode('Descripción'), 1, 0, 'C', 0);
    $pdf->Cell(50, 7, utf8_decode('Medicamentos'), 1, 1, 'C', 0);

    // Datos de la tabla del monto
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(100, 7, utf8_decode('Consulta médica'), 1, 0, 'L', 0); 
    $pdf->Cell(50, 7,  utf8_decode($row['monto']), 1, 1, 'R', 0);

    // Construir el nombre del archivo usando nompa, apepa y numhs
    $fileName = 'receta_' . $row['nompa'] . ' ' . $row['apepa'] . '_' . $row['numhs'] . '.pdf';
}

// Guardar el archivo PDF con el nombre generado
$pdf->Output($fileName, 'D');
?>

