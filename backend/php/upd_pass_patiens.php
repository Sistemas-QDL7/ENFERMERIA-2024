<?php  
if(isset($_POST['upd_pass_patiens']))
{
    $idpa = $_POST['pid'];
    $password=MD5($_POST['pcontr']);
    
    
    try {

        $query = "UPDATE patients SET password=:password WHERE idpa=:idpa LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':password' => $password,
            ':idpa' => $idpa
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



