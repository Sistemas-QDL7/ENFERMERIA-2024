 <?php 
 require '../../backend/bd/Conexion.php';
 echo '<option value="0">Seleccione</option>';
 $stmt = $connect->prepare('SELECT * FROM `patients` ORDER BY idpa   ASC');

  $stmt->execute();


  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>
            <option value="<?php echo $idpa; ?>"><?php echo $nompa; ?>&nbsp;<?php echo $apepa; ?></option>

            <?php
        }

  ?>


