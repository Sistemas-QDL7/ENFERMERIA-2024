

 <?php
    require_once('../../backend/bd/Conexion.php'); 
    
    $docdoc = $_POST['docdoc'];
    $docidpa = $_POST['docidpa'];
    $docnopa = $_POST['docnopa'];

    if (isset($_FILES['image']['name'])) {
         $cpath="../../backend/img/subidas/";
    $file_parts = pathinfo($_FILES["image"]["name"]);
    $file_path = 'resume'.time().'.'.$file_parts['extension'];
    move_uploaded_file($_FILES["image"]["tmp_name"], $cpath.$file_path);
    $cv2 = $file_path;
    }

    $sql="INSERT INTO document(nomfi, fils, idpa, nompa,state) VALUES ('$docdoc', '$cv2', '$docidpa', '$docnopa','1')";
 $connect->exec($sql);
echo 'Agregado correctamente';

  ?>