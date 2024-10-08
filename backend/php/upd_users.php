<?php  
if(isset($_POST['upd_users']))
{

    $username =  $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $rol =  $_POST['rol'];
    $id = $_POST['id'];
    
    try {

        $query = "UPDATE users SET username=:username, name=:name, email=:email,password=:password, rol=:rol WHERE id=:id LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':username' => $username,
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':rol' => $rol,
            ':id' => $id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<div class="alert-success">
  <strong>Exito!</strong> Usuario actualizado correctamente &nbsp;<span class="badge-warning">*</span>
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