<?php
  

  if(isset($_POST['update_qty']))
{
    $idv = $_POST['prdt'];
    $quantity = $_POST['p_qty'];
    

    try {

        $query = "UPDATE cart SET quantity=:quantity WHERE idv=:idv LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':quantity' => $quantity,
            ':idv' => $idv
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "../medicinas/cart.php";
        });
        </script>';
            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error al actualizar", "error").then(function() {
            window.location = "../medicinas/cart.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>