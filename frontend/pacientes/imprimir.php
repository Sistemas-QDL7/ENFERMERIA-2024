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
    $this->Image('../../backend/img/ico.png',25,5,33);
    $this->SetFont('times', 'B', 13);
    $this->Text(75, 15, utf8_decode('Clínica Salud'));
    $this->Text(75, 20, utf8_decode('Dr(a): '.$_SESSION['name'].''));
    $this->Text(75,25, utf8_decode('Tel: 7785-8223'));
    $this->Text(75,30, utf8_decode('clinicasalud@gmail.com'));
    
    
    $this->Image('../../backend/img/neu.png',160,5,33);


//información de # de factura

    // Agregamos los datos del cliente
    $this->SetFont('Arial','B',10);    
    $this->Text(10,48, utf8_decode('DATOS DEL PACIENTE'));
    $this->Ln(50);

    // Agregamos los Genograma del paciente

    $this->SetFont('Arial','B',10);    
    $this->Text(10,75, utf8_decode('GENOGRAMA DEL PACIENTE'));
    $this->Ln(50);


// Agregamos los Consulta del paciente

    $this->SetFont('Arial','B',10);    
    $this->Text(10,166, utf8_decode('CONSULTA DEL PACIENTE'));
    $this->Ln(50);
    


     // Agregamos los Consulta del paciente

    $this->SetFont('Arial','B',10);    
    $this->Text(10,199, utf8_decode('TRATAMIENTO DEL PACIENTE'));
    $this->Ln(50);


       
}

function Footer()
{
     $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,5,utf8_decode("clinicasalud © Todos los derechos reservados."),0,0,"C");
        
}

}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

$pdf->setY(50);$pdf->setX(135);
    $pdf->Ln();

    // En esta parte estan los encabezados

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20, 7, utf8_decode('DNI'),1,0,'C',0);
    $pdf->Cell(40, 7, utf8_decode('Nombre'),1,0,'C',0);
    $pdf->Cell(40, 7, utf8_decode('Apellido'),1,0,'C',0);
    $pdf->Cell(30, 7, utf8_decode('Nacimiento'),1,0,'C',0);
    $pdf->Cell(30, 7, utf8_decode('Género'),1,0,'C',0);
    $pdf->Cell(30, 7, utf8_decode('Sangre'),1,1,'C',0);
    $pdf->SetFont('Arial','',10);


    require '../../backend/bd/Conexion.php';
    $id = $_GET['id'];
    $stmt = $connect->prepare("SELECT * FROM patients WHERE idpa= '$id'");

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    while($row = $stmt->fetch()){
   
    $pdf->Cell(20, 7, utf8_decode($row['numhs']),1,0,'L',0);
    $pdf->Cell(40, 7, utf8_decode($row['nompa']),1,0,'L',0);
    $pdf->Cell(40, 7, utf8_decode($row['apepa']),1,0,'L',0);
    $pdf->Cell(30, 7, utf8_decode($row['cump']),1,0,'L',0);
    $pdf->Cell(30, 7, utf8_decode($row['sex']),1,0,'L',0);


    $pdf->Cell(30, 7, utf8_decode($row['grup']),1,0,'R',0);

     $pdf->Ln(10);
  
   //Genograma del paciente


     $pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

$pdf->setY(70);$pdf->setX(135);
    $pdf->Ln();

    // En esta parte estan los encabezados

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(40, 7, utf8_decode('Fecha'),1,0,'C',0);
    $pdf->Cell(150, 7, utf8_decode('Asunto'),1,1,'C',0);

    $pdf->SetFont('Arial','',10);

     //Aqui inicia 
    $id = $_GET['id'];
    $ge = $connect->prepare("SELECT * FROM genogram  WHERE idpa= '$id'");
    $ge->setFetchMode(PDO::FETCH_ASSOC);
    $ge->execute();

    while($raw = $ge->fetch()){

      $pdf->Cell(40, 15, utf8_decode($raw['fere']),1,0,'L',0);
      $pdf->MultiCell(150,15,utf8_decode($raw['detage']),'LRTB','L',false);

    }


//CONSSULTA del paciente


$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

$pdf->setY(155);$pdf->setX(135);
    $pdf->Ln();

    // En esta parte estan los encabezados

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(40, 7, utf8_decode('Fecha'),1,0,'C',0);
    $pdf->Cell(150, 7, utf8_decode('Asunto'),1,1,'C',0);

    $pdf->SetFont('Arial','',10);

    //Aqui inicia 
    $id = $_GET['id'];
    $ge = $connect->prepare("SELECT * FROM consult  WHERE idpa= '$id'");
    $ge->setFetchMode(PDO::FETCH_ASSOC);
    $ge->execute();

    while($raw = $ge->fetch()){

      $pdf->Cell(40, 15, utf8_decode($raw['fere']),1,0,'L',0);
      $pdf->MultiCell(150,15,utf8_decode($raw['mtcl']),'LRTB','L',false);

    }


//TRATAMIENTO del paciente  

$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

$pdf->setY(185);$pdf->setX(135);
    $pdf->Ln();

    // En esta parte estan los encabezados

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(40, 7, utf8_decode('Fecha'),1,0,'C',0);
    $pdf->Cell(150, 7, utf8_decode('Asunto'),1,1,'C',0);

    $pdf->SetFont('Arial','',10);

    //Aqui inicia 
    $id = $_GET['id'];
    $ge = $connect->prepare("SELECT * FROM treatment  WHERE idpa= '$id'");
    $ge->setFetchMode(PDO::FETCH_ASSOC);
    $ge->execute();

    while($raw = $ge->fetch()){

      $pdf->Cell(40, 15, utf8_decode($raw['fere']),1,0,'L',0);
      $pdf->MultiCell(150,15,utf8_decode($raw['nomtra']),'LRTB','L',false);

    }
    
  
}


    $pdf->Output('historia_clinica.pdf', 'D');
 ?>