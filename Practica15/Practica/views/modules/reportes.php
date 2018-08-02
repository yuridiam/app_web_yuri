<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <div class="row">
        <div class="col-xs-12 col-sm-4">
			      <h1><a style="font-weight: bold; font-size: 1.3em">REPORTE</a></h1>
        </div>
        <div class="col-xs-12 col-sm-6">
          <button class="btn btn-danger" style="margin-left:605px"><a onclick = "confirmarReset();" href="index.php?action=reportes&reiniciar=1" id="btn1" style="color: white">Reiniciar Todo</a></button>
      </div>
  </div>
			<hr>
			<br>

				<div class="table-responsive">
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>Matricula</th>
	                  <th>Nombre Alumno</th>
	                  <th>Unidad</th>
                    <th>Maestro</th>
                    <th>Grupo</th>
	                  <th>Total Horas</th>
	                  <th>Ver Detalles</th>
	                </tr>
	                </thead>
	                <tbody>
	                  <?php
	                      //Creacion del objeto y llamado de sus objetos
	                      $vistaReporte = new MvcController();
	                      $vistaReporte->vistaReporteController();
                        $vistaReporte->reiniciarController();
	                  ?>
	                </tbody>
	              </table>
	          </div>
        
			<br>
		</div>
	</div>
</div>