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
            echo '<script type="text/javascript">
            swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
                        window.location = "../actividades/mostrar.php";
                    });
                    </script>';
            exit(0);
        }
        else
        {
            echo '<script type="text/javascript">
            swal("Error!", "Error al actualizar", "error").then(function() {
                        window.location = "../actividades/mostrar.php";
                    });
                    </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>