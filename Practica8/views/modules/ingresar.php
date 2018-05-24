<form method="post" align="center" style="font-family: Arial; width: 30%; margin-left: 470px; margin-top: 100px">
	<h1 style="font-weight: bold">Iniciar Sesión</h1>
	<hr>
	<input type="email" name="correo" placeholder="Correo electrónico" required>
	<input type="password" name="contra" placeholder="Contraseña" required>
	<br>
	<input type="submit" name="ingresar" class="button tiny" style="background-color: black" value="Ingresar">
</form>

<?php
	
	$ingreso = new MvcController();
	$ingreso -> ingresoUsuarioController();

	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al ingresar";
		
		}

	}

?>