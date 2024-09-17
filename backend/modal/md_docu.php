

<!--Ventana Modal-->
<form enctype="multipart/form-data" method="POST" action="" autocomplete="off">
    <input type="checkbox" id="btnsa-modals">
    <div class="container-modal">
        <div class="content-modal">
            <div class="statusMsg"></div>
            <h2>Nuevo documento</h2>

            <div id="err"></div>

            <hr>
            <label for="email"><b>Documento</b></label><span class="badge-warning">*</span>

             
             <textarea  name="docdoc" id="docdoc" placeholder="Write something.." style="height:200px"></textarea>
          

            <input id="uploadImage" type="file" name="foto"  accept="image/*"/>
           
          
            <input type="hidden" id="docidpa" name="docidpa" value="<?php echo $d->idpa; ?>">
            <input type="hidden" id="docnopa" name="docnopa" value="<?php echo $d->nompa; ?>">
           
            <input class="registerbtn"  name="add_docu" type="submit"  value="Guardar">

        </div>
        <label for="btnsa-modals" class="cerrar-modal"></label>
    </div>
    </form>
<!--Fin de Ventana Modal-->