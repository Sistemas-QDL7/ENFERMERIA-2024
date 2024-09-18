<?php 
require_once('../../backend/bd/Conexion.php'); 

if (isset($_POST['add_appointment'])) {
    $title = trim($_POST['appnam']);
    $numhs = trim($_POST['apppac']); // El valor de numhs (número de historia clínica)
    $idodc = trim($_POST['appdoc']);
    $idlab = trim($_POST['applab']);
    $color = trim($_POST['appco']);
    $start = $_POST['appini'];
    $end = $_POST['appfin'];
    $monto = $_POST['appmont'];
   // $chec = $_POST['appreal'];

    ///////// Buscar el idpa basado en el numhs /////////
    $stmt = $connect->prepare("SELECT idpa FROM patients WHERE numhs = :numhs");
    $stmt->bindParam(':numhs', $numhs, PDO::PARAM_STR);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($patient) {
        // Si se encontró el paciente, tomar el idpa
        $idpa = $patient['idpa'];

        // Insertar el evento usando el idpa
        $sql = "INSERT INTO events(title, idpa, idodc, idlab, color, start, end, state, monto, chec) 
                VALUES(:title, :idpa, :idodc, :idlab, :color, :start, :end, 1, :monto, 1)";
        
        $sql = $connect->prepare($sql);
        $sql->bindParam(':title', $title);
        $sql->bindParam(':idpa', $idpa);
        $sql->bindParam(':idodc', $idodc);
        $sql->bindParam(':idlab', $idlab);
        $sql->bindParam(':color', $color);
        $sql->bindParam(':start', $start);
        $sql->bindParam(':end', $end);
        $sql->bindParam(':monto', $monto);
        //$sql->bindParam(':chec', $chec);

        $sql->execute();

        $lastInsertId = $connect->lastInsertId();
        if ($lastInsertId > 0) {
            header('Location: ../../frontend/citas/mostrar.php');
            echo '<script type="text/javascript">
            
            swal("¡Registrado!", "Se reservó la cita correctamente", "success").then(function() {
                window.location = "../citas/mostrar.php";
            });
            </script>';
        } else {
            echo '<script type="text/javascript">
            swal("Error!", "No se pueden agregar datos, comuníquese con el administrador", "error").then(function() {
                window.location = "nuevo.php";
            });
            </script>';
            print_r($sql->errorInfo());
        }
    } else {
        // Si el numhs no coincide con un paciente, mostrar error
        echo '<script type="text/javascript">
        swal("Error!", "El número de historia clínica no existe. Verifique el número.", "error").then(function() {
            window.location = "nuevo.php";
        });
        </script>';
    }
}
?>