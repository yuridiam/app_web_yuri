<div class="login-box" >
  <div class="login-logo">
    <a>Sistema de <b>Inventario</b></a>
  </div>
	<div class="card">
		<div class="card-body login-card-body" style="background-color: #F0F0F0">
			<form method="post">
				<p align="center">Iniciar Sesión</p>
        		<div class="form-group has-feedback">
          			<input type="text" name="usuario" placeholder="Usuario" required>
        		</div>
        		<div class="form-group has-feedback">
          			<input type="password" name="contra" placeholder="Contraseña" required>
        		</div>
        		<input type="submit" name="ingresar" class="btn btn-block btn-warning btn-flat" value="Ingresar">
      </form>
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