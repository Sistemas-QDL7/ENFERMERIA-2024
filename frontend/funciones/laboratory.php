 <?php 
 require '../../backend/bd/Conexion.php';
 echo '<option value="0">Seleccione</option>';
 $stmt = $connect->prepare('SELECT * FROM `laboratory` ORDER BY idlab   ASC');

  $stmt->execute();


  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>
            <option value="<?php echo $idlab; ?>"><?php echo $nomlab; ?></option>

            <?php
        }

  ?>


