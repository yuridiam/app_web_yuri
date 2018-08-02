<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <div class="row">
        <div class="col-xs-12 col-sm-8">
			      <h1><a style="font-weight: bold; font-size: 1.3em">SESIONES EN CURSO</a></h1>
        </div>
        <div class="col-xs-12 col-sm-4">
            <a href="index.php?action=nuevasesion"><button type="button" class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 270px; background-color: #0087FF">Registrar Sesión</button></a>
        </div>
      </div>
			<hr>
			<br>
        <form method="POST">
        <div class="table-responsive">
        <input type="hidden" name="horaIn" id="horaIn">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre Alumno</th>
                  <th>Actividad</th>
                  <th>Teacher</th>
                  <th>Fecha</th>
                  <th>Hora de entrada</th>
                  <th>Unidad</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      //Creacion del objeto y llamado de sus objetos
                      $vistaU = new MvcController();
                      $vistaU->vistaSesionesActivasController();
                  ?>
                </tbody>
              </table>
        </form>
          </div>
			<br><br><br><br><br><br>
		</div>
	</div>
</div>

<?php
  $eliminarAlumno = new MvcController();
  $eliminarAlumno->liberarAlumnoController();
  
?>