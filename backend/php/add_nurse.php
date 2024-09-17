<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_nurse']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    $numide=trim($_POST['nuriden']);
    $nomnur=trim($_POST['nurnam']);
    $apenur=trim($_POST['nurape']);
    $nacinur=trim($_POST['nurdat']);
    $sexnur=trim($_POST['nurge']);

   
    
  if(empty($numide)){
   $errMSG = "Please enter cedula.";
  }
  else if(empty($nomnur)){
   $errMSG = "Please Enter your name.";
  }
   
  $stmt = "SELECT * FROM nurse WHERE numide ='$numide'";
   if(empty($numide)) {
             echo '<script type="text/javascript">
swal("Error!", "Ya esta agregado", "error").then(function() {
            window.location = "enfermera_nuevo.php";
        });
        </script>';
         }

         else
         {  // Validaremos primero que el document no exista
            $sql="SELECT * FROM nurse WHERE numide ='$numide'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO nurse(numide,nomnur,apenur,nacinur,sexnur,state) VALUES(:numide,:nomnur,:apenur,:nacinur,:sexnur,'1')");


$stmt->bindParam(':numide',$numide);
$stmt->bindParam(':nomnur',$nomnur);
$stmt->bindParam(':apenur',$apenur);
$stmt->bindParam(':nacinur',$nacinur);
$stmt->bindParam(':sexnur',$sexnur);


   if($stmt->execute())
   {
    echo '<script type="text/javascript">
swal("Agregado!", "Agregado correctamente", "success").then(function() {
            window.location = "enfermera.php";
        });
        </script>';
   }
   else
   {
    $errMSG = "error while inserting....";
   }

  } 
            }

                else{

                     echo '<script type="text/javascript">
swal("Error!", "Error", "error").then(function() {
            window.location = "enfermera_nuevo.php";
        });
        </script>';

 // if no error occured, continue ....

}
  

  }
 
 }
?>