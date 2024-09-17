<!--Ventana Modal-->
<form id="form" >
    <input type="checkbox" id="btn-modal">
    <div class="container-modal">
        <div class="content-modal">
            <h2>Genograma</h2>
            <hr>
            <label for="email"><b>Descripción</b></label><span class="badge-warning">*</span>
            <textarea  name="gedet" id="gedet" required placeholder="Write something.." style="height:200px"></textarea>
            <input type="hidden" id="geidpa" name="geidpa" value="<?php echo $d->idpa; ?>">
            <input type="hidden" id="genopa" name="genopa" value="<?php echo $d->nompa; ?>">
           
            <button type="submit" name="submit" id="submit" class="registerbtn">Guardar</button>
        </div>
        <label for="btn-modal" class="cerrar-modal"></label>
    </div>
    </form>
<!--Fin de Ventana Modal-->