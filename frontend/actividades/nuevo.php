<?php
session_start();
require '../../backend/bd/Conexion.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header('Location: ../usuarios/error.php?error=No tienes permisos para acceder a esta página');
    exit();
}

// Verifica si el formulario fue enviado
if (isset($_POST['register_user'])) {
    // Captura y limpia los datos del formulario
    $username = htmlspecialchars(trim($_POST['username']));
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $rol = htmlspecialchars(trim($_POST['rol']));

    // Hashear la contraseña para seguridad
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL para insertar el nuevo usuario
    $sql = "INSERT INTO users (username, name, email, password, rol, iddoc, created_at) 
            VALUES (:username, :name, :email, :password, :rol, 1, NOW())";

    // Prepara la consulta
    $stmt = $pdo->prepare($sql);

    // Ejecuta la consulta con los valores capturados
    if ($stmt->execute([
        ':username' => $username,
        ':name' => $name,
        ':email' => $email,
        ':password' => $hashed_password,
        ':rol' => $rol
    ])) {
        echo "<script>alert('Usuario registrado exitosamente');</script>";
    } else {
        echo "<script>alert('Hubo un error al registrar el usuario');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/ico.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">



    <title>Enfermería QDL | Nueva pago</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">

        <a href="../admin/escritorio.php" class="brand">Enfermería QDL</a>
        <ul class="side-menu">
            <li><a href="../admin/escritorio.php" ><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bx bxs-book-alt icon' ></i> Citas <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../citas/mostrar.php">Todas las citas</a></li>
                    <li><a href="../citas/nuevo.php">Nueva</a></li>
                    
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-user icon' ></i> Pacientes <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../pacientes/mostrar.php" >Lista de pacientes</a></li>
                    <li><a href="../pacientes/pagos.php">Pagos</a></li>
                    <li><a href="../pacientes/historial.php">Historial de los pacientes</a></li>
                    <li><a href="../pacientes/documentos.php">Documentos</a></li>
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-briefcase icon' ></i> Médicos <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../medicos/mostrar.php">Lista de médicos</a></li>
                    <li><a href="../medicos/historial.php">Historial de los médicos</a></li>
                   
                </ul>
            </li>


            

            <li>
                <a href="#"><i class='bx bxs-user-pin icon' ></i> Recursos humanos<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../recursos/enfermera.php">Enfermera</a></li>
                    <li><a href="../recursos/laboratiorios.php">Laboratorios</a></li>
                    
                </ul>
            </li>

            <li>
                <a href="#" class="active"><i class='bx bxs-diamond icon' ></i> Usuarios<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../actividades/mostrar.php">Pagos</a></li>
                    <li><a href="../actividades/nuevo.php">Nuevo pago</a></li>
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-spray-can icon' ></i> Medicina<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../medicinas/venta.php">Vender</a></li>
                    <li><a href="../medicinas/mostrar.php">Listado</a></li>
                    <li><a href="../medicinas/nuevo.php">Nueva</a></li>
                    <li><a href="../medicinas/categoria.php">Categoria</a></li>

                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-cog icon' ></i> Ajustes<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../ajustes/mostrar.php">Ajustes</a></li>
                    <li><a href="../ajustes/idioma.php">Idioma</a></li>
                    <li><a href="../ajustes/base.php">Base de datos</a></li>
                    
                </ul>
            </li>

            <li><a href="../acerca/mostrar.php"><i class='bx bxs-info-circle icon' ></i> Acerca de</a></li>
          
           
        </ul>
       

    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">

        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar' ></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon' ></i>
                </div>
            </form>
            
           
            <span class="divider"></span>
            <div class="profile">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAUqRSSeB-qxBHux7Hn4hsf94d1-nBkT6XmQ&s/neu.png" alt="">
                <ul class="profile-link">
                    <li><a href="../profile/mostrar.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
                    
                    <li>
                     <a href="../salir.php"><i class='bx bxs-log-out-circle' ></i> Logout</a>
                    </li>
                   
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->

        <main>
            <h1 class="title">Bienvenido <?php echo '<strong>'.$_SESSION['name'].'</strong>'; ?></h1>
            <ul class="breadcrumbs">
                <li><a href="../admin/escritorio.php">Home</a></li>
                <li class="divider">></li>
                <li><a href="../actividades/mostrar.php">Listado de Usuarios</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Nuevo Usuario</a></li>
            </ul>
           
           <!-- multistep form -->


           <form action="" enctype="multipart/form-data" method="POST" autocomplete="off">
  <div class="containerss">
    <h1>Nuevo Usuario</h1>

    <div class="alert-danger">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span><br>
    </div>
    <hr>
    <br>

    <label for="username"><b>Username</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="Nombre de Usuario" name="username" required>

    <label for="name"><b>Nombre del Usuario</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="Nombre del Usuario" name="name" required>

    <label for="email"><b>Correo</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="Correo del Usuario" name="email" required>

    <label for="password"><b>Contraseña</b></label><span class="badge-warning">*</span>
    <input type="password" placeholder="Contraseña" name="password" required>

    <label for="rol"><b>Rol</b></label><span class="badge-warning">*</span>
    <select required name="rol">
      <option value="">Seleccione</option>
      <option value="1">Administrador</option>
      <option value="2">Supervisor</option>
      <option value="3">Usuario</option>
    </select>

    <hr>

    <button type="submit" name="register_user" class="registerbtn">Guardar</button>
  </div>
</form>


        </main>
        <!-- MAIN -->
    </section>
    <script src="../../backend/js/jquery.min.js"></script>


    <!-- NAVBAR -->
    
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    <script src="../../backend/js/patiens.js"></script>
    <script src="../../backend/js/doctor.js"></script>
    <script src="../../backend/js/laboratory.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
     <?php include_once '../../backend/php/add_appointment.php' ?>
   
</body>
</html>