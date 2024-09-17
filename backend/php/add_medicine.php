<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_medicine']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    $codpro=trim($_POST['medicode']);
    $nompro=trim($_POST['mediname']);
    $idcat=trim($_POST['medicate']);
    $preprd=trim($_POST['mediprec']);
    $stock=trim($_POST['medistoc']);


   
    
  if(empty($codpro)){
   $errMSG = "Please enter cedula.";
  }
  
   
  $stmt = "SELECT product.idprcd, product.codpro, product.nompro, category.idcat, category.nomcat, product.preprd, product.stock, product.state, product.fere FROM product INNER JOIN category ON product.idcat = category.idcat WHERE codpro ='$codpro'";
   if(empty($codpro)) {
             echo '<script type="text/javascript">
swal("Error!", "Ya esta agregado", "error").then(function() {
            window.location = "categoria_nuevo.php";
        });
        </script>';
         }

         else
         {  // Validaremos primero que el document no exista
            $sql="SELECT product.idprcd, product.codpro, product.nompro, category.idcat, category.nomcat, product.preprd, product.stock, product.state, product.fere FROM product INNER JOIN category ON product.idcat = category.idcat WHERE codpro ='$codpro'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO product(codpro,nompro,idcat,preprd,stock,state) VALUES(:codpro,:nompro,:idcat,:preprd,:stock,'1')");


$stmt->bindParam(':codpro',$codpro);
$stmt->bindParam(':nompro',$nompro);
$stmt->bindParam(':idcat',$idcat);
$stmt->bindParam(':preprd',$preprd);
$stmt->bindParam(':stock',$stock);



   if($stmt->execute())
   {
    echo '<script type="text/javascript">
swal("Agregado!", "Agregado correctamente", "success").then(function() {
            window.location = "mostrar.php";
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
            window.location = "nuevo.php";
        });
        </script>';

 // if no error occured, continue ....

}
  

  }
 
 }
?>