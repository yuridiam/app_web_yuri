<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <a href="index.php?action=sesiones" class="badge badge-primary">Regresar</a>
      <br>
			<h1><a style="font-weight: bold; font-size: 1.3em">REGISTRAR SESIÓN</a></h1>
			<hr>
      <?php
        if(isset($_SESSION["registrado"])){
          if($_SESSION["registrado"]==1){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Sesión Registrado Exitósamente
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
        <form id="formu" method="post" name="formu">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="alumno">Alumno</label>
              <select id="alumno" name="alumno" class="form-control select2">
                <?php
                    $mostrarAlumno = new MvcController();
                    $mostrarAlumno->mostrarAlumnoController();
                ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="act">Actividad</label>
              <select id="act" name="act" class="form-control select2">
                 <?php
                    $mostrarActividad = new MvcController();
                    $mostrarActividad->mostrarActividadController();

                 ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="fecha">Fecha</label>
              <input type="date" class="form-control" id="fecha" name="fecha" required readonly="">
            </div>
            <div class="form-group col-md-4">
              <label for="entrada">Hora de entrada</label>
              <input type="time" class="form-control" id="entrada" name="entrada" required readonly="">
            </div>
            <div class="form-group col-md-4">
              <label for="unidad">Unidad</label>
              <input type="text" class="form-control" id="unidad" name="unidad" required readonly>
            </div>
          </div>
          <button type="submit" id="registrar" name="registrar" style="width: 100%" class="btn btn-primary">Registrar</button>
        </form>
			<br><br><br><br><br><br><br>
		</div>
	</div>
</div>