<?php
    ob_start();
    session_start();
    


    
    if(!isset($_SESSION['rol']) || ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2)){
        header('Location: ../usuarios/error.php?error=No tienes permisos para acceder a esta página');
    }

    $id = $_SESSION['id'];
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

    <title>Enfermería QDL | Nueva Consulta</title>

    <style>
        .autocomplete-results {
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            position: absolute;
            z-index: 1000;
            background-color: #fff;
            width: calc(100% - 2px);
            box-sizing: border-box;
        }

        .autocomplete-item {
            padding: 8px;
            cursor: pointer;
        }

        .autocomplete-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="../admin/escritorio.php" class="brand">Enfermería QDL</a>
        <ul class="side-menu">
            <li><a href="../admin/escritorio.php" class="active"><i class='bx bxs-dashboard icon' ></i> Resumen</a></li>
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
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
            <span class="divider"></span>
            <div class="profile">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAUqRSSeB-qxBHux7Hn4hsf94d1-nBkT6XmQ&s/neu.png" alt="">
                <ul class="profile-link">
                    <li><a href="../profile/mostrar.php"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
                    <li><a href="../salir.php"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
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
                <li><a href="../citas/mostrar.php">Listado de las Consultas</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Nueva Consulta</a></li>
            </ul>

            <!-- multistep form -->
            <form action="../../backend/php/add_appointment.php" enctype="multipart/form-data" method="POST" autocomplete="off">
                <div class="containerss">
                    <h1>Nueva Consulta</h1>
                    <div class="alert-danger">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                        <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span><br>
                    </div>
                    <hr>
                    <br>
                    <label for="email"><b>Fecha inicial</b></label><span class="badge-warning">*</span>
                    <input type="datetime-local" name="appini" required="">

                    <label for="psw"><b>Número de control del paciente</b></label><span class="badge-warning">*</span>
                    <input type="text" id="searchBox" name="apppac" placeholder="Buscar por número de control" autocomplete="off">
                    <div id="results" class="autocomplete-results"></div>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const searchBox = document.getElementById('searchBox');
                        const resultsDiv = document.getElementById('results');

                        searchBox.addEventListener('input', function() {
                            const searchTerm = searchBox.value;

                            if (searchTerm.length >= 2) { // Empieza la búsqueda después de al menos 2 caracteres
                                fetch(`search.php?term=${encodeURIComponent(searchTerm)}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        resultsDiv.innerHTML = '';

                                        data.forEach(item => {
                                            const resultItem = document.createElement('div');
                                            resultItem.classList.add('autocomplete-item');
                                            resultItem.textContent = `${item.nompa} ${item.apepa} (Número de control: ${item.numhs})`;
                                            resultItem.dataset.numhs = item.numhs;

                                            resultItem.addEventListener('click', function() {
                                                searchBox.value = item.numhs;
                                                resultsDiv.innerHTML = '';
                                            });

                                            resultsDiv.appendChild(resultItem);
                                        });
                                    });
                            } else {
                                resultsDiv.innerHTML = '';
                            }
                        });
                    });
                    </script>

                    <label for="email"><b>Motivo de la Consulta</b></label><span class="badge-warning">*</span>
                    <textarea name="appnam" style="height:200px" placeholder="Motivo de la Consulta..."></textarea>

                    

                    <label for="psw"><b>Nombre del enfermero(a)</b></label><span class="badge-warning">*</span>
                    <input type="text" name="nombredoc" id="doc" value="<?php echo $_SESSION['name']; ?>" readonly>

                    <!-- Campo oculto para enviar el idodc -->
                    <input type="hidden" name="appdoc" value="<?php echo $_SESSION['idodc']; ?>">



                    <!--<label for="email"><b>Especialidad del enfermero</b></label><span class="badge-warning">*</span>
                    <select disabled id="spe">
                        <option>Seleccione</option>
                    </select>-->

                    <label for="psw"><b>Servicio de atención</b></label><span class="badge-warning">*</span>
                    <select required name="applab" id="lab">
                        <option>Seleccione</option>
                    </select>

                    <!--<label for="psw"><b>Color</b></label><span class="badge-warning">*</span>
                    <select required name="appco" id="gep">
                        <option style="color:#CD5C5C;" value="#CD5C5C">&#9724; Indio Rojo</option>
                        <option style="color:#F08080;" value="#F08080">&#9724; Coral claro</option>
                        <option style="color:#8B0000;" value="#8B0000">&#9724; Rojo oscuro</option>
                        <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                        <option style="color:#FFC0CB;" value="#FFC0CB">&#9724; Rosado</option>
                        <option style="color:#FFB6C1;" value="#FFB6C1">&#9724; Rosa claro</option>
                        <option style="color:#FF7F50;" value="#FF7F50">&#9724; Coral</option>
                        <option style="color:#FF4500;" value="#FF4500">&#9724; Rojo naranja</option>
                        <option style="color:#FFFF00;" value="#FFFF00">&#9724; Amarillo</option>
                        <option style="color:#EE82EE;" value="#EE82EE">&#9724; Violeta</option>
                    </select>-->

                    <label for="email"><b>Fecha final</b></label><span class="badge-warning">*</span>
                    <input type="datetime-local" name="appfin" required="">

                    <div id="medicamentosContainer">
                        <div class="medicamentoItem">
                            <label for="psw"><b>Medicamento</b></label><span class="badge-warning">*</span>
                            <!--<label for = "searchbox">Buscar medicamento:</label>-->
                            <input type="text" id="searchBox1" name="appmont" class="medicamentoInput" placeholder="Buscar por clave del Medicamento" autocomplete="off">
                            <!--<div id="results1" class="autocomplete-results"></div>-->
                            <div class="resultsDiv"></div>
                            <label for="psw"><b>Cantidad</b></label><span class="badge-warning">*</span>
                            <input type="number" id="cantidad" name="cantidad" min="1" value="1">
                            <div class="stockDisponible">Stock disponible: 0</div>
                        </div>
                    </div>

                    <script>
                            document.addEventListener('DOMContentLoaded', function() {
                            const searchBoxes = document.querySelectorAll('.medicamentoInput');

                            searchBoxes.forEach((searchBox) => {
                                const resultsDiv = searchBox.nextElementSibling; // Selects the next div after the searchBox
                                searchBox.addEventListener('input', function() {
                                    const searchTerm = this.value;

                                    if (searchTerm.length >= 2) {
                                        fetch(`search1.php?term=${encodeURIComponent(searchTerm)}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                resultsDiv.innerHTML = '';

                                                data.forEach(item => {
                                                    const resultItem = document.createElement('div');
                                                    resultItem.classList.add('autocomplete-item');
                                                    resultItem.textContent = item.nompro;
                                                    resultItem.dataset.codpro = item.codpro;

                                                    resultItem.addEventListener('click', function() {
                                                        searchBox.value = item.nompro;
                                                        resultsDiv.innerHTML = '';
                                                        obtenerStock(item.codpro, searchBox); // Llama a obtenerStock al seleccionar un medicamento
                                                    });

                                                    resultsDiv.appendChild(resultItem);
                                                });
                                            });
                                    } else {
                                        resultsDiv.innerHTML = '';
                                    }
                                });
                            });

                            // Función para obtener el stock disponible
                            function obtenerStock(codpro, searchBox) {
                                console.log('obtenerStock llamada con codpro: ', codpro);
                                fetch(`obtener_stock.php?codpro=${codpro}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log('Stock disponible: ', data.stock);
                                        //const medicamentoItem = searchBox.closest('.medicamentoItem'); //Encuentra el contenedor del medicamento
                                        const medicamentoItem = searchBox.parentNode; //Encuentra el contenedor del medicamento
                                        const stockDiv = medicamentoItem.querySelector('.stockDisponible');
                                        console.log('stockDiv:', stockDiv);
                                        if (stockDiv) {
                                            stockDiv.textContent = `Stock disponible: ${data.stock}`;
                                        } else {
                                            console.error('Elemento stockDisponible no encontrado.');
                                        }
                                })
                                .catch(error => console.error('Error al obtener stock:', error));
                            }


                            // Agregar medicamento
                            document.getElementById('addMedicamentoBtn').addEventListener('click', function() {
                                event.preventDefault(); //Evita el envío del formulario

                                const newItem = document.createElement('div');
                                newItem.className = 'medicamentoItem';
                                newItem.innerHTML = `
                                    <label for="searchBox">Buscar medicamento:</label>
                                    <input class="medicamentoInput" type="text" placeholder="Buscar...">
                                    <div class="resultsDiv"></div>
                                    <label for="cantidad">Cantidad:</label>
                                    <input type="number" min="1" value="1">
                                    <div class="stockDisponible">Stock disponible: 0</div>
                                `;
                                document.getElementById('medicamentosContainer').appendChild(newItem);

                                // Asignar eventos al nuevo campo de búsqueda
                                const newSearchBox = newItem.querySelector('.medicamentoInput');
                                const newResultsDiv = newItem.querySelector('.resultsDiv');
                                newSearchBox.addEventListener('input', function() {
                                    const searchTerm = this.value;

                                    if (searchTerm.length >= 2) {
                                        fetch(`search1.php?term=${encodeURIComponent(searchTerm)}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                newResultsDiv.innerHTML = '';

                                                data.forEach(item => {
                                                    const resultItem = document.createElement('div');
                                                    resultItem.classList.add('autocomplete-item');
                                                    resultItem.textContent = item.nompro;
                                                    resultItem.dataset.codpro = item.codpro;

                                                    resultItem.addEventListener('click', function() {
                                                        newSearchBox.value = item.nompro;
                                                        newResultsDiv.innerHTML = '';
                                                        obtenerStock(item.codpro);
                                                    });

                                                    newResultsDiv.appendChild(resultItem);
                                                });
                                            });
                                    } else {
                                        newResultsDiv.innerHTML = '';
                                    }
                                });
                            });

                            function actualizarStockDisponible(codpro, cantidad) {
                                // Realiza una llamada a un archivo PHP o una API para actualizar el stock
                                return fetch(`actualizar_stock.php?codpro=${codpro}&cantidad=${cantidad}`, {
                                    method: 'POST'
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Stock actualizado:', data);
                                })
                                .catch(error => console.error('Error al actualizar el stock:', error));
                            }

                            // Guardar medicamentos y actualizar stock
                            document.querySelector('.registerbtn').addEventListener('click', function(event) {
                                event.preventDefault(); // Evita que el formulario se envíe inmediatamente
                                const items = document.querySelectorAll('.medicamentoItem');
                                const promises = [];

                                items.forEach(item => {
                                    const searchBox = item.querySelector('input[type="text"]');
                                    const cantidad = item.querySelector('input[type="number"]').value;

                                    // Añadir cada promesa de actualización de stock al array
                                    promises.push(actualizarStockDisponible(searchBox.value, cantidad));
                                });

                                // Esperar a que todas las actualizaciones del stock se completen antes de enviar el formulario
                                Promise.all(promises)
                                    .then(() => {
                                        console.log('Todos los stocks se han actualizado');
                                        document.querySelector('form').submit(); // Esto envía el formulario
                                    })
                                    .catch(error => console.error('Error en la actualización del stock:', error));
                            });
                        });
                    
                    </script>

                    <button id="addMedicamentoBtn">Agregar otro medicamento</button>
                    <hr>
                    <button type="submit" name="add_appointment" class="registerbtn">Guardar</button>
                </div>
            </form>
        </main>
        <!-- MAIN -->
    </section>
    <script src="../../backend/js/jquery.min.js"></script>
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
