<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_patients'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `doctor` WHERE `idodc`=:idodc";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':idodc', $idodc, PDO::PARAM_INT);
$idodc=trim($_POST['idodc']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script type="text/javascript">
swal({
  icon: "success",
  title: "Eliminado",
  text: "Eliminado correctamente!",
})
        </script>';
}
else{
    echo '<div id="cookiePopup" class="hide">
      <img src="../../backend/img/error.png" />
      <p>
        No se pudo eliminar el registro 
      </p>
      <button id="acceptCookie" type="button">OK</button>
    </div>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

