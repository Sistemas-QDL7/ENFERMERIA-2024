<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
        header('Location: ../usuarios/error.php?error=No tienes permisos para acceder a esta página');

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
    



    <title>Enfermería QDL | Documentos del paciente</title>
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
                <a href="#" class="active"><i class='bx bxs-user icon' ></i> Pacientes <i class='bx bx-chevron-right icon-right' ></i></a>
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
                <li><a href="../pacientes/documentos.php">Documentos de los pacientes</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Nuevo documento</a></li>
            </ul>
           <br>

           <?php 
require '../../backend/bd/Conexion.php';
 $id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM patients  WHERE idpa= '$id';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
   ?>
   <?php if(count($data)>0):?>
        <?php foreach($data as $d):?>
<div class="input-block">

                    <div class="wrap-line">

                                <!-- Inputs -->
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->numhs; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->nompa; ?>" name="text" required>
           
            <span class="line"></span>
        </div>

                <!-- Inputs -->
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->apepa; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
        <div class="brise-input">
           
            <input type="text" value="<?php echo $d->direc; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

        <div class="brise-input">
          
            <input type="text" value="<?php echo $d->cump; ?>" name="text" required>
            
            <span class="line"></span>
        </div>


        <div class="brise-input">
          
            <input type="text" value="<?php echo $d->sex; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

                <div class="brise-input">
            
            <input type="text" value="<?php echo $d->grup; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

        <div class="brise-input">
           
            <input type="text" value="<?php echo $d->phon; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
                        
                    </div>

</div>


<div class="data">
    <div class="content-data">
        <div class="head">
            <h3>Nuevo documento</h3>
                  <div class="botonsa-modals">
        <label for="btnsa-modals">
            Nuevo
        </label>
    </div>         
        </div>
<div class="flexbox">
        <ul class="flex-card-list">
             <?php 
$id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM document  WHERE idpa= '$id';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}

 ?>
 <?php  if(count($data)>0):?>

        <?php foreach($data as $e):?> 
          <li class="flex-card-listitem">
            <div class="flex-card">
              <div class="flex-card-image">
                <img src="../../backend/img/subidas/<?php echo $e->foto; ?>" />
              </div>
              <div class="flex-card-content">
                <a href="../../backend/img/subidas/<?php echo $e->foto; ?>" class="flex-card-button" download>Download</a>
              </div>
            </div>
          </li>
          <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No existe ningun documento</p>
    <?php endif; ?>

        </ul>
      </div>

    </div>
</div>



        <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>


        </main>
        <!-- MAIN -->
    </section>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- NAVBAR -->
    
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include_once '../../backend/modal/md_docu.php' ?>
<?php include_once '../../backend/php/add_docu.php' ?>




</body>
</html>


