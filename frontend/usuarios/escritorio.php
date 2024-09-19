<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
    header('location: ../salir.php');
    exit;
}
    $id=$_SESSION['id'];
  
?>
<?php 
    require_once('../../backend/bd/Conexion.php');
$req = $connect->prepare("SELECT id, title, start, end, color FROM events");
$req->execute();
$events = $req->fetchAll();
     ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/QDL.ico">

    <!-- Data Tables -->
        <link rel="stylesheet" href="../../backend/vendor/datatables/dataTables.bs4.css" />
        <link rel="stylesheet" href="../../backend/vendor/datatables/dataTables.bs4-custom.css" />
        <link href="../../backend/vendor/datatables/buttons.bs.css" rel="stylesheet" />

        <!-- FullCalendar -->
    <link href='../../backend/css/fullcalendar.css' rel='stylesheet' />
        <style type="text/css">
            #calendar {
        max-width: 800px;
    }
    .col-centered{
        float: none;
        margin: 0 auto;
    }
        </style>

    <title>ENFERMERÍA QDL | Panel administrativo</title>
</head>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="escritorio.php" class="brand"><i class='bx bxs-heart icon'></i> ENFERMERÍA QDL</a>
        <ul class="side-menu">
            <li><a href="escritorio.php" class="active"><i class='bx bxs-dashboard icon' ></i> Resumen</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bx bxs-book-alt icon' ></i> Consulta <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../citas/mostrar.php">Todas las Consultas</a></li>
                    <li><a href="../citas/nuevo.php">Nueva</a></li>
                    
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-user icon' ></i> Empleados <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../pacientes/mostrar.php">Lista de Empleados</a></li>
                    <li><a href="../pacientes/historial.php">Historial de los Empleados</a></li>
                    <li><a href="../pacientes/documentos.php">Documentos</a></li>
                   
                </ul>
            </li>

            


            

            

            <li>
                <a href="#"><i class='bx bxs-spray-can icon' ></i> Medicamentos<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    
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
                <img src="D:/QDLTraba/Documentos/Programs/XAMPP/htdocs/enfermeria/backend/img/neu.png" alt="">
                <ul class="profile-link">
                    
                    
                    <li>
                     <a href="../salir.php"><i class='bx bxs-log-out-circle' ></i> Cerrar sesión</a>
                    </li>
                   
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <h1 class="title">Bienvenido(a) <?php echo '<strong>'.$_SESSION['name'].'</strong>'; ?></h1>
            <ul class="breadcrumbs">
                <li><a href="escritorio.php">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Dashboard</a></li>
            </ul>
            <div class="info-data">
                <div class="card">
                    <div class="head">
                        <div>
                            
                                    <?php 
                                            $sql = "SELECT COUNT(*) total FROM patients";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <p>Pacientes</p>
                        </div>
                        <i class='bx bx-user icon' ></i>
                    </div>
                    
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                           
                                    <?php 
                                            $sql = "SELECT COUNT(*) total FROM doctor";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <p>Enfermeros</p>
                        </div>
                        <i class='bx bx-briefcase icon' ></i>
                    </div>
                 
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <?php 
                                            $sql = "SELECT COUNT(*) total FROM product";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <p>Medicamentos y Material</p>
                        </div>
                        <i class='bx bx-user-circle icon' ></i>
                    </div>
                   
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <?php 
                                            $sql = "SELECT nompro, stock FROM product ORDER BY stock ASC LIMIT 1";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            // Usamos fetch() para obtener ambos valores
                                            $row = $result->fetch(PDO::FETCH_ASSOC);

                                            if ($row) {
                                                // Asignar los valores a variables separadas
                                                $nombreProducto = $row['nompro'];
                                                $stockProducto = $row['stock'];
                                            } else {
                                                // Si no hay resultados, asignar valores por defecto
                                                $nombreProducto = "No disponible";
                                                $stockProducto = "N/A";
                                            }
                                        
                                             ?>
                            <h2><?php echo htmlspecialchars($stockProducto); ?></h2>
                            <p><?php echo htmlspecialchars($nombreProducto); ?></p>
                        </div>
                        <i class='bx bx-book-alt icon' ></i>
                    </div>
                   
                </div>
            </div>
            <div class="data">
                <div class="content-data">
