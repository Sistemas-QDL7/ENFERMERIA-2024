<?php  
if(isset($_POST['upd_profile']))
{
    $id = $_POST['proid'];
    $username = $_POST['prouser'];
    $name = $_POST['proname'];
    $email = $_POST['proema'];

    
    try {

        $query = "UPDATE users SET username=:username,name=:name,email=:email WHERE id=:id LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':username' => $username,
            ':name' => $name,
            ':email' => $email,
            
            ':id' => $id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
swal("Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "../profile/mostrar.php";
        });
        </script>';
            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error", "success").then(function() {
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



