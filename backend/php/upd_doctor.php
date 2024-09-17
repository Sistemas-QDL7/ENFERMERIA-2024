<?php  
if(isset($_POST['upd_doctors']))
{
    $idodc = $_POST['midp'];
    $ceddoc = $_POST['docce'];
    $nodoc = $_POST['docna'];
    $apdoc = $_POST['docap'];
    $nomesp = $_POST['doces'];
    $direcd = $_POST['docdi'];
    $sexd = $_POST['docge'];
    $phd = $_POST['docte'];
    $nacd = $_POST['docda'];


    try {

        $query = "UPDATE doctor SET ceddoc=:ceddoc,nodoc=:nodoc,apdoc=:apdoc,nomesp=:nomesp,direcd=:direcd,sexd=:sexd,phd=:phd , nacd=:nacd  WHERE idodc=:idodc LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':ceddoc' => $ceddoc,
            ':nodoc' => $nodoc,
            ':apdoc' => $apdoc,
            ':nomesp' => $nomesp,
            ':direcd' => $direcd,
            ':sexd' => $sexd,
            ':phd' => $phd,
            ':nacd' => $nacd,
            ':idodc' => $idodc
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



