<form method="post" align="center" style="font-family: Arial; width: 30%; margin-left: 470px; margin-top: 100px">
	<h1 style="font-weight: bold; color: #00715F">Iniciar Sesión</h1>
	<label>Sistema de Inventario</label>
	<hr>
	<input type="text" name="usuario" placeholder="Usuario" required>
	<input type="password" name="contra" placeholder="Contraseña" required>
	<br>
	<input type="submit" name="ingresar" class="button tiny" style="background-color: #00715F" value="Ingresar">
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