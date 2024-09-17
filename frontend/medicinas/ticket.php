<?php
require('../../backend/fpdf/fpdf.php');
date_default_timezone_set('America/El_Salvador');

//podemos definir el ancho en una variable para que no les cueste cambiarlo despues
$ancho = 5;

//definimos la orientacion de la pagina y el array indica el tamaño de la hoja
$pdf=new FPDF('P','mm',array(80,150));
$pdf->AddPage(); 
$pdf->SetFont('Arial','B',8);   

// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(60,4,'Lacodigoteca.com',0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(60,4,'C.I.F.: 01234567A',0,1,'C');
$pdf->Cell(60,4,'C/ Arturo Soria, 1',0,1,'C');
$pdf->Cell(60,4,'C.P.: 28028 Madrid (Madrid)',0,1,'C');
$pdf->Cell(60,4,'999 888 777',0,1,'C');
$pdf->Cell(60,4,'alfredo@lacodigoteca.com',0,1,'C');


$pdf->setX(5);
//              Encabezado

$pdf->Cell(20, 7, utf8_decode('Paciente'),0,0,'C',0);
$pdf->Cell(25, 7, utf8_decode('Médico'),0,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Total'),0,1,'C',0);

//              DATOS


$pdf->setX(5);





$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);
$pdf->setX(15);
$pdf->Cell(5,$ancho+6,utf8_decode('¡GRACIAS POR TU COMPRA!'));

$pdf->Output();
?>