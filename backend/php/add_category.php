<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_category']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    $nomcat=trim($_POST['catename']);


   
    
  if(empty($nomcat)){
   $errMSG = "Please enter cedula.";
  }
  
   
  $stmt = "SELECT * FROM category WHERE nomcat ='$nomcat'";
   if(empty($nomcat)) {
             echo '<script type="text/javascript">
swal("Error!", "Ya esta agregado", "error").then(function() {
            window.location = "categoria_nuevo.php";
        });
        </script>';
         }

         else
         {  // Validaremos primero que el document no exista
            $sql="SELECT * FROM category WHERE nomcat ='$nomcat'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO category(nomcat,state) VALUES(:nomcat,'1')");


$stmt->bindParam(':nomcat',$nomcat);



   if($stmt->execute())
   {
    echo '<script type="text/javascript">
swal("Agregado!", "Agregado correctamente", "success").then(function() {
            window.location = "categoria.php";
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
            window.location = "categoria_nuevo.php";
        });
        </script>';

 // if no error occured, continue ....

}
  

  }
 
 }
?>