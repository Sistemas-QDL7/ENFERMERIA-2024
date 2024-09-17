

  
  <?php 
  require '../../backend/bd/Conexion.php'; 
  $el_continente = $_POST['continente'];
  $stmt = $connect->query("SELECT * FROM doctor WHERE idodc = $el_continente");



  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{

  echo '<option value="' . $row['idodc']. '">' . $row['nomesp'] . '</option>' . "\n";
}

   ?>

  