<?php 
session_start();
require '../../backend/fpdf/fpdf.php';
date_default_timezone_set('America/Lima');
class PDF extends FPDF
{
    // Cabecera de página
   

    function Header()
{

    $this->setY(12);
    $this->setX(10);
    //$this->Image('../../backend/img/ico.png',25,5,33);
    $this->SetFont('times', 'B', 13);
    $this->Text(25, 15, utf8_decode('Enfermería QDL'));
    $this->Text(25, 20, utf8_decode('Responsable: '.$_SESSION['name'].''));
    $this->Text(25,25, utf8_decode('Tel:  625 581 9191 ext. 290'));
    $this->Text(25,30, utf8_decode('Correo: '.$_SESSION['email'].''));
    
    
    $this->Image('../../backend/img/neu.png',160,5,33);


//información de # de factura

 // Agregamos los datos del cliente
    $this->SetFont('Arial','B',10);    
    $this->Text(10,48, utf8_decode('Fecha:'));
    $this->SetFont('Arial','',10);    
    $this->Text(25,48, date('d/m/Y'));


    // Agregamos los datos de la factura
    $this->SetFont('Arial','B',10);    
    $this->Text(10,54, utf8_decode('Responsable:'));
    $this->SetFont('Arial','',10);    
    $this->Text(30,54, $_SESSION['name']);



    
    $this->Ln(50);


       
}

function Footer()
{
     $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,5,utf8_decode("QUESERÍA DOS LAGUNAS S.A. de C.V."),0,0,"C");
        
}

}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
 // En esta parte estan los encabezados
 
   

$pdf->SetFont('Arial','B',10);
    
    $pdf->Cell(70, 7, utf8_decode('Motivo'),1,0,'C',0);
    $pdf->Cell(55, 7, utf8_decode('Paciente'),1,0,'C',0);

    $pdf->Cell(70, 7, utf8_decode('Fecha'),1,1,'C',0);
   
    $pdf->SetFont('Arial','',10);

    //Aqui inicia el for con todos los productos

    


    require '../../backend/bd/Conexion.php';
    $id = $_GET['id'];
    $stmt = $connect->prepare("SELECT events.id, events.title, patients.idpa, patients.numhs,patients.nompa, patients.apepa, doctor.idodc, doctor.ceddoc, doctor.nodoc, doctor.apdoc, laboratory.idlab, laboratory.nomlab, events.start, events.end, events.color, events.state,events.chec,events.monto FROM events INNER JOIN patients ON events.idpa = patients.idpa INNER JOIN doctor ON events.idodc = doctor.idodc INNER JOIN laboratory ON events.idlab = laboratory.idlab WHERE events.id= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while($row = $stmt->fetch()){


    $pdf->Cell(70, 7, utf8_decode($row['title']),1,0,'L',0);
    $pdf->Cell(55, 7, utf8_decode($row['nompa']),1,0,'L',0);

    $pdf->Cell(70, 7, utf8_decode($row['start'] ."\n".  $row['end']),1,1,'R',0);
    
   
   

//// Apartir de aqui esta la tabla con los subtotales y totales

       // $pdf->Ln(50);

       // $pdf->setX(95);
       // $pdf->Cell(40,6,'Subtotal',1,0);
       // $pdf->Cell(60,6,'S/'.($row['monto']),'1',1,'R');
       // $pdf->setX(95);
        
       // $pdf->Cell(40,6,'Total',1,0);
        //$pdf->Cell(60,6,'S/'.($row['monto']),'1',1,'R');


}

    $pdf->Output('boleta.pdf', 'D');
 ?>