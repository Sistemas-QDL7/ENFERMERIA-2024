<?php
    require_once('../../backend/bd/Conexion.php');

  

        $consl1=$_POST['consl'];
        $csidpa1=$_POST['csidpa'];
        $csnopa1=$_POST['csnopa'];
        
////////////// Insertar a la tabla la informacion generada /////////

       

$sql="INSERT INTO consult(mtcl, idpa, nompa, state) VALUES ('$consl1', '$csidpa1', '$csnopa1','1')";
 $connect->exec($sql);
echo 'Agregado correctamente';




?>