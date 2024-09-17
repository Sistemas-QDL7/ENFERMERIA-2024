<?php
    require_once('../../backend/bd/Conexion.php');

  

        $consl=$_POST['consl'];
        $csidpa=$_POST['csidpa'];
        $csnopa=$_POST['csnopa'];
        
////////////// Insertar a la tabla la informacion generada /////////

       

$sql="INSERT INTO consult(mtcl, idpa, nompa, state) VALUES ('$consl', '$csidpa', '$csnopa','1')";
 $connect->exec($sql);
echo "Agregado correctamente";




?>