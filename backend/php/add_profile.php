<?php  
if(isset($_POST['add_profile']))
{
    $idpa = $_POST['pid'];
    $corr = $_POST['cop'];
    $username = $_POST['usp'];
    $password=MD5($_POST['pwdp']);
    $rol = $_POST['rlp'];
    
    try {

        $query = "UPDATE patients SET corr=:corr, username=:username, password=:password,rol=:rol  WHERE idpa=:idpa LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':corr' => $corr,
            ':username' => $username,
            ':password' => $password,
            ':rol' => $rol,
            ':idpa' => $idpa
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<div class="alert-success">
  <strong>Success!</strong> Perfil creado correctamente &nbsp;<span class="badge-warning">*</span>
</div>';
            exit(0);
        }
        else
        {
           echo '<div class="alert-error">
  
  <strong>Error!</strong> No creado &nbsp;<span class="badge-warning">*</span>
</div>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>



