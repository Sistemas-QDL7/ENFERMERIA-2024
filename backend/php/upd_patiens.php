<?php  
if(isset($_POST['upd_patiens']))
{
    $idpa = $_POST['pid'];
    $numhs = $_POST['nhi'];
    $nompa = $_POST['namp'];
    $apepa = $_POST['apep'];
    $direc = $_POST['dip'];
    $sex = $_POST['gep'];
    $grup = $_POST['grp'];
    $phon = $_POST['telp'];
    $cump = $_POST['cump'];
    
    try {

        $query = "UPDATE patients SET numhs=:numhs, nompa=:nompa, apepa=:apepa,direc=:direc,sex=:sex,grup=:grup,phon=:phon, cump=:cump WHERE idpa=:idpa LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':numhs' => $numhs,
            ':nompa' => $nompa,
            ':apepa' => $apepa,
            ':direc' => $direc,
            ':sex' => $sex,
            ':grup' => $grup,
            ':phon' => $phon,
            ':cump' => $cump,
            ':idpa' => $idpa
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
            swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
                        window.location = "../pacientes/mostrar.php";
                    });
                    </script>';
            exit(0);
        }
        else
        {
            echo '<script type="text/javascript">
           swal("Error!", "Error al actualizar", "error").then(function() {
                       window.location = "../pacientes/mostrar.php";
                   });
                   </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>



