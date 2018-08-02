<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <div class="row">
        <div class="col-xs-12 col-sm-8">
        	<a href="index.php?action=reportes" class="badge badge-primary">Regresar</a>
        	<br>
			<h1><a style="font-weight: bold; font-size: 1.3em">DETALLE DE SESIÓN</a></h1>
        </div>
  	  </div>
			<hr>
			<br>
			<div class="card">
			<?php
	$mvc = new MvcController();
	$mvc->vistaDetalleController();
?>
	          </div>
			  </div>
			</div>
			<br>
		</div>
	</div>
</div>
