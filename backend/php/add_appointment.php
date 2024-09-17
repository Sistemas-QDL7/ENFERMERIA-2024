<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_appointment']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    $title=trim($_POST['appnam']);
    $idpa=trim($_POST['apppac']);
    $idodc=trim($_POST['appdoc']);
    $idlab=trim($_POST['applab']);
    $color=trim($_POST['appco']);
    $start=$_POST['appini'];
    $end=$_POST['appfin'];
    $monto=$_POST['appmont'];
    $chec=$_POST['appreal'];
    
 ///////// Fin informacion enviada por el formulario /// 

////////////// Insertar a la tabla la informacion generada /////////
$sql="INSERT INTO events(title, idpa,idodc,idlab,color,start,end, state, monto,chec) 
VALUES(:title, :idpa,:idodc,:idlab,:color,:start, :start,1, :monto,:chec)";
    
$sql = $connect->prepare($sql);
    
$sql->bindParam(':title',$title);
$sql->bindParam(':idpa',$idpa);
$sql->bindParam(':idodc',$idodc);
$sql->bindParam(':idlab',$idlab);
$sql->bindParam(':color',$color);
$sql->bindParam(':start',$start);
$sql->bindParam(':end',$end);
$sql->bindParam(':monto',$monto);
$sql->bindParam(':chec',$chec);


//$sql->bindParam(':rol',$rol,PDO::PARAM_STR);
    
$sql->execute();

$lastInsertId = $connect->lastInsertId();
if($lastInsertId>0){

    echo '<script type="text/javascript">
swal("¡Registrado!", "Se reservo la cita correctamente", "success").then(function() {
            window.location = "../citas/calendario.php";
        });
        </script>';
}
else{
    

 echo '<script type="text/javascript">
swal("Error!", "No se pueden agregar datos,  comuníquese con el administrador ", "error").then(function() {
            window.location = "nuevo.php";
        });
        </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>