<div class="table-responsive" style="overflow-x:auto;">
    <?php 
        // Modificar la consulta para obtener las columnas nompa, apepa y numhs de la tabla patients
        $sentencia = $connect->prepare("
            SELECT events.*, patients.nompa, patients.apepa, patients.numhs 
            FROM events 
            JOIN patients ON events.idpa = patients.idpa
            ORDER BY events.id DESC 
            LIMIT 10;
        ");
        $sentencia->execute();
        $data = array();
        if($sentencia){
            while($r = $sentencia->fetchObject()){
                $data[] = $r;
            }
        }
    ?>
    
    <?php if(count($data) > 0): ?>
        <table id="example" class="responsive-table">
            <thead>
                <tr>
                    <th scope="col">Motivo de consulta</th>
                    <th scope="col">Nombre del Paciente</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Número de control</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $d): ?>
                    <tr>
                        <!-- Mostrar el título y el idodc del evento -->
                        <td data-title="Consulta"><?php echo $d->title ?>&nbsp;<?php echo $d->idodc ?></td>
                        
                        <!-- Mostrar el nombre del paciente -->
                        <td data-title="Nombre"><?php echo $d->nompa ?></td>
                        
                        <!-- Mostrar el apellido paterno del paciente -->
                        <td data-title="Apellido"><?php echo $d->apepa ?></td>
                        
                        <!-- Mostrar el número de historia clínica del paciente -->
                        <td data-title="Historia Clínica"><?php echo $d->numhs ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
  
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Danger!</strong> No hay datos.
    </div>
    <?php endif; ?>

                       
                   </div>
                    
                </div>
               
                <div class="content-data">
               
                   <div class="table-responsive" style="overflow-x:auto;">
 <?php 

$sentencia = $connect->prepare("SELECT * FROM patients ORDER BY idpa DESC LIMIT 10;");
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
                    <th scope="col">Nuevos pacientes</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $d):?>
                    <tr>
                    
                        <td data-title="Paciente"><?php echo $d->nompa ?>&nbsp;<?php echo $d->apepa ?></td>
                      
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
    <!-- NAVBAR -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../backend/js/script.js"></script>

    <!-- Data Tables -->
        <script src="../../backend/vendor/datatables/dataTables.min.js"></script>
        <script src="../../backend/vendor/datatables/dataTables.bootstrap.min.js"></script>


        <!-- Custom Data tables -->
        <script src="../../backend/vendor/datatables/custom/custom-datatables.js"></script>
        <script src="../../backend/vendor/datatables/custom/fixedHeader.js"></script>


        <!-- FullCalendar -->
    <script src='../../backend/js/moment.min.js'></script>
    <script src='../../backend/js/fullcalendar/fullcalendar.min.js'></script>
    <script src='../../backend/js/fullcalendar/fullcalendar.js'></script>
    <script src='../../backend/js/fullcalendar/locale/es.js'></script>

<script>

  $(document).ready(function() {

    var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
      header: {
         language: 'es',
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay',

      },
      defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        element.bind('dblclick', function() {
          $('#ModalEdit #id').val(event.id);
          $('#ModalEdit #title').val(event.title);
          $('#ModalEdit #color').val(event.color);
          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

        edit(event);

      },
      events: [
      <?php foreach($events as $event): 
      
        $start = explode(" ", $event['start']);
        $end = explode(" ", $event['end']);
        if($start[1] == '00:00:00'){
          $start = $start[0];
        }else{
          $start = $event['start'];
        }
        if($end[1] == '00:00:00'){
          $end = $end[0];
        }else{
          $end = $event['end'];
        }
      ?>
        ,{
          id: '<?php echo $event['id']; ?>',
          title: '<?php echo $event['title']; ?>',
          start: '<?php echo $start; ?>',
          end: '<?php echo $end; ?>',
          color: '<?php echo $event['color']; ?>',
        },
      <?php endforeach; ?>
      ]
    });
    
 
    
  });

</script>
</body>
</html>


