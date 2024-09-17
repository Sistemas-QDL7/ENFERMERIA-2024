<?php
    require_once('../../backend/bd/Conexion.php');

  
 $geidpa = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM genogram  WHERE idpa= '$geidpa';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}

 ?>
 <?php if(count($data)>0):?>
        <?php foreach($data as $e):?>

      <div class="core">
      <h3><?php echo $e->fere; ?></h3>
        <?php echo $e->detage; ?>
      </div>
    

<?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>
       

?>