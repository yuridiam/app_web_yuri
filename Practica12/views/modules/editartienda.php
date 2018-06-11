<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Modificar Tienda</h3>
              <div class="card-tools">
                  <div class="btn-group">
                    <a href="index.php?action=tiendas"><button type="button" class="btn btn-tool">
                    <i class="fa fa-times"></i></button></a>
                  </div>
            </div>
            </div>
            <div class="card-body">
            	<form method="post" id="modificar" name="modificar">
                <?php
                      //Creacion del objeto y llamado a sus metodos
            		      $editarTi = new MvcController();
                      $editarTi->editarTiendaController();
                ?>
            	</form>
            </div>
        </div>
    </div>
</div>

<?php
  //Creacion del objeto y llamado a sus metodos
  $modificarTi = new MvcController();
  $modificarTi->modificarTiendaController();

?>