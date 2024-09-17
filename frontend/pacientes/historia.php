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
    



    <title>Enfermería QDL | Historia clínica del paciente</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">

        <a href="../admin/escritorio.php" class="brand"><i class='bx bxs-heart icon'></i> Enfermería QDL</a>
        <ul class="side-menu">
            <li><a href="../admin/escritorio.php" ><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bx bxs-book-alt icon' ></i> Citas <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../citas/mostrar.php">Todas las citas</a></li>
                    <li><a href="../citas/nuevo.php">Nueva</a></li>
                    <li><a href="../citas/calendario.php">Calendario</a></li>
                   
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
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
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
            <h1 class="title">Bienvenido <?php echo '<strong>'.$_SESSION['username'].'</strong>'; ?></h1>
            <ul class="breadcrumbs">
                <li><a href="../admin/escritorio.php">Home</a></li>
                <li class="divider">></li>
                <li><a href="../pacientes/mostrar.php">Listado de los pacientes</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Historia clínica del paciente</a></li>
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
    
    <a type="button" href="../pacientes/imprimir?id=<?php echo $d->idpa; ?>" class="button">IMPRIMIR</a>

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
       <button class="accordion">Genograma</button>
<div class="panel">
    <div class="boton-modal">
        <label for="btn-modal">
            Nuevo
        </label>
    </div>


<div class="timeline">
    <?php 
$id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM genogram  WHERE idpa= '$id';");
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
    <div class="entry" style="margin-top: 20px;" id="tbody">
      <div class="core">
      <h3><?php echo $e->fere; ?></h3>
        <?php echo $e->detage; ?>
      </div>
    </div>

<?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>
   
</div>


</div>

<button class="accordion">Consulta</button>
<div class="panel">
    <div class="botons-modal">
        <label for="btns-modal">
            Nuevo
        </label>
    </div>

    <div class="table-responsive" style="overflow-x:auto;">
        <?php 
        $id = $_GET['id'];
$sentencia = $connect->prepare("SELECT * FROM consult  WHERE idpa= '$id';");
 $sentencia->execute();
$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
         ?>
         <?php if(count($data)>0):?>
        <table class="responsive-table">
            <thead>
                <tr>
                    <th scope="col">Paciente</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Fecha</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php foreach($data as $f):?>
                <tr>
                     <th scope="row"><?php echo $f->nompa; ?></th>
                     <td data-title="Motivo"><?php echo $f->mtcl; ?></td>
                     <td data-title="Fecha"><?php echo $f->fere; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>
    </div>
  
</div>

<button class="accordion">Tratamiento</button>
<div class="panel">

    <div class="botons-modals">
        <label for="btns-modals">
            Nuevo
        </label>
    </div>

    <div class="table-responsive" style="overflow-x:auto;">
<?php 
        $id = $_GET['id'];
$sentencia = $connect->prepare("SELECT * FROM treatment  WHERE idpa= '$id';");
 $sentencia->execute();
$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
         ?>
         <?php if(count($data)>0):?>
        <table class="responsive-table">
            <thead>
                <tr>
                    <th scope="col">Paciente</th>
                    <th scope="col">Tratamiento</th>
                    <th scope="col">Fecha</th>
                    
                </tr>
            </thead>

            <tbody>
                 <?php foreach($data as $a):?>
                 <tr>
                     <th scope="row"><?php echo $a->nompa; ?></th>
                     <td data-title="Motivo"><?php echo $a->nomtra; ?></td>
                     <td data-title="Fecha"><?php echo $a->fere; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>
    </div>

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

    <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include_once '../../backend/modal/md_geog.php' ?>
<?php include_once '../../backend/modal/md_consul.php' ?>
<?php include_once '../../backend/modal/md_trat.php' ?>



<script type="text/javascript">
    $(document).ready(function(){
$("#submit").click(function(){
var gedet = $("#gedet").val();
var geidpa = $("#geidpa").val();
var genopa = $("#genopa").val();

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'det1='+ gedet + '&pa1='+ geidpa + '&nomp1='+ genopa;
if(gedet==''||geidpa==''||genopa=='')
{
alert("Please Fill All Fields");
}
else
{
// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "add_ge.php",
data: dataString,
cache: false,
success: function(result){

alert(result);
$('#tbody').html(result);
}
});
}
return false;
});
});


  
</script>

<script type="text/javascript">
    function enviar(){
var consl = document.getElementById('consl').value;
var csidpa = document.getElementById('csidpa').value;
var csnopa = document.getElementById('csnopa').value;



var dataen = 'consl='+consl +'&csidpa='+csidpa +'&csnopa='+csnopa;
//obtenemos el valor de todos los input que te interesan
              $.ajax({
                    type: "POST", //definimos el método de envío
                    url: "add_consut.php", //el archivo al cual se enviaran
                    data:dataen,
                    cache: false,
                    success: function(result){

                    swal(
                            'Agregado correctamente',
                            'Buen trabajo',
                            'success'
                          )
}
                });
};
</script>

<script type="text/javascript">
    function trata(){
       var trat = document.getElementById('trat').value; 
       var tratdpa = document.getElementById('tratdpa').value; 
       var tratnopa = document.getElementById('tratnopa').value;

       var dataens = 'trat='+trat +'&tratdpa='+tratdpa +'&tratnopa='+tratnopa;

       $.ajax({
                    type: "POST", //definimos el método de envío
                    url: "add_trat.php", //el archivo al cual se enviaran
                    data:dataens,
                    cache: false,
                    success: function(result){

                    swal(
                            'Agregado correctamente',
                            'Buen trabajo',
                            'success'
                          )
}
                }); 
    };
</script>



</body>
</html>


