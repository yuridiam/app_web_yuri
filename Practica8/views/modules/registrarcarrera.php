<?php
	//Se inicia la sesion
	session_start();
	//Se valida la sesion
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}

?>
<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Registrar Carrera</h1>
	<hr>
	<br>
	<input type="text" name="nombre" placeholder="Nombre de la Carrera" required>
	<input type="text" name="siglas" placeholder="Siglas" required>
	<br>
	<input type="submit" name="agregarC" class="button tiny" value="Agregar" style="background-color: black; margin-left: 600px">
</form>

<?php
	//Se instancea el controlador
	$regC = new MvcController();
	//Se llama al controlador de registrar
	$regC -> registrarCarreraController();
	//Se valida el action
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
