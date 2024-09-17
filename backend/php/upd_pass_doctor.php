<?php  
if(isset($_POST['upd_pass_doctor']))
{
    $idodc = $_POST['midp'];
    $password=MD5($_POST['mepasne']);
    
    
    try {

        $query = "UPDATE doctor SET password=:password WHERE idodc=:idodc LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':password' => $password,
            ':idodc' => $idodc
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<div class="alert-success">
  <strong>Success!</strong> Contraseña actualizada correctamente &nbsp;<span class="badge-warning">*</span>
</div>';
            exit(0);
        }
        else
        {
           echo '<div class="alert-error">
  
  <strong>Error!</strong> No actualizado &nbsp;<span class="badge-warning">*</span>
</div>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>



