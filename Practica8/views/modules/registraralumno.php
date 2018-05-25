<?php
	//Se inicia la sesion
	session_start();
	//Se valida la sesion
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}
	//Se instancea el controlador
	$mvc = new MvcController();

?>
<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Registrar Alumno</h1>
	<hr>
	<br>
	<input type="text" name="matricula" placeholder="Matrícula" style="width: 50%" required>
	<input type="text" name="nombre" placeholder="Nombre" required>
	<select class="js-example-basic-single" name="carrera">
	<?php
		//SE llama al controlador de carreras
		$mvc->traerCarrerasController();
	?>
	</select>
	<br><br>
	<select class="js-example-basic-single" name="tutor">
	<?php
		//Se llama al controlador de maestros
		$mvc->traerMaestrosController();
	?>
	</select>
	<br><br>
	<input type="submit" name="agregarA" class="button tiny" value="Agregar" style="background-color: black; margin-left: 600px">
</form>

<?php
	//Se instancea el controlador
	$regA = new MvcController();
	//Se llama al controlador de registrar
	$regA -> registrarAlumnoController();
	//Se valida el action
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
