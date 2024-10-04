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
    <link rel="stylesheet"  href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/ico.svg">

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="../../backend/css/datatable.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/buttonsdataTables.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/font.css">




    <title>Enfermería QDL | Lista de Usuarios</title>
</head>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="../admin/escritorio.php" class="brand">Enfermería QDL</a>
        <ul class="side-menu">
            <li><a href="../admin/escritorio.php" ><i class='bx bxs-dashboard icon' ></i> Resumen</a></li>
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
            <a href="#"><i class='bx bxs-diamond icon' ></i> Usuarios<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../actividades/mostrar.php">Lista de Usuarios</a></li>
                    <li><a href="../actividades/nuevo.php">Nuevo usuario</a></li>
                   
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
                <li><a href="#" class="active">Lista de Usuarios</a></li>
            </ul>
            <button class="button" onclick="location.href='nuevo.php'">Nuevo</button>
          <div class="data">
                <div class="content-data">
                    <div class="head">
                        <h3>Usuarios</h3>
                       
                    </div>
                   <div class="table-responsive" style="overflow-x:auto;">
                       <?php 
require '../../backend/bd/Conexion.php';
$sentencia = $connect->prepare("SELECT * FROM users ORDER BY id DESC;");
 $sentencia->execute();
$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
     ?>
     <?php if(count($data)>0):?>
         <table id="example" class="responsive-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">USUARIO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CORREO</th>
                    <th scope="col">CONTRASEÑA</th>
                    <th scope="col">ROL</th>
                    
                    <th scope="col">FECHA DE MODIFICACIÓN</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $d):?>
                    <tr>
                        <th scope="row"><?php echo $d->id ?></th>
                        <td data-title="Usuario"><?php echo $d->username ?></td>
                        
                        <td data-title="Nombre"><?php echo $d->name ?></td>
                        <td data-title="Correo"><?php echo $d->email ?></td>
                        <td data-title="Contraseña"><?php echo $d->password ?></td>
                        
                        <td data-title="Rol"><?php 
                        if($d->rol == 1)
                        {
                         echo 'Administrador';
                        }
                        else if($d->rol == 2)
                        {
                         echo 'Supervisor';
                        }
                        else if($d->rol == 3)
                        {
                         echo 'Usuario';
                        }
                        ;  
                        ?></td>
                        

                        <td data-title="Fecha de creación"><?php  echo $d->created_at ?></td>
                        <td>
                            <a title="Actualizar" href="../actividades/editar.php?id=<?php echo $d->id ?>" class="fa fa-pencil tooltip"></a>
                            <a title="Información" href="../actividades/info.php?id=<?php echo $d->id ?>" class="fa fa-info"></a>
                            
                            
                            
                            <form  onsubmit="return confirm('Realmente desea eliminar el registro?');" method='POST' action='<?php $_SERVER['PHP_SELF'] ?>'>
<input type='hidden' name='id' value="<?php echo  $d->id; ?>">

<button name='delete_patients' style="cursor: pointer;" class="fa fa-trash"></button>
</form>

                            <?php 
                                if ($d->rol == '1') {
                                    // code...
               // echo '<a title="Cambiar contraseña"  href="../pacientes/password.php?id='.$d->id.'" class="fa fa-key"></a>';
                                }else {
                                    //echo '<a title="Crear perfil" href="../pacientes/crear.php?id='.$d->id.'" class="fa fa-user-plus"></a>';
                                }

                             ?>
        
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
         </table> 
         <?php else:?>
  
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Danger!</strong> No hay datos.
    </div>
    <?php endif; ?>
                    </div>
                </div>
            </div>  

        </main>
        <!-- MAIN -->
    </section>
    <?php include_once '../../backend/php/delete_users.php' ?>
    <!-- NAVBAR -->
    <script src="../../backend/js/jquery.min.js"></script>
    
    <script src="../../backend/js/script.js"></script>
    
    <!-- Data Tables -->
    <script type="text/javascript" src="../../backend/js/datatable.js"></script>
    <script type="text/javascript" src="../../backend/js/datatablebuttons.js"></script>
    <script type="text/javascript" src="../../backend/js/jszip.js"></script>
    <script type="text/javascript" src="../../backend/js/pdfmake.js"></script>
    <script type="text/javascript" src="../../backend/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="../../backend/js/buttonshtml5.js"></script>
    <script type="text/javascript" src="../../backend/js/buttonsprint.js"></script>
    <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    } );
} );
    </script>



</body>
</html>


