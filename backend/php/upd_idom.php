<?php 
if(isset($_POST['upd_idom']))
{
    $idoma = $_POST['confid'];
    $nomidi = $_POST['confna'];

  
    try {

        $query = "UPDATE idiom SET nomidi=:nomidi WHERE idoma=:idoma LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':nomidi' => $nomidi,
            ':idoma' => $idoma
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
swal("¡Actualizado!", "Actualizada correctamente", "success").then(function() {
            window.location = "../ajustes/idioma.php";
        });
        </script>';
            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error al actualizar la imagen", "error").then(function() {
            window.location = "../ajustes/idioma.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


   ?>