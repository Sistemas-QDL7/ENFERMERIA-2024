<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_laboratory']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    $nomlab=trim($_POST['labname']);
    

   
    
  if(empty($nomlab)){
   $errMSG = "Please enter cedula.";
  }

   
  $stmt = "SELECT * FROM laboratory WHERE nomlab ='$nomlab'";
   if(empty($nomlab)) {
             echo '<script type="text/javascript">
swal("Error!", "Ya esta agregado", "error").then(function() {
            window.location = "laboratorios_nuevo.php";
        });
        </script>';
         }

         else
         {  // Validaremos primero que el document no exista
            $sql="SELECT * FROM laboratory WHERE nomlab ='$nomlab'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO laboratory(nomlab,state) VALUES(:nomlab,'1')");


$stmt->bindParam(':nomlab',$nomlab);
;


   if($stmt->execute())
   {
    echo '<script type="text/javascript">
swal("Agregado!", "Agregado correctamente", "success").then(function() {
            window.location = "laboratiorios.php";
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
            window.location = "laboratorios_nuevo.php";
        });
        </script>';

 // if no error occured, continue ....

}
  

  }
 
 }
?>