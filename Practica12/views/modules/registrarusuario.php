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
            		    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                    <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
                    <input type="text" class="form-control" name="contra" placeholder="Contraseña" required>
                    <button type="submit" class="btn btn-block btn-outline-success" name="agregar">Registrar</button>
            	</form>
            </div>
        </div>
    </div>
</div>
<?php
  //Creacion del objeto y llamado de sus objetos
  $registrarUsu = new MvcController();
  $registrarUsu->registrarUsuarioController();

?>