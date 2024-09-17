<!--Ventana Modal-->
<form method="POST" >
    <input type="checkbox" id="btns-modals">
    <div class="container-modal">
        <div class="content-modal">
            <h2>Nueva tratamiento</h2>
            <hr>
            <label for="email"><b>Tratamiento</b></label><span class="badge-warning">*</span>

            <textarea  name="trat" id="trat" required placeholder="Write something.." style="height:200px"></textarea>

          
            <input type="hidden" id="tratdpa" name="csidpa" value="<?php echo $d->idpa; ?>">
            <input type="hidden" id="tratnopa" name="csnopa" value="<?php echo $d->nompa; ?>">
           
            

            <input type="button" class="registerbtn" name="submit" value="Guardar" onclick="trata();"> 
        </div>
        <label for="btns-modals" class="cerrar-modal"></label>
    </div>
    </form>
<!--Fin de Ventana Modal-->