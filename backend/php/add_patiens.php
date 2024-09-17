<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_patiens']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    $numhs=trim($_POST['nhi']);
    $nompa=trim($_POST['namp']);
    $apepa=trim($_POST['apep']);
    $direc=trim($_POST['dip']);
    $sex=trim($_POST['gep']);
    $grup=trim($_POST['grp']);
    $phon=trim($_POST['telp']);
    $cump=trim($_POST['cump']);
    
   
    
  if(empty($numhs)){
   $errMSG = "Please enter number.";
  }
  else if(empty($nompa)){
   $errMSG = "Please Enter your name.";
  }
   
  $stmt = "SELECT * FROM patients WHERE numhs ='$numhs'";
   if(empty($numhs)) {
             echo '<div id="cookiePopup" class="hide">
      <img src="../../backend/img/error.png" />
      <p>
        Ya existe el registro a agregar!
      </p>
      <button id="acceptCookie" type="button">OK</button>
    </div>';
         }

         else
         {  // Validaremos primero que el document no exista
            $sql="SELECT * FROM patients WHERE numhs ='$numhs'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO patients(numhs,nompa,apepa,direc,sex, grup, phon,cump,state) VALUES(:numhs,:nompa,:apepa,:direc,:sex,:grup,:phon,:cump, '1')");


$stmt->bindParam(':numhs',$numhs);
$stmt->bindParam(':nompa',$nompa);
$stmt->bindParam(':apepa',$apepa);
$stmt->bindParam(':direc',$direc);
$stmt->bindParam(':sex',$sex);
$stmt->bindParam(':grup',$grup);
$stmt->bindParam(':phon',$phon);
$stmt->bindParam(':cump',$cump);


   if($stmt->execute())
   {
    echo '<div id="cookiePopup" class="hide">
      <img src="../../backend/img/404-tick.png" />
      <p>
        Agregado correctamente
      </p>
      <button id="acceptCookie" type="button">OK</button>
    </div>';
   }
   else
   {
    $errMSG = "error while inserting....";
   }

  } 
            }

                else{

                     echo '<div id="cookiePopup" class="hide">
      <img src="../../backend/img/error.png" />
      <p>
        ERROR
      </p>
      <button id="acceptCookie" type="button">OK</button>
    </div>';

 // if no error occured, continue ....

}
  

  }
 
 }
?>