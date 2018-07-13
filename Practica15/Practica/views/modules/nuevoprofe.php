<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <a href="index.php?action=profesores" class="badge badge-primary">Regresar</a>
      <br>
			<h1><a style="font-weight: bold; font-size: 1.3em">REGISTRAR PROFESOR</a></h1>
			<hr>
      <?php
        if(isset($_SESSION["registrado"])){
          if($_SESSION["registrado"]==1){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Profesor Registrado Exitósamente
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
              $_SESSION["registrado"]=0;
          }
        }
        $_SESSION["registrado"]=0;

      ?>
			<br>
        <form id="formu" method="post" name="formu" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="noempleado">Número de Empleado</label>
              <input type="text" class="form-control" id="noempleado" name="noempleado" placeholder="Número de empleado" required>
            </div>
            <div class="form-group col-md-9">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="fechaN">Fecha de Nacimiento</label>
              <input type="date" class="form-control" id="fechaN" name="fechaN" placeholder="Fecha de Nacimiento" required>
            </div>
            <div class="form-group col-md-3">
              <label for="tel">Teléfono</label>
              <input type="text" class="form-control" id="tel" name="tel" placeholder="Teléfono de Celular" required>
            </div>
            <div class="form-group col-md-6">
              <label for="tel">Dirección</label>
              <input type="text" class="form-control" id="dir" name="dir" placeholder="Dirección" required>
            </div>
          </div>
          <div class="row">
             <div class="form-group col-md-4">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
             </div>
             <div class="form-group col-md-4">
              <label for="contra">Contraseña</label>
              <input type="text" class="form-control" id="contra" name="contra" placeholder="Contraseña" required>
             </div>
            <div class="form-group col-md-4">
              <label for="img">Foto</label>
              <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload">
            </div>
          </div>
          <button type="submit" id="registrar" name="registrar" style="width: 100%" class="btn btn-primary">Registrar</button>
        </form>
			<br><br><br><br><br><br><br>
		</div>
	</div>
</div>

<?php

    $regProfesor = new MvcController();
    $regProfesor->registrarProfesorController();

?>