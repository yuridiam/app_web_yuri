<div style="background:url(views/bg.jpg) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; width: 100%; min-height: 100%; height: auto !important; position: fixed;	top:0; left:0;">
	<div class="login-box" style="margin-left: 100px" >
	  <div class="login-logo">
	    <a style="font-size: 0.8em; color: white; font-weight: bold"><b style="font-weight: bold; color: #0087FF">SISTEMA DE </b>CENTRO<br> DE APRENDIZAJE DE INGLÉS</a>
	  </div>
		<div class="card">
			<div class="card-body login-card-body" style="background-color: #F0F0F0;">
				<form method="post">
					<p align="center">Iniciar Sesión</p>
	        		<div class="form-group has-feedback">
	          			<input type="text" name="usuario" placeholder="Usuario" required>
	        		</div>
	        		<div class="form-group has-feedback">
	          			<input type="password" name="contra" placeholder="Contraseña" required>
	        		</div>
	        		<input type="submit" name="ingresar" class="btn btn-block btn-flat" style="background-color: #0087FF; color:white" value="Ingresar">
	      		</form>
			</div>
		</div>
	</div>
</div>


<?php
	//Se instancea el controlador
	$ingreso = new MvcController();
	//Se llama al controlador de ingreso
	$ingreso -> ingresoUsuarioController();
	//Se valida el action
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "<script type='text/javascript'>
        					alert('Datos incorrectos');
      				  </script>";
		
		}

	}

?>