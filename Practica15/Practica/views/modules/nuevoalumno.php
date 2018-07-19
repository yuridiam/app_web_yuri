<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <a href="index.php?action=alumnos" class="badge badge-primary">Regresar</a>
      <br>
			<h1><a style="font-weight: bold; font-size: 1.3em">REGISTRAR ALUMNO</a></h1>
			<hr>
      <?php
        if(isset($_SESSION["registrado"])){
          if($_SESSION["registrado"]==1){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Alumno Registrado Exitósamente
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
              <label for="matricula">Matrícula</label>
              <input maxlength="7" type="text" class="form-control" id="matricula" name="matricula" placeholder="Matrícula" required>
            </div>
            <div class="form-group col-md-9">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="carrera">Carrera</label>
              <select id="carrera" name="carrera" class="form-control select2">
                 <?php
                    $carreras = new MvcController();
                    $carreras->mostrarCarrerasController();
                 ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="fileToUpload">Foto</label>
              <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
            </div><br>
        </div>
          <button onclick="detectId();" type="submit" id="registrar" name="registrar" style="width: 100%" class="btn btn-primary">Registrar</button>
        </form>
		</div>
	</div>
</div>

<?php
    $regAlumno = new MvcController();
    $regAlumno->registrarAlumnoController();
?>