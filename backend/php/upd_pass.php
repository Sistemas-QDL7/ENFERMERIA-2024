<?php
  if(isset($_POST['upd_profile_pass']))
{
        
    $id = $_POST['newid'];
    $password=MD5($_POST['newpass']);
    
    try {

        $query = "UPDATE users SET password=:password WHERE id=:id LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':password' => $password,
            ':id' => $id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
swal("¡Actualizado!", "Contraseña actualizada correctamente", "success").then(function() {
            window.location = "../profile/mostrar.php";
        });
        </script>';
            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error al actualizar", "error").then(function() {
            window.location = "../profile/mostrar.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>