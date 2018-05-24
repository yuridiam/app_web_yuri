<?php

	session_start();

	if(!$_SESSION["validar"]){

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
	
	
	$regC = new MvcController();
	$regC -> registrarCarreraController();

	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
