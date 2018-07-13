<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <div class="row">
        <div class="col-xs-12 col-sm-4">
			      <h1><a style="font-weight: bold; font-size: 1.3em">ALUMNOS</a></h1>
        </div>
        <div class="col-xs-12 col-sm-6">
            <a href="index.php?action=nuevoalumno"><button type="button" class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 600px; background-color: #0087FF">Registrar Alumno</button></a>
        </div>
      </div>
			<hr>
      <?php
        if(isset($_SESSION["eliminado"])){
          if($_SESSION["eliminado"]==1){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Alumno Eliminado Exitósamente
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
              $_SESSION["eliminado"]=0;
          }
        }
        $_SESSION["eliminado"]=0;

      ?>
			<br>
        <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Matrícula</th>
                  <th>Nombre</th>
                  <th>Grupo</th>
                  <th>Carrera</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      //Creacion del objeto y llamado de sus objetos
                      $vistaAlumnos = new MvcController();
                      $vistaAlumnos->vistaAlumnosController();
                  ?>
                </tbody>
              </table>
          </div>
			<br><br><br><br><br><br><br>
		</div>
	</div>
</div>

<?php
  $eliminarAlumno = new MvcController();
  $eliminarAlumno->eliminarAlumnoController();
  
?>