<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

    $id=$_SESSION['id'];
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



    <title>Enfermería QDL | Nuevos pacientes</title>
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
                <a href="#" class="active"><i class='bx bxs-user icon' ></i> Empleados <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../pacientes/mostrar.php" >Lista de Empleados</a></li>
                    <li><a href="../pacientes/pagos.php">Pagos</a></li>
                    <li><a href="../pacientes/historial.php">Historial de los Empleados</a></li>
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
                <a href="#"><i class='bx bxs-diamond icon' ></i> Actividades financieras<i class='bx bx-chevron-right icon-right' ></i></a>
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
                <li><a href="../pacientes/mostrar.php">Listado de los Empleados</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Nuevos Empleados</a></li>
            </ul>
           
           <!-- multistep form -->


<form action="" enctype="multipart/form-data" method="POST"  autocomplete="off" onsubmit="return validacion()">
  <div class="containerss">
    <h1>Nuevos Empleados</h1>
    <div class="alert-danger">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span>
</div>
    <hr>

    <label for="email"><b>Número de empleado</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: 77114578" name="nhi" maxlength="8" required>

    <label for="psw"><b>Nombre (s)</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: Juan Raul" name="namp" required>

    <label for="psw"><b>Apellidos</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: Ramirez Requena" name="apep" required>

    <label for="psw"><b>Dirección del empleado</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: calle los medanos" name="dip" required>

    <label for="psw"><b>Género del empleado</b></label><span class="badge-warning">*</span>
    <select required name="gep" id="gep">
        <option>Seleccione</option>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>

    <label for="psw"><b>Área</b></label><span class="badge-warning">*</span>
    <select required name="grp" id="grp">
        <option>Seleccione</option>
        <option value="ACTIVOS FIJOS">ACTIVOS FIJOS</option>
        <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
        <option value="ALMACEN DE MATERIAS PRIMAS">ALMACEN DE MATERIAS PRIMAS</option>
        <option value="ALMACEN DE REFACCIONES">ALMACEN DE REFACCIONES</option>
        <option value="ALMACEN PST">ALMACEN PST</option>
        <option value="ALMACEN PST DEVOLUCIONES">ALMACEN PST DEVOLUCIONES</option>
        <option value="ALMACEN PT">ALMACEN PT</option>
        <option value="AREA PILOTO">AREA PILOTO</option>
        <option value="AUTOSERVICIO GENERAL">AUTOSERVICIO GENERAL</option>
        <option value="BASCULA">BASCULA</option>
        <option value="CAPITAL HUMANO">CAPITAL HUMANO</option>
        <option value="CHOFER">CHOFER</option>
        <option value="COMEDOR">COMEDOR</option>
        <option value="COMODINES">COMODINES</option>
        <option value="COMPRAS DIRECTAS">COMPRAS DIRECTAS</option>
        <option value="COMPRAS INDIRECTAS">COMPRAS INDIRECTAS</option>
        <option value="COMPRAS MP">COMPRAS MP</option>
        <option value="CONTRUCCION">CONTRUCCION</option>
        <option value="CONTROL DE PLAGAS">CONTROL DE PLAGAS</option>
        <option value="CUBICADO">CUBICADO</option>
        <option value="CUENTAS POR PAGAR">CUENTAS POR PAGAR</option>
        <option value="DERIVADOS LACTEOS">DERIVADOS LACTEOS</option>
        <option value="DESMOLDE">DESMOLDE</option>
        <option value="DEVOLUCIONES">DEVOLUCIONES</option>
        <option value="EMBARQUE">EMBARQUE</option>
        <option value="EMBOLSE">EMBOLSE</option>
        <option value="EMPAQUE">EMPAQUE</option>
        <option value="ENFERMERIA">ENFERMERIA</option>
        <option value="FINANZAS">FINANZAS</option>
        <option value="GERS">GERS</option>
        <option value="GESTION DE INVENTARIOS">GESTION DE INVENTARIOS</option>
        <option value="GESTION DE PROYECTOS">GESTION DE PROYECTOS</option>
        <option value="INVESTIGACION Y DESARROLLO">INVESTIGACION Y DESARROLLO</option>
        <option value="LABORATORIO">LABORATORIO</option>
        <option value="LAVAMOLDES">LAVAMOLDES</option>
        <option value="LOGISTICA">LOGISTICA</option>
        <option value="MANTENIMIENTO">MANTENIMIENTO</option>
        <option value="MERCADOTECNIA">MERCADOTECNIA</option>
        <option value="MICROBIOLOGIA">MICROBIOLOGIA</option>
        <option value="MONITOREO">MONITOREO</option>
        <option value="MONTACARGAS">MONTACARGAS</option>
        <option value="NOTAS DE CREDITO">NOTAS DE CREDITO</option>
        <option value="PARTICULARES">PARTICULARES</option>
        <option value="PLANEACION">PLANEACION</option>
        <option value="PLANTA PILOTO">PLANTA PILOTO</option>
        <option value="PREPARACION DE FORMULAS">PREPARACION DE FORMULAS</option>
        <option value="PUNTO DE VENTA">PUNTO DE VENTA</option>
        <option value="QUESO AMERICANO">QUESO AMERICANO</option>
        <option value="QUESO ASADERO">QUESO ASADERO</option>
        <option value="QUESO CHIHUAHUA">QUESO CHIHUAHUA</option>
        <option value="QUESO FRESCO">QUESO FRESCO</option>
        <option value="QUESO PROCESADO">QUESO PROCESADO</option>
        <option value="QUESO RICO">QUESO RICO</option>
        <option value="RECEPCION DE LECHE">RECEPCION DE LECHE</option>
        <option value="RECIBO Y ESTANDARIZACION">RECIBO Y ESTANDARIZACION</option>
        <option value="RECLUTAMIENTO">RECLUTAMIENTO</option>
        <option value="RECURSOS HUMANOS">RECURSOS HUMANOS</option>
        <option value="SABORES ENZIMATICOS">SABORES ENZIMATICOS</option>
        <option value="SANIDAD AREAS COMUNES">SANIDAD AREAS COMUNES</option>
        <option value="SANIDAD AREAS DE PRODUCCION">SANIDAD AREAS DE PRODUCCION</option>
        <option value="SANIDAD EQUIPOS">SANIDAD EQUIPOS</option>
        <option value="SANIDAD PROCESOS">SANIDAD PROCESOS</option>
        <option value="SECADOR">SECADOR</option>
        <option value="SEGURIDAD INDUSTRIAL">SEGURIDAD INDUSTRIAL</option>
        <option value="SEGURIDAD PATRIMONIAL">SEGURIDAD PATRIMONIAL</option>
        <option value="SGI">SGI</option>
        <option value="SISTEMAS TI">SISTEMAS TI</option>
        <option value="TALLER">TALLER</option>
        <option value="TERMOENCOGIDO">TERMOENCOGIDO</option>
        <option value="TJV">TJV</option>
        <option value="TRANSPORTES">TRANSPORTES</option>


    </select>

    <label for="psw"><b>Teléfono del empleado</b></label><span class="badge-warning">*</span>
    <input type="text" maxlength="13" placeholder="ejm: +51 999 888 111" name="telp" required>

    <label for="psw"><b>Fecha de nacimiento del empleado</b></label><span class="badge-warning">*</span>
    <input type="date" name="cump" required>

    <hr>
   
    <button type="submit" name="add_patiens" class="registerbtn">Guardar</button>
  </div>
  
