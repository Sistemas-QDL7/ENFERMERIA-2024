<?php  
if(isset($_POST['upd_app_mone']))
{
    $id = $_POST['appid'];
    $monto = $_POST['appmont'];

    
    try {

        $query = "UPDATE events SET monto=:monto, chec= '1' WHERE id=:id LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':monto' => $monto,
            
            ':id' => $id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
swal("Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "mostrar.php";
        });
        </script>';
            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error", "success").then(function() {
            window.location = "mostrar.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>



