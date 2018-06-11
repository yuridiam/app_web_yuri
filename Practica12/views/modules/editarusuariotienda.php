<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Modificar Usuario</h3>
              <div class="card-tools">
                  <div class="btn-group">
                     <?php echo "<a href='index.php?action=usuariostienda&id_tienda=".$_GET["id_tienda"]."'><button type='button' class='btn btn-tool'><i class='fa fa-times'></i></button></a>";?>
                  </div>
            </div>
            </div>
            <div class="card-body">
            	<form method="post" id="modificar" name="modificar">
                <?php
                      //Creacion del objeto y llamado a sus metodos
            		      $editarUsu = new MvcController();
                      $editarUsu->editarUsuarioTiendaController();
                ?>
            	</form>
            </div>
        </div>
    </div>
</div>

<?php
  //Creacion del objeto y llamado a sus metodos
  $modificarUsu = new MvcController();
  $modificarUsu->modificarUsuarioTiendaController();

?>