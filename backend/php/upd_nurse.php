<?php  
if(isset($_POST['upd_nurse']))
{
    $idnur = $_POST['nuridp'];
    $numide = $_POST['nuriden'];
    $nomnur = $_POST['nurnam'];
    $apenur = $_POST['nurape'];
    $nacinur = $_POST['nurdat'];
    $sexnur = $_POST['nurge'];

    try {

        $query = "UPDATE nurse SET numide=:numide,nomnur=:nomnur,apenur=:apenur,nacinur=:nacinur,sexnur=:sexnur  WHERE idnur=:idnur LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':numide' => $numide,
            ':nomnur' => $nomnur,
            ':apenur' => $apenur,
            ':nacinur' => $nacinur,
            ':sexnur' => $sexnur,
            ':idnur' => $idnur
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
swal("Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "enfermera.php";
        });
        </script>';
            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error", "success").then(function() {
            window.location = "enfermera.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
?>



