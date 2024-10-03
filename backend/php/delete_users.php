<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_patients'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `users` WHERE `id`=:id";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':id', $id, PDO::PARAM_INT);
$id=trim($_POST['id']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<div id="cookiePopup" class="hide">
      <img src="../../backend/img/404-tick.png" />
      <p>
        Eliminado correctamente
      </p>
      <button id="acceptCookie" type="button">OK</button>
    </div>';
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


 

