<?php 
    require '../backend/bd/Conexion.php';

    if(isset($_POST['login'])) {
        $errMsg = '';

        // Obtener datos del formulario
        $username = $_POST['username'];
        $password = MD5($_POST['password']);

        if($username == '')
            $errMsg = 'Digite su usuario';
        if($password == '')
            $errMsg = 'Digite su contraseña';

        if($errMsg == '') {
            try {
                // Consulta SQL para verificar el usuario
                $stmt = $connect->prepare('SELECT id, username, name, email, password, rol , idodc FROM users WHERE username = :username');
                $stmt->execute(array(':username' => $username));
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                if($data == false) {
                    $errMsg = "El usuario: $username no se encuentra, puede solicitarlo con SISTEMAS TI.";
                } else {
                    if($password == $data['password']) {
                        // Asignación de variables de sesión
                        session_start();
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['name'] = $data['name'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['rol'] = $data['rol'];
                        $_SESSION['idodc'] = $data['idodc'];

                        // Redirección según el rol
                        if($_SESSION['rol'] == 1) {
                            // Redirigir al administrador
                            header('Location: admin/escritorio.php');
                        } elseif($_SESSION['rol'] == 2) {
                            // Redirigir al usuario normal
                            header('Location: usuarios/escritorio.php');
                        }
                        exit;
                    } else {
                        $errMsg = 'Contraseña incorrecta.';
                    }
                }
            } catch(PDOException $e) {
                $errMsg = $e->getMessage();
            }
        }
    }
?>
