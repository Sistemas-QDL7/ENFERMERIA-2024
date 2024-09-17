<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_docu'])){
///////////// Informacion enviada por el formulario /////////////
    $nomfi=$_POST['docdoc'];
    $idpa=$_POST['docidpa'];
    $nompa=$_POST['docnopa'];
   
    $imgFile = $_FILES['foto']['name'];
    $tmp_dir = $_FILES['foto']['tmp_name'];
    $imgSize = $_FILES['foto']['size'];
///////// Fin informacion enviada por el formulario /// 

  if(empty($nomfi)){
   $errMSG = "Please enter your name.";
  }
  else if(empty($nompa)){
   $errMSG = "Please Enter your number.";
  }

  {
   $upload_dir = '../../backend/img/subidas/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $foto = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$foto);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }

  }

////////////// Insertar a la tabla la informacion generada /////////
$sql="insert into document(nomfi, foto, idpa,nompa,state) 
values(:nomfi, :foto,:idpa,:nompa,'1')";
    
$sql = $connect->prepare($sql);
    
$sql->bindParam(':nomfi',$nomfi,PDO::PARAM_STR, 25);
$sql->bindParam(':foto',$foto,PDO::PARAM_STR, 25);
$sql->bindParam(':idpa',$idpa,PDO::PARAM_STR,25);
$sql->bindParam(':nompa',$nompa,PDO::PARAM_STR,25);

    
$sql->execute();

$lastInsertId = $connect->lastInsertId();
if($lastInsertId>0){

    echo '<script type="text/javascript">
swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
            window.location = "documentos.php";
        });
        </script>';
}
else{
    

 echo '<script type="text/javascript">
swal("Error!", "No se pueden agregar datos,  comuníquese con el administrador ", "error").then(function() {
            window.location = "documentos.php";
        });
        </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>