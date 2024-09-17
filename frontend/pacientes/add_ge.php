<?php
    require_once('../../backend/bd/Conexion.php');

  

        $det2=$_POST['det1'];
        $pa2=$_POST['pa1'];
        $nomp2=$_POST['nomp1'];
        
////////////// Insertar a la tabla la informacion generada /////////

       

$sql="INSERT INTO genogram(detage, idpa, nompa, state) VALUES ('$det2', '$pa2', '$nomp2','1')";
 $connect->exec($sql);
echo "Agregado correctamente";




?>