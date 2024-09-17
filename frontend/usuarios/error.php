<?php
    session_start();

    // Verificar si el usuario tiene una sesión activa
    if (!isset($_SESSION['rol'])) {
        header('Location: ../login.php'); // Redirigir si no hay sesión activa
        exit;
    }

    // Mostrar el mensaje de error
    $error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : 'No tienes acceso a esta página.';

    // Redirigir después de 5 segundos o dejar al usuario en la página de error
    $redirect_url = 'escritorio.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Acceso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1><?php echo $error_message; ?></h1>
    <p>Redirigiendo a la página de inicio en <span id="countdown">5</span> segundos...</p>
    <script>
        // Redirigir después de 5 segundos
        setTimeout(function() {
            window.location.href = "<?php echo $redirect_url; ?>";
        }, 5000);

        // Contador regresivo
        var countdown = 5;
        var countdownElem = document.getElementById('countdown');
        setInterval(function() {
            countdown--;
            countdownElem.textContent = countdown;
        }, 1000);
    </script>
</body>
</html>
