<div id="myModal<?php echo $d->idpa ?>" class="modal">
 
 
  <form class="modal-content" action="/action_page.php">
    <div class="containez">
      <span class="close">&times;</span>
      <h1>Eliminar el registro</h1>
      <p>Realmente desea eliminar el registro?</p>

      <input type="hidden" name="pid" value="<?php echo $d->idpa ?>">
      <div class="clearfix">
        
        <button type="button" onclick="document.getElementById('myModal').style.display='none'" class="deletebtn">Aceptar</button>
      </div>
    </div>
  </form>
</div>

