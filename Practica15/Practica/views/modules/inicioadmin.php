<?php 

  $ob = new MvcController();

  $alumnos = $ob->numeroAlumnos();
  $profesores = $ob->numeroProfesores();
  $grupos = $ob->numeroGrupos();


?>
<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
			<h1><a style="font-weight: bold; font-size: 1.5em">BIENVENIDO</a></h1>
			<hr class="row">
			<br>
			<div class="row" align="center">
  				<div class="col-xs-12 col-sm-4" >
  					<div class="card border-primary mb-3">
  							<div class="card-body text-primary">
                  <h6 style="color: #000; font-weight: bold"><?php echo $alumnos; ?> ALUMNOS REGISTRADOS</h6>
  						  </div>
  						<div class="card-footer"><a href="index.php?action=alumnos">Ir a alumnos</a></div>
					</div>
  				</div>
  				<div class="col-xs-12 col-sm-4">
  					<div class="card border-primary mb-3">
  							<div class="card-body text-primary">
    					   <h6 style="color: #000; font-weight: bold"><?php echo $profesores; ?> PROFESORES REGISTRADOS</h6>
  						</div>
  						<div class="card-footer"><a href="index.php?action=profesores">Ir a profesores</a></div>
					</div>
  				</div>
  				<div class="col-xs-12 col-sm-4">
  					<div class="card border-primary mb-3">
  							<div class="card-body text-primary">
    						<h6 style="color: #000; font-weight: bold"><?php echo $grupos; ?> GRUPOS REGISTRADOS</h6>
  						</div>
  						<div class="card-footer"><a href="index.php?action=grupos">Ir a grupos</a></div>
					</div>
  				</div>
		  </div>
		  <br>
		  <div class="row">
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