 <?php
/*call the FPDF library*/
require('../../backend/fpdf/fpdf.php');

    
/*A4 width : 219mm*/

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/

$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,1,utf8_decode('Boleta electrónica'),0,100);
$pdf->Cell(59 ,10,'',0,1);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(71 ,5,'Enfermería QDL',0,0);
$pdf->Cell(59 ,5,'',0,0);
$pdf->Cell(59 ,5,'Detalles',0,1);

$pdf->SetFont('Arial','',10);


require '../../backend/bd/Conexion.php';
    $id = $_GET['id'];
    $stmt = $connect->prepare("SELECT * FROM orders WHERE idord= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while($row = $stmt->fetch()){

    $pdf->Cell(130 ,5,'Lima',0,0);
    $pdf->Cell(25 ,5,'Cliente:',0,0);
    $pdf->Cell(34 ,5,$row['nomcl'],0,1);

    $pdf->Cell(130 ,5,'Delhi, 751001',0,0);
    $pdf->Cell(25 ,5,'Fecha:',0,0);
    $pdf->Cell(34 ,5,$row['placed_on'],0,1);

    $pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',10);
/*Heading Of the table*/

$pdf->SetXY(20, 50);
$pdf->SetFillColor(128, 128, 128);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(180,10,"Medicinas",1,0,"C",true);



$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20, 60);
$pdf->MultiCell(180,10,$row['total_products'],1,"L");



$pdf->SetX(120);
$pdf->Cell(50,10,"Subtotal:",1,0,"C");
$pdf->Cell(30,10,number_format($row['total_price'],2),1,1,"R");
$pdf->SetX(120);
$pdf->Cell(50,10,"Total:",1,0,"C");
$pdf->Cell(30,10,number_format($row['total_price'],2),1,1,"R");
}





$pdf->Output('boleta.pdf', 'D');

?>