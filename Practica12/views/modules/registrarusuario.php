<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Nuevo Usuario</h3>
              <div class="card-tools">
                  <div class="btn-group">
                    <a href="index.php?action=usuarios"><button type="button" class="btn btn-tool">
                    <i class="fa fa-times"></i></button></a>
                  </div>
            </div>
            </div>
            <div class="card-body">
            	<form method="post">
            		    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                    <input type="text" class="form-control" name="contra" id="contra" placeholder="Contraseña">
                    <select class="form-control select2" style="width: 100%" name="tienda">
                      <?php
                          //Creacion del objeto y llamado de sus objetos
                          $traerTienda = new MvcController();
                          $traerTienda->traerTiendasController();

                      ?>
                    </select><br><br>
                    <button type="submit" class="btn btn-block btn-outline-success" id="agregar" onclick="aUsuario();" name="agregar">Registrar</button>
            	</form>
            </div>
        </div>
    </div>
</div>
<?php
  //Creacion del objeto y llamado de sus objetos
  $registrarUsu = new MvcController();
  $registrarUsu->registrarUsuarioGlobalController();

?>