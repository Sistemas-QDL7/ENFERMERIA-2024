<?php  
if(isset($_POST['upd_category']))
{
    $idcat = $_POST['cateid'];
    $nomcat = $_POST['catename'];

    
    try {

        $query = "UPDATE category SET nomcat=:nomcat WHERE idcat=:idcat LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':nomcat' => $nomcat,
            
            ':idcat' => $idcat
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
swal("Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "categoria.php";
        });
        </script>';
            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error", "success").then(function() {
            window.location = "categoria.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>



