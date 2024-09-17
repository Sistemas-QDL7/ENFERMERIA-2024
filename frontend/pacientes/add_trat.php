<?php
    require_once('../../backend/bd/Conexion.php');
        $trat1=$_POST['trat'];
        $tratdpa1=$_POST['tratdpa'];
        $tratnopa1=$_POST['tratnopa'];
        
////////////// Insertar a la tabla la informacion generada /////////

       

$sql="INSERT INTO treatment(nomtra, idpa, nompa, state) VALUES ('$trat1', '$tratdpa1', '$tratnopa1','1')";
 $connect->exec($sql);
echo 'Agregado correctamente';




?>