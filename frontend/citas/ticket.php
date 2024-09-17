<?php
require('../../backend/fpdf/fpdf.php');
date_default_timezone_set('America/El_Salvador');

//podemos definir el ancho en una variable para que no les cueste cambiarlo despues
$ancho = 5;

//definimos la orientacion de la pagina y el array indica el tamaño de la hoja
$pdf=new FPDF('P','mm',array(80,150));
$pdf->AddPage(); 
$pdf->SetFont('Arial','B',8);   

$pdf->setY(5);
$pdf->setX(15);

$pdf->Cell(50,$ancho, utf8_decode('Enfermería QDL'),'B',0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',7);   

$pdf->setX(5);
//              Encabezado

$pdf->Cell(20, 7, utf8_decode('Paciente'),0,0,'C',0);
$pdf->Cell(25, 7, utf8_decode('Médico'),0,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Total'),0,1,'C',0);

//              DATOS


$pdf->setX(5);


 require '../../backend/bd/Conexion.php';
    $id = $_GET['id'];
    $stmt = $connect->prepare("SELECT events.id, events.title, patients.idpa, patients.numhs,patients.nompa, patients.apepa, doctor.idodc, doctor.ceddoc, doctor.nodoc, doctor.apdoc, laboratory.idlab, laboratory.nomlab, events.start, events.end, events.color, events.state,events.chec,events.monto FROM events INNER JOIN patients ON events.idpa = patients.idpa INNER JOIN doctor ON events.idodc = doctor.idodc INNER JOIN laboratory ON events.idlab = laboratory.idlab WHERE events.id= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while($row = $stmt->fetch()){


$pdf->Cell(20, 5, utf8_decode($row['nompa']),0,0,'C',0);
$pdf->Cell(25, 5, utf8_decode($row['nodoc'] ."\n".  $row['apdoc']),0,0,'C',0);
$pdf->Cell(20, 5,'S/'.($row['monto']),0,1,'C',0);


$pdf->Ln(5);
//              TOTAL
$pdf->setX(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(45,5,'TOTAL',0,0,'L',0);

$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,'S/'.($row['monto']));


}

$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);
$pdf->setX(15);
$pdf->Cell(5,$ancho+6,utf8_decode('¡GRACIAS POR TU COMPRA!'));

$pdf->Output('ticket.pdf', 'D');
?>