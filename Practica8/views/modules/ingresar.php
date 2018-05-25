<form method="post" align="center" style="font-family: Arial; width: 30%; margin-left: 470px; margin-top: 100px">
	<h1 style="font-weight: bold">Iniciar Sesión</h1>
	<label>Sistema de Tutorías</label>
	<hr>
	<input type="email" name="correo" placeholder="Correo electrónico" required>
	<input type="password" name="contra" placeholder="Contraseña" required>
	<br>
	<input type="submit" name="ingresar" class="button tiny" style="background-color: black" value="Ingresar">
</form>

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