</form>

        </main>
        <!-- MAIN -->
    </section>
    <script src="../../backend/js/jquery.min.js"></script>
<?php include_once '../../backend/php/add_patiens.php' ?>

    <!-- NAVBAR -->
    
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    

    <script type="text/javascript">
    let popUp = document.getElementById("cookiePopup");
//When user clicks the accept button
document.getElementById("acceptCookie").addEventListener("click", () => {
  //Create date object
  let d = new Date();
  //Increment the current time by 1 minute (cookie will expire after 1 minute)
  d.setMinutes(2 + d.getMinutes());
  //Create Cookie withname = myCookieName, value = thisIsMyCookie and expiry time=1 minute
  document.cookie = "myCookieName=thisIsMyCookie; expires = " + d + ";";
  //Hide the popup
  popUp.classList.add("hide");
  popUp.classList.remove("shows");
});
//Check if cookie is already present
const checkCookie = () => {
  //Read the cookie and split on "="
  let input = document.cookie.split("=");
  //Check for our cookie
  if (input[0] == "myCookieName") {
    //Hide the popup
    popUp.classList.add("hide");
    popUp.classList.remove("shows");
  } else {
    //Show the popup
    popUp.classList.add("shows");
    popUp.classList.remove("hide");
  }
};
//Check if cookie exists when page loads
window.onload = () => {
  setTimeout(() => {
    checkCookie();
  }, 2000);
};
    </script>
   
</body>
</html>


