<?php  
if(isset($_POST['add_profileM']))
{
    $idodc = $_POST['mid'];
    $corr = $_POST['come'];
    $username = $_POST['namedc'];
    $password=MD5($_POST['pwdm']);
    $rol = $_POST['rlm'];
    
    try {

        $query = "UPDATE doctor SET corr=:corr, username=:username, password=:password,rol=:rol  WHERE idodc=:idodc LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':corr' => $corr,
            ':username' => $username,
            ':password' => $password,
            ':rol' => $rol,
            ':idodc' => $idodc
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



