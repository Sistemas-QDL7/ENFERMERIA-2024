<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_patients'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `nurse` WHERE `idnur`=:idnur";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':idnur', $idnur, PDO::PARAM_INT);
$idnur=trim($_POST['idnur']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script type="text/javascript">
swal("Eliminado!", "Eliminado correctamente", "success").then(function() {
            window.location = "enfermera.php";
        });
        </script>';
}
else{
    echo '<script type="text/javascript">
swal("Error!", "Error", "error").then(function() {
            window.location = "enfermera.php";
        });
        </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

