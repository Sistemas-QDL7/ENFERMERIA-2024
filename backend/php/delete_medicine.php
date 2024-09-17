<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_medicine'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `product` WHERE `idprcd`=:idprcd";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':idprcd', $idprcd, PDO::PARAM_INT);
$idprcd=trim($_POST['idprcd']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script type="text/javascript">
swal("Eliminado!", "Eliminado correctamente", "success").then(function() {
            window.location = "mostrar.php";
        });
        </script>';
}
else{
    echo '<script type="text/javascript">
swal("Error!", "Error", "error").then(function() {
            window.location = "mostrar.php";
        });
        </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

