<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
			<h1><a style="font-weight: bold; font-size: 1.5em">BIENVENIDO</a></h1>
			<hr class="row">
			<br>
			<div class="row" align="center">
			<h3><a style="font-weight: bold; font-size: 1em">Avance de sus alumnos en el actual cuatrimestre</a></h3><br><br><br>
			<div class="table-responsive">
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>Matricula</th>
	                  <th>Nombre Alumno</th>
	                  <th>Unidad</th>
	                  <th>Total Horas</th>
	                </tr>
	                </thead>
	                <tbody>
	                  <?php
	                      //Creacion del objeto y llamado de sus objetos
	                      $vistaInicio = new MvcController();
	                      $vistaInicio->vistaInicioController();
	                  ?>
	                </tbody>
	              </table>
	          </div>
			  <div class="row" style="margin-top: 50px">
	  				<div class="col-xs-12 col-sm-4">
	  					<div class="card">
	  				  		<img class="card-img-top" style="height: 140px; width: 800px" src="views/bg2.jpg" alt="Card image cap">
					  		<div class="card-body">
					    		<h5 class="card-title">¿Qué es CAI?</h5>
					    		<p class="card-text">Centro de Aprendizaje de Inglés de la Universidad Politécnica de Victoria.</p>
					    		<a href="#" onclick="verCAI();" class="btn btn-primary" style="background-color: #0087FF">Ver más</a>
					  		</div>
	  					</div>
	  				</div>
	  				<div class="col-xs-12 col-sm-4">
	  					<div class="card">
	  				  		<img class="card-img-top" style="height: 140px; width: 800px" src="views/bg3.jpg" alt="Card image cap">
					  		<div class="card-body">
					    		<h5 class="card-title">Objetivo del sitio</h5>
					    		<p class="card-text">El principal objetivo es centralizar las actividades de los alumnos en CAI.</p>
					    		<a href="#" onclick="verob();" class="btn btn-primary" style="background-color: #0087FF">Ver más</a>
					  		</div>
	  					</div>
	  				</div>
	  				<div class="col-xs-12 col-sm-4">
	  					<div class="card">
	  				  		<img class="card-img-top" style="height: 140px; width: 600px" src="views/bg6.jpg" alt="Card image cap">
					  		<div class="card-body">
					    		<h5 class="card-title">Soporte</h5>
					    		<p class="card-text">¿Tienes alguna duda sobre el sistema? Contáctanos.</p>
					    		 <button onclick="versp();" id="ver" type="button" class="btn btn-primary">Ver más</button>
					  		</div>
	  					</div>
	  				</div>
			  </div>

  			</div>
		</div>
	</div>
</